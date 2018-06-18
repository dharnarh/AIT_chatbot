<?php
use App\Http\Controllers\BotManController;

$botman = resolve('botman');

$botman->hears('Hi|Hello|Hey', function ($bot) {
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

$botman->hears('Meaning of {dic}?', function ($bot, $dic) {
	$bot->typesAndWaits(2);

	$url = "http://api.pearson.com/v2/dictionaries/laad3/entries?headword={$dic}&limit=1";
	$data = file_get_contents($url);

	$lists = json_decode($data);

	$def = $lists->results[0]->senses[0]->definition;
	$exp = $lists->results[0]->senses[0]->examples[0]->text;
	$bot->reply('Definition - ' .$def);
	$bot->reply('Example - ' .$exp);
});


$botman->hears('Google - {google}', function ($bot, $google) {
	$bot->typesAndWaits(2);

	$url = "https://www.googleapis.com/customsearch/v1?key=AIzaSyClcp2H1eKNSOzDy_uw6DFtKLDv5_rS4-0&cx=017576662512468239146:omuauf_lfve&q={$google}";
	$data = file_get_contents($url);

	$lists = json_decode($data);

	$title1 = $lists->items[0]->title;
	$link1 = $lists->items[0]->link;
	$displayLink1 = $lists->items[0]->displayLink;
	$snippet1 = $lists->items[0]->snippet;

	$bot->reply($title1);

});

$botman->hears('/function', BotManController::class.'@startConversation');
