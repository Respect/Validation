<?php

namespace Respect\Validation\Rules;

class Vowel extends Alpha
{

    public $additionalChars = '';
    public $stringFormat = '/^(\s|[aeiouAEIOU])*$/';

}
