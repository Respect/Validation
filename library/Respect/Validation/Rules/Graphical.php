<?php

namespace Respect\Validation\Rules;

class Graphical extends AbstractCtypeRule
{

    public $additionalChars = '';
    protected $ctypeFunc = 'ctype_graph';

}