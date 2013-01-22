<?php
namespace Respect\Validation\Rules;

class Consonants extends AbstractRegexRule
{
    protected function getPregFormat()
    {
        return '/^(\s|[b-df-hj-np-tv-zB-DF-HJ-NP-TV-Z])*$/';
    }
}

