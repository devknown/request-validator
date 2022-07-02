<?php

namespace Devknown\Validator\Helpers;

use mysqli;
use Exception;
use Devknown\Validator\Rules\BaseRule;

trait MysqliTrait
{
    private static $mysqli = null;

    /**
     * Initialize Mysqli connection.
     *
     * @param string $host         - db host
     * @param string $name         - db name
     * @param string $user         - db username
     * @param string $pass         - db password
     */
    public static function setupMysqli($host, $name, $user, $pass)
    {
        try
        {
            $connect = new mysqli($host, $user, $pass, $name);
            /* check connection */
        	if($connect->connect_errno)
            {
                throw new Exception($connect->connect_error);;
            }
			$connect->query("set names 'utf8'");
            /* setting a connection in $_mysqli */
            self::$mysqli = $connect;
        }
        catch (Exception $e)
        {
            trigger_error($e->getMessage(), E_USER_ERROR);
        }
    }

    /**
     * Setup Mysqli instance.
     *
     * @param Mysqli $mysqli
     */
    public static function setMysqli(mysqli $mysqli)
    {
        self::$mysqli = $mysqli;
    }

    /**
     * Get Mysqli object for unique validators.
     *
     * @return mixed|null
     */
    public static function getMysqli()
    {
        return self::$mysqli ?: null;
    }


}
