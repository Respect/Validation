<?php
namespace Respect\Validation\Rules;

class Vowels extends Vowel
{
    public function __construct()
    {
        parent::__construct();
        trigger_error("Use consonant instead.",
            E_USER_DEPRECATED);
    }
}
