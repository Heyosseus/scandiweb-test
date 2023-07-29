<?php
class DatabaseSettings
{
    var $settings;

    function getSettings()
    {
        $settings['dbhost'] = 'localhost';

        $settings['dbname'] = 'test';

        $settings['dbusername'] = 'rati';

        $settings['dbpassword'] = '';

        return $settings;
    }
}
