<?php

namespace Respect\Validation\Rules;

class Space extends AbstractCtypeRule
{

    public $additionalChars = '';
    protected $ctypeFunc = 'ctype_space';

}