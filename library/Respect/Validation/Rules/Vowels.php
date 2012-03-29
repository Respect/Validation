<?php

namespace Respect\Validation\Rules;

class Vowels extends Alpha
{

    public $additionalChars = '';
    public $stringFormat = '/^\s*[a|e|i|o|u]+([A|E|I|O|U]|\s)*$/';

}
