<?php
use App\Http\Controllers\BotManController;

$botman = resolve('botman');

$botman->hears('.*(Hi|Hello|Hey).*', function ($bot) {
    $bot->reply('Hello there, I am a chatbot that offers few functionality for now');
    $bot->ask('What is your name?', function ($name, $bot) {
    	$bot->say('Welcome '.$name->getText());
    });
});

$botman->hears('How are you?|How you doing?|What\'s up', function ($bot) {
	$bot->reply('I\'m good');
	$bot->ask('You?', function ($answer, $bot) {
		if ($answer == 'Good') {
			$bot->say('Oh! That\'s good to hear');
		} elseif ($answer == 'Not good') {
			$bot->say('Oh! sorry, how about I make you smile');
		} else {
			$bot->say('Okay, bright day ahead');
		}
	});
});

$botman->hears('/function', BotManController::class.'@startConversation');
