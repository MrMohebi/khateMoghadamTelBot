<?php
namespace Longman\TelegramBot\Commands\UserCommands;

use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Entities\InlineKeyboard;


use MysqlConfig;
use MysqldbAccess;


class ClassReminderCommand extends UserCommand{
    protected $name = 'classReminder';
    protected $description = 'A command class reminding';
    protected $version = '1.0.0';

    public function execute():ServerResponse
    {
        $connTelbot = MysqlConfig::connTelbot();
        $telbotAccess = new MysqldbAccess($connTelbot);

        $lessens = $telbotAccess->select("*", "class_reminder");
        $lessens = isset($lessens['id']) ? array($lessens): $lessens;

        $keyboardStructure = array();
        $stepCounter = 0;
        $columnNum = 2;
        $tempRow = array();
        foreach ($lessens as $eLessen){
            $tempRow[] = ['text' =>  $eLessen['lessen_name'], 'switch_inline_query_current_chat' => "$$$". "\n" . " کلاس " . $eLessen['lessen_name'] . "\n". join(" ", json_decode($eLessen['students_id']))];
            if($stepCounter < $columnNum){
                $stepCounter++;
            }else{
                $keyboardStructure[] = $tempRow;
                $tempRow = [];
                $stepCounter = 0;
            }
        }
        $keyboardStructure[] = $tempRow;


        $inline_keyboard = new InlineKeyboard(...$keyboardStructure);
        $data = [
            'reply_markup'    => $inline_keyboard
                ->setResizeKeyboard(true)
                ->setOneTimeKeyboard(true),
        ];

        return $this->replyToChat("کلاس چی؟",$data);
    }
}