<?php

namespace Respect\Validation\Rules;

class Alnum extends Alpha
{

    protected $additionalChars = '';
    protected $stringFormat = '#^([a-zA-Z0-9]|\s)+$#';

}