<?php

namespace Respect\Validation\Rules;

class Punctuation extends AbstractCtypeRule
{

    public $additionalChars = '';
    protected $ctypeFunc = 'ctype_punct';

}