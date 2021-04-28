<?php

function antiSpam($senderId, $chatId, $massageId, $text){

    // check if massage is a kind of spam words
    $spamWordList = array('کلاس🍆', '🐣صفحه اصلی', 'لیست دستورات کلاس🍆', 'کلاس➕', 'دانشجو👨‍👨‍👦‍👦', 'دانشجو👨‍👨‍👦', 'کلاس✖️');
    if(!in_array($text, $spamWordList))
        return false;

    $connTelbot = MysqlConfig::connTelbot();
    $telbotAccess = new MysqldbAccess($connTelbot);

    $spamResponses = array(
        "ایشون یک کونده اسپمر بلفطره هستن",
        "مگه ننتو گاییدم که اسپم میکنی بچه کونی",
        "باشه بابا بیا پولتو بگیر اسپم نکن",
        "اسپن نکن کیری",
        "عجب کونده خری ناموسا",
        "مث ایشون نیاشیم، ایشون یه اسپره که میخواد بگه من کون میدم",
        "فکر کنم هزار بیشتر بدم خونه هم بیای اسپر کونده",
        "اعصابم مث فیس این اسپمر کیریه هعی",
        "چیز خاصی نیس کونش میخاره",
        "به درد خارش کون مبتلاست، زود خوب میشه",
        'درسته ممد "فحش نمیده اسب" ولی خب من میدم، نکن کونده برزیلی'
    );
    shuffle($spamResponses);
    $spamResponse = end($spamResponses);

    $timeLimit =  time() - 8400; // 15 min
    $command = $text;

    $userBlockedLog =$telbotAccess->select('*', 'blocked_users', "`user_id`='$senderId' AND `chat_id`='$chatId' AND `command`='$command' AND `blocked_time`>=$timeLimit");

    if(count($userBlockedLog) > 1){
        return $spamResponse;
    }

    $massageLogs = $telbotAccess->select('*', 'anti_spam', "`sender_id`='$senderId' AND `chat_id`='$chatId' AND `command`='$command' AND `send_time`>=$timeLimit");
    if(count($massageLogs) > 10){
        $telbotAccess->insert('blocked_users', array(
            'user_id'=>$senderId,
            'chat_id'=>$chatId,
            'blocked_time'=>time(),
            'command'=>$text,
            'reason'=>"spam"
        ));
    }else{
        $telbotAccess->insert('anti_spam', array(
            'sender_id'=>$senderId,
            'chat_id'=>$chatId,
            'send_time'=>time(),
            'command'=>$text,
            'massage_id'=>$massageId
        ));
    }

    return false;
}