<?php

namespace Respect\Validation\Rules;

class Alpha extends AbstractCtypeRule
{

    protected $ctypeFunc = 'ctype_alpha';
    protected $acceptEmptyString = true;

}
