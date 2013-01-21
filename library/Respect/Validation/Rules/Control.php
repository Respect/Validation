<?php

namespace Respect\Validation\Rules;

class Control extends AbstractCtypeRule
{

    public $additionalChars = '';
    protected $ctypeFunc = 'ctype_cntrl';

}