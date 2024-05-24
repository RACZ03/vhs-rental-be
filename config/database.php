<?php

namespace Config;

use mysqli;
use Utils\Env;

class Database
{
    private static $connection;

    public static function getConnection()
    {
        if (self::$connection === null) {
            Env::load(__DIR__ . '/../.env');
            
            $host = getenv('DB_HOST');
            $port = getenv('DB_PORT');
            $user = getenv('DB_USER');
            $pass = getenv('DB_PASS');
            $dbname = getenv('DB_NAME');

            // Connect to the database server
            $connection = new mysqli($host, $user, $pass, '', $port);

            if ($connection->connect_error) {
                die("Connection failed: " . $connection->connect_error);
            }

            // Create the database if it doesn't exist
            $connection->query("CREATE DATABASE IF NOT EXISTS $dbname");

            // Close the connection
            $connection->close();

            // Connect to the database with the database name
            self::$connection = new mysqli($host, $user, $pass, $dbname, $port);

            if (self::$connection->connect_error) {
                die("Connection failed: " . self::$connection->connect_error);
            }
        }

        return self::$connection;
    }
}
