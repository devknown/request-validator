<?php

namespace Devknown\Validator\DbProviders;

use Devknown\Validator\Contracts\Rules\ExistInterface;
use Devknown\Validator\Contracts\Rules\UniqueInterface;
use Devknown\Validator\Validator;

class MysqliAdapter extends Adapter implements ExistInterface, UniqueInterface
{
    private $field;
    private $value;
    private $table;

    public function __construct($attribute, $value, $table)
    {
        $this->field = $attribute;
        $this->value = $value;
        $this->table = $table;
    }

    private function commonQuery()
    {
        $db = Validator::getMysqli();

        $sql = "SELECT id FROM `$this->table` WHERE $this->field = '".$db->real_escape_string($this->value)."'";

        return $db->query($sql);
    }

    public function isUnique()
    {
        return $this->commonQuery()->num_rows == 0;
    }

    public function isExist()
    {
        return $this->commonQuery()->num_rows != 0;
    }
}
