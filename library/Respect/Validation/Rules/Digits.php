<?php

namespace Respect\Validation\Rules;

class Digits extends AbstractCtypeRule
{

    public $additionalChars = "\n\r\t ";
    protected $ctypeFunc = 'ctype_digit';

}
