<?php

namespace Longman\TelegramBot\Commands\SystemCommands;

use Longman\TelegramBot\Commands\SystemCommand;
use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\Request;

use Longman\TelegramBot\Entities\ServerResponse;

class CallbackqueryCommand extends SystemCommand
{
    protected $name = 'CallbackqueryClassReminderCommand';
    protected $description = 'Handle the callback query of Command Class Reminder';
    protected $version = '1.0.0';

    public function execute(): ServerResponse{
        $callback_query = $this->getCallbackQuery();
        $callback_data  = $callback_query->getData();


        if($callback_data == "key1"){
            return $callback_query->answer([
                'text'       => json_encode($callback_data),
                'show_alert' =>true,
                'cache_time' => 5,
            ]);
        }else{
            return $callback_query->answer([
                'text'       => "ggggggggggg",
                'show_alert' =>false,
                'cache_time' => 5,
            ]);
        }

    }
}