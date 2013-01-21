<?php

namespace Respect\Validation\Rules;

class Alnum extends AbstractCtypeRule
{

    protected $ctypeFunc = 'ctype_alnum';

}
