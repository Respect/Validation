<?php

namespace Respect\Validation\Rules;

class Control extends AbstractCtypeRule
{

    public $additionalChars = '';
    protected $ctype_func = 'ctype_cntrl';

}