<?php

namespace Respect\Validation\Rules;

class Consonants extends AbstractCharGroup
{

    public $additionalChars = '';
    public $stringFormat = '/^(\s|[b-df-hj-np-tv-zB-DF-HJ-NP-TV-Z])*$/';

}
