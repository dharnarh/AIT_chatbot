<?php

namespace App\Conversations;

use Illuminate\Foundation\Inspiring;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Conversations\Conversation;

class ExampleConversation extends Conversation
{
    /**
     * First question
     */
    public function askReason()
    {
        $question = Question::create("Would you like a dictionary search?")
            ->fallback('Unable to ask question')
            ->callbackId('ask_reason')
            ->addButtons([
                Button::create('Yes')->value('Yes'),
                Button::create('No')->value('No'),
            ]);

        return $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                if ($answer->getValue() === 'No') {
                    $this->say(Inspiring::quote());
                } else {
                    $this->ask('Enter a word you would like to search such as "Apple"', function ($answer, $bot) {
                        $url = "http://api.pearson.com/v2/dictionaries/laad3/entries?headword={$answer}&limit=1";
                        $data = file_get_contents($url);

                        $lists = json_decode($data);

                        $def = $lists->results[0]->senses[0]->definition;
                        $exp = $lists->results[0]->senses[0]->examples[0]->text;
                        $bot->say('Definition - ' .$def);
                        $bot->say('Example - ' .$exp);
                    });
                }
            }
        });
    }

    /**
     * Start the conversation
     */
    public function run()
    {
        $this->askReason();
    }
}
