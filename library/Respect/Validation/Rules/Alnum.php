<?php

namespace Respect\Validation\Rules;

class Alnum extends Alpha
{

    public $additionalChars = '';
    public $stringFormat = '/^(\s|[a-zA-Z0-9])*$/';

}
