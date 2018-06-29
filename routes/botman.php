<?php
use App\Http\Controllers\BotManController;
use BotMan\BotMan\Middleware\ApiAi;

$botman = resolve('botman');

$botman->hears('/start', BotManController::class.'@startConversation');

$dialogflow = ApiAi::create('')->listenForAction();

//Apply global "received" middleware

$botman->middleware->received($dialogflow);

$botman->hears('.*', function ($bot) {

	$extras = $bot->getMessage()->getExtras();
	$apiReply = $extras['apiReply'];
	$apiAction = $extras['apiAction'];
	$apiIntent = $extras['apiIntent'];

	if ($apiReply == '') {
		$apiReply = 'Not able to connect to dialogflow';
	}
	
	$bot->reply($apiReply);

})->middleware($dialogflow);