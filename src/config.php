<?php
include_once 'Tokens.php';

$bot_api_key  = Tokens::$khateMoghadamBot;
$bot_username = 'khateMoghadamBot';

return [
    'api_key'      => $bot_api_key,
    'bot_username' => 'khateMoghadamBot',

    'commands'     => [
        'paths'   => [
             __DIR__ . '/Commands/',
        ],
    ],
];