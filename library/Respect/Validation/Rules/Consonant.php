<?php

namespace Respect\Validation\Rules;

class Consonant extends Alpha
{

    public $additionalChars = '';
    public $stringFormat = '/^(\s|[b-df-hj-np-tv-zB-DF-HJ-NP-TV-Z])*$/';

}
