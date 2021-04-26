<?php
/*
// Load composer
require __DIR__ . '/../vendor/autoload.php';

include_once 'Tokens.php';

$bot_api_key  = Tokens::$khateMoghadamBot;
$bot_username = 'khateMoghadamBot';
$hook_url     = Tokens::$khateMoghadamBot_hookUrl;

try {
    // Create Telegram API object
    $telegram = new Longman\TelegramBot\Telegram($bot_api_key, $bot_username);

    // Set webhook
    $result = $telegram->setWebhook($hook_url);
    if ($result->isOk()) {
        echo $result->getDescription();
    }
} catch (Longman\TelegramBot\Exception\TelegramException $e) {
    // log telegram errors
     echo $e->getMessage();
}
*/

echo "was set oneTime :)";