<?php
namespace Longman\TelegramBot\Commands\UserCommands;

use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Entities\Keyboard;


class EditClassReminderCommand extends UserCommand{
    protected $name = 'editClassReminder';
    protected $description = 'editClassReminder';
    protected $version = '1.0.0';

    public function execute():ServerResponse
    {

        $keyboard = new Keyboard(
            ['لیست دستورات کلاس🍆', 'کلاس🍆'],
            ['🐣صفحه اصلی']
        );
        $data = [
            'reply_markup'    => $keyboard
                ->setResizeKeyboard(true)
        ];

        return $this->replyToChat("کلاس", $data);

    }
}