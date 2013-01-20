<?php

namespace Respect\Validation\Rules;

class Xdigits extends AbstractCtypeRule
{

    public $additionalChars = "\n\r\t ";
    protected $ctypeFunc = 'ctype_xdigit';

}
