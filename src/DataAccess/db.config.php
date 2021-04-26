<?php
include_once "../Tokens.php";



class MysqlConfig {
    protected static string $serverAddr = "127.0.0.1";

    public static function connTelbot(){
        return mysqli_connect(MysqlConfig::$serverAddr, Tokens::mysqliConfigData("username"), Tokens::mysqliConfigData("password"), Tokens::mysqliConfigData("dbName"));
    }

}