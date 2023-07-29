<?php
// function OpenCon()
// {
//     $dbhost = "localhost";
//     $dbuser = "rati";
//     $dbpass = "";
//     $db = "test";
//     $conn = new mysqli($dbhost, $dbuser, $dbpass, $db);

//     return $conn;
// }
// $conn = OpenCon();
require_once "DBSettings.php";

class DB extends DatabaseSettings
{
    var $classQuery;
    var $link;

    var $errno = '';
    var $error = '';

    function __construct()
    {
        $settings = DatabaseSettings::getSettings();

        $host = $settings['dbhost'];
        $name = $settings['dbname'];
        $user = $settings['dbusername'];
        $pass = $settings['dbpassword'];

        $this->link = new mysqli($host, $user, $pass, $name);
    }

    function query($query)
    {
        $this->classQuery = $query;
        return $this->link->query($query);
    }

    function fetchAll($result, $resultType = MYSQLI_ASSOC)
    {
        return $result->fetch_all($resultType);
    }

    function close()
    {
        $this->link->close();
    }

    function sql_error()
    {
        if (empty($error)) {
            $errno = $this->link->errno;
            $error = $this->link->error;
        }
        return $errno . ' : ' . $error;
    }
}
