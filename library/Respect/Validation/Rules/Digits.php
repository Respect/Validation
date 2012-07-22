<?php

namespace Respect\Validation\Rules;

class Digits extends Alpha
{

    public $additionalChars = '';
    public $stringFormat = '/^\s*[0-9]+([0-9]|\s)*$/';

}

