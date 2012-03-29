<?php

namespace Respect\Validation\Rules;

class Consonants extends Alpha
{

    public $additionalChars = '';
    public $stringFormat = '/^\s*[b-d|f-h|j-n|p-t|v-z]+([B-D|F-H|J-N|P-T|V-Z]|\s)*$/';

}

