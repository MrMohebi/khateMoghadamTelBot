<?php
function getPageContent($url){
    try{
        $ch      = curl_init();
        curl_setopt_array( $ch, array(
            CURLOPT_URL            => $url,
            CURLOPT_CUSTOMREQUEST  => "GET",        //set request type post or get
            CURLOPT_USERAGENT      => 'Mozilla/5.0 (Windows NT 6.1; rv:8.0) Gecko/20100101 Firefox/8.0', //set user agent
            CURLOPT_RETURNTRANSFER => true,     // return web page
            CURLOPT_HEADER         => false,    // don't return headers
            CURLOPT_FOLLOWLOCATION => true,     // follow redirects
            CURLOPT_ENCODING       => "",       // handle all encodings
            CURLOPT_AUTOREFERER    => true,     // set referer on redirect
            CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
            CURLOPT_TIMEOUT        => 120,      // timeout on response
            CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
        ) );
        $content = curl_exec( $ch );
        curl_close( $ch );
        return $content;
    }catch (Exception $e){
        return $e;
    }
}


function dummyText($bot, $message){
    $text = $message->getText();
    $chatId = $message->getChat()->getId();

    if(strpos($text, 'بات بنویس') !== false){
        $dummyText = explode('بات بنویس', $text )[1];
        $d = new DOMDocument();
        $d->validateOnParse = true;
        $d->loadHTML(getPageContent("http://patorjk.com/misc/scrollingtext/timewaster.php?text=".urlencode(($dummyText))));
        $openingStr = "......................................................................................................................................\n";
        $resultArr = [$openingStr];
        $resultArrLength = 0;
        $tempLength = strlen($openingStr);
        foreach ($d->getElementById("scrollingTextOutput")->childNodes as $node){
            if($node->tagName !== "br"){
                if($tempLength<4096){
                    $sentence = utf8_decode($node->textContent) . "\n";
                    $resultArr[$resultArrLength] .= $sentence;
                    $tempLength += strlen($sentence);
                    if($tempLength>4096){
                        $resultArr[$resultArrLength] .= ".";
                    }
                }else{
                    $tempLength = strlen($openingStr);
                    $resultArrLength++;
                    $resultArr[$resultArrLength] = $openingStr . utf8_decode($node->textContent) . "\n";
                }
            }
        }

        foreach ($resultArr as $eMessage){
            $bot->sendMessage($chatId, $eMessage);
        }
    }
}