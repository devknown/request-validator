<?php

namespace Devknown\Validator\DbProviders;

use PDO;
use Devknown\Validator\Contracts\Rules\ExistInterface;
use Devknown\Validator\Contracts\Rules\UniqueInterface;
use Devknown\Validator\Validator;

class PdoAdapter extends Adapter implements ExistInterface, UniqueInterface
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
        $sql = "SELECT COUNT(*) FROM `$this->table` WHERE $this->field =:v";

        $db = Validator::getPDO();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':v', $this->value, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt;
    }

    public function isUnique()
    {
        return $this->commonQuery()->fetchColumn() == 0;
    }

    public function isExist()
    {
        return $this->commonQuery()->fetchColumn() != 0;
    }
}
