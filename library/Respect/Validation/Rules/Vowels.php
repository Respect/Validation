<?php

namespace Respect\Validation\Rules;

class Vowels extends Alpha
{

    public $additionalChars = '';
    public $stringFormat = '/^(\s|[aeiouAEIOU])*$/';

}
