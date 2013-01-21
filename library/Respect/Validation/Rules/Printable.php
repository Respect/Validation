<?php

namespace Respect\Validation\Rules;

class Printable extends AbstractCtypeRule
{

    public $additionalChars = '';
    protected $ctypeFunc = 'ctype_print';

}