<?php
namespace database;

class DatabaseSettings
{
    var $settings;

    function getSettings()
    {
        $settings['dbhost'] = 'localhost';

        $settings['dbname'] = 'test';

        $settings['dbusername'] = 'rati';

        $settings['dbpassword'] = '123';

        return $settings;
    }
}
