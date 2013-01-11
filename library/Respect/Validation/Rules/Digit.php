<?php

namespace Respect\Validation\Rules;

class Digit extends Alpha
{

    public $additionalChars = '';
    public $stringFormat = '/^\s*[0-9]+([0-9]|\s)*$/';

}
