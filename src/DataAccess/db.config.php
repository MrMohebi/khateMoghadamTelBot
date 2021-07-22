<?php
require __DIR__ . '/../../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../' );
$dotenv->load();


class MysqlConfig {
    protected static string $serverAddr = "127.0.0.1";

    public static function connTelbot(){
        return mysqli_connect(MysqlConfig::$serverAddr, $_ENV["MYSQL_USERNAME"], $_ENV["MYSQL_PASSWORD"], $_ENV["MYSQL_DBNAME"]);
    }

}