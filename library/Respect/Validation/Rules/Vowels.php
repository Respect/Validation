<?php
namespace Respect\Validation\Rules;

class Vowels extends AbstractRegexRule
{
    protected function getPregFormat()
    {
        return '/^(\s|[aeiouAEIOU])*$/';
    }
}

