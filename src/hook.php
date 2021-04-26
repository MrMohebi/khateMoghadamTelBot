<?php
// Load composer
require __DIR__ . '/../vendor/autoload.php';
include_once 'Tokens.php';

use Longman\TelegramBot\Request;
use Longman\TelegramBot\Telegram;


$bot_api_key  = Tokens::$khateMoghadamBot;
$bot_username = 'khateMoghadamBot';

try {
    $telegram = new Telegram($bot_api_key, $bot_username);

    // input fields
    $result= json_decode(file_get_contents("php://input"));
    $userId = isset($result->message->from->id) ? $result->message->from->id : "";
    $userFirstName =  isset($result->message->from->first_name) ? $result->message->from->first_name : "";
    $text = isset($result->message->text) ? $result->message->text : "";
    $chatId = isset($result->message->chat->id) ? $result->message->chat->id : "";
    $massageId = isset($result->message->message_id) ? $result->message->message_id : "";
    $idOfRepliedUser = isset($result->message->reply_to_message->from->id) ? $result->message->reply_to_message->from->id : "";
    $firstname_of_replied_user = isset($result->message->reply_to_message->from->first_name) ? $result->message->reply_to_message->from->first_name : "";



} catch (Longman\TelegramBot\Exception\TelegramException $e) {
    // Silence is golden!
    // log telegram errors
    // echo $e->getMessage();
}