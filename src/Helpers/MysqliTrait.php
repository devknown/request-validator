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
    public static function setupMysqli($mysqli)
    {
        try {
            self::$mysqli = $mysqli;
        } catch (Exception $e) {
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
