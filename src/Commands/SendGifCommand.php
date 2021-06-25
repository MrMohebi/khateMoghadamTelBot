<?php
namespace Longman\TelegramBot\Commands\UserCommands;

use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Entities\ServerResponse;

use Longman\TelegramBot\Request;


class SendGifCommand extends UserCommand{
    protected $name = 'sendGif';
    protected $description = 'send gif base on text';
    protected $version = '1.0.0';

    public function execute():ServerResponse
    {
        $massage = $this->getMessage();
        $text = $massage->getText();
        $chatId = $massage->getChat()->getId();

        if (preg_match("/\b"."هعی"."\b/u", $text)){
            return Request::sendAnimation(['chat_id' => $chatId, 'animation' =>  'CgACAgQAAx0CTwcRQAADLGDVqJP5p0fOriGNHt504mxlSMg6AAIXCgACsA6BUM1SJhMGGCXdIAQ']);
        }elseif (preg_match("/\b"."گی"."\b/u", $text)){
            $gay_list = [
                "CgACAgQAAx0CTwcRQAADLmDVsGfAyLbn6PoeWMBsjMF4_9uuAAIMAANVH0EO2ysPA_71ORcgBA",
                "CgACAgQAAx0CTwcRQAADMGDVsGonCuAXv5hOX5ODzutCZYtiAAJ8BgACxLcRUt1SwKuY7_hnIAQ",
                "CgACAgQAAx0CTwcRQAADMmDVsG2BSM0H1lS6tVufBnmQqQHMAAJbAgACEYFQUshl8jULmT2KIAQ",
                "CgACAgQAAx0CTwcRQAADNGDVsHZz_n0jGASLD8Ad5HrCxO_9AAJXBAACxoIoU5ttfc7sGKl7IAQ",
                "CgACAgQAAx0CTwcRQAADNmDVsH1arNIv-9MhZIuQe4WsYUoIAALPAQACRuEoULZzXmztaLNjIAQ",
                "CgACAgQAAx0CTwcRQAADOGDVsIN-YlsC52RjOkt4poDlZ0CjAALTAANBjaVSTlpNpwnAGBEgBA",
                "CgACAgQAAx0CTwcRQAADOmDVsIgi3wiwStXQGIE_Q7j7JgkKAALXBQACTIPQUsghcdXIIjJLIAQ",
                "CgACAgQAAx0CTwcRQAADPGDVsIr2btikMNuqnIX8burCMrm4AAIZXwACcxlkBw75qVVZYlv7IAQ",
                "CgACAgQAAx0CTwcRQAADPmDVsJR_CUUnucc11a9t_cI1yi60AALHAQACj1kkUAq4cEuQ3E6VIAQ",
                "CgACAgQAAx0CTwcRQAADa2DVsxb6S8M_sdGJDr8AAenpuCznkgACWwIAAgpGqFMm1cZioICk_iAE"
                ];
            return Request::sendAnimation(['chat_id' => $chatId, 'animation' =>  $gay_list[array_rand($gay_list)]]);
        }elseif (preg_match("/\b"."مرام|معرفت|مرامی|معرفتی"."\b/u", $text)){
            return Request::sendAnimation(['chat_id' => $chatId, 'animation' =>  "CgACAgQAAx0CTwcRQAADQGDVsZQvqj5amOUaTARF5ZOCQry6AAJ0CgACMdG4UZDkRTQUCrOfIAQ"]);
        }elseif (preg_match("/\b"."ممه"."\b/u", $text)){
            $mame_list= [
                "CgACAgQAAx0CTwcRQAADRWDVspeTi98vRihqZmMIkV4ZVloBAAJvCAACxre4Uosvj3XbAoCeIAQ",
                "CgACAgQAAx0CTwcRQAADR2DVsqgqQu4FEeeLWMelNOKjSvo8AAKYAAM-2FADgJGXPNUwbO4gBA",
                "CgACAgQAAx0CTwcRQAADSWDVsqpnpHYJlPr2mm7g-MuSC64vAAJwDAAC9ZwYUHwVjU5FxHsLIAQ",
                "CgACAgQAAx0CTwcRQAADS2DVsqwne4jS27E2P6tpESwO3uDxAAJWCQACpXIpURYXofpceIUvIAQ",
                "CgACAgQAAx0CTwcRQAADTWDVsq94FWnCz80awnTcAXmOD2tvAAJBAwACoSiZCcHGIL2cJoRzIAQ",
                "CgACAgQAAx0CTwcRQAADT2DVsrCCoH_4b3zr4mTBxoXUak_rAAIWAAP0FpQLtfP_W8S1Y5IgBA",
                "CgACAgQAAx0CTwcRQAADUWDVsrO-PkOQfZyNQJCHPqJ7Cwu0AAI6AgACp3OEUnk9KwF4qjWZIAQ",
                "CgACAgQAAx0CTwcRQAADU2DVsrbs61b513R-ljBcK_iMUgABKQACIQkAArXAoFEN-9dVU12zEiAE",
                "CgACAgQAAx0CTwcRQAADVWDVsr71txC5E0-kPkJz7EkJ7V6aAAJNAgAC7lecUVsm_tb9GY17IAQ",
                "CgACAgQAAx0CTwcRQAADV2DVssLzazL-JfGrbT_3u_77D6K7AALOBgACMgmgUvnwTHgpPaYeIAQ",
                "CgACAgQAAx0CTwcRQAADWWDVssUgg64aDhDFoJGGGSjxbbVEAAKrAQACEZfpUsRyWQEijDjAIAQ",
                "CgACAgQAAx0CTwcRQAADW2DVsssQYw23NRLLLQsc6dzp0Be6AAJJBwACyvshUFbnE_LSFIIqIAQ",
                "CgACAgQAAx0CTwcRQAADXWDVsth_5q4np_-TDh7cwslIvvt3AAKDAQAC3XodU4tMwv7LW6rRIAQ",
                "CgACAgIAAx0CTwcRQAADX2DVstpBNcCWx6EGxXzWBcR-uLjpAAIZCAACC-WIS3pTIJeoB5S3IAQ",
                "CgACAgQAAx0CTwcRQAADYWDVst5MUXfsLKyIo8gMya-cfE5YAALyCAACjFbQUjpV-RsW7dfcIAQ",
                "CgACAgQAAx0CTwcRQAADY2DVsuJ2nYqYVuMJ3mpw65ZOZlE6AAIYBwAC9pywUEOfYW63UzVwIAQ",
                "CgACAgQAAx0CTwcRQAADZWDVsuiUsVbKu2c5mFGL72MwGIUuAAI4BwACtfIIUozq1nqQ-p-rIAQ",
                "CgACAgQAAx0CTwcRQAADZ2DVsusC05ot5yfBmYc0xC8AAZrNeAACbQADltU4UK3uMdtuS0T3IAQ",
                "CgACAgQAAx0CTwcRQAADaWDVsu-Ai3ignzb7YtJuB1n5JIhaAAIeBAACqTqgUJY4VvDNA7B1IAQ",
            ];
            return Request::sendAnimation(['chat_id' => $chatId, 'animation' => $mame_list[array_rand($mame_list)]]);
        }elseif (preg_match("/\b"."سیگار|گنگ|گنگه"."\b/u", $text)){
            return Request::sendAnimation(['chat_id' => $chatId, 'animation' => "CgACAgQAAx0CTwcRQAADbWDVtag_MvNeYBD0wWFlX1EOsbh4AAIrCQACrAkhUMahkBF1ep6tIAQ" ]);
        }

        return Request::emptyResponse();
    }
}
