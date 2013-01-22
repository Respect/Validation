<?php
namespace Respect\Validation\Rules;

class Vowel extends AbstractRegexRule
{
    protected function getPregFormat()
    {
        return '/^(\s|[aeiouAEIOU])*$/';
    }
}

