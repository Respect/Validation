<?php

namespace Respect\Validation\Rules;

class Vowels extends AbstractCharGroup
{

    public $additionalChars = '';
    public $stringFormat = '/^(\s|[aeiouAEIOU])*$/';

}
