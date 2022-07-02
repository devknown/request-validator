<?php

namespace Devknown\Validator\Rules;
use Respect\Validation\Validator as vnm;

class Alnum extends BaseRule
{
    public function isValid()
    {
        if ($this->isNotRequiredAndEmpty()) {
            return true;
        }

        $value = $this->getParams()[1];

        return vnm::alnum()->noWhitespace()->validate($value);
    }

    /**
     * Returns error message from rule.
     *
     * @return string
     */
    public function getMessage()
    {
        return 'characters allowed on :field: is (a-z,A-Z,0-9)';
    }
}
