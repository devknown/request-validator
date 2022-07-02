<?php

namespace Devknown\Validator\Rules;

class NotIn extends BaseRule
{
    public function isValid()
    {
        if ($this->isNotRequiredAndEmpty()) {
            return true;
        }

        $input = trim($this->getParams()[1]);

        $values = array_map(function ($elem) {
            return trim($elem);
        }, explode(',', $this->getParams()[2]));

        $in = $this->respect('In', [$values]);

        return $this->respect('Not', [$in])->validate($input);
    }

    public function getMessage()
    {
        return 'Field :field: has wrong values';
    }
}
