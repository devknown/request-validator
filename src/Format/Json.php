<?php

namespace Devknown\Validator\Format;

use Devknown\Validator\Contracts\Format\FormatInterface;

class Json implements FormatInterface
{
    public function reformat($messages)
    {
        return json_encode($messages);
    }
}
