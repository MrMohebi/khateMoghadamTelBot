<?php
namespace Longman\TelegramBot\Commands\UserCommands;

use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Entities\Keyboard;
use Longman\TelegramBot\Entities\ServerResponse;


class StartCommand extends UserCommand{
    protected $name = 'start';
    protected $description = 'start';
    protected $usage = '/start';
    protected $version = '1.0.0';

    public function execute():ServerResponse
    {

        $keyboard = new Keyboard(
            ['کلاس🍆'],
        );

        $data = [
            'reply_markup'    => $keyboard
                ->setResizeKeyboard(true)
                ->setOneTimeKeyboard(true),
        ];

        return $this->replyToChat('خو چه کنیم', $data);
    }
}