<?php

namespace Devknown\Validator\Rules;

class PhoneMask extends BaseRule
{
    public function isValid()
    {
        if ($this->isNotRequiredAndEmpty()) {
            return true;
        }

        $phone = trim($this->getParams()[1]);
        $phoneMask = substr($this->getParams()[2], 1, -1);

        if (strlen($phone) != strlen($phoneMask)) {
            return false;
        }

        foreach (str_split($phoneMask) as $index => $maskChar) {
            if ($maskChar != '#' && $maskChar != $phone[$index]) {
                return false;
            }

            if ($maskChar == '#' && !is_numeric($phone[$index])) {
                return false;
            }
        }

        return true;
    }

    public function getMessage()
    {
        return 'Field :field: has bad phone format';
    }
}
