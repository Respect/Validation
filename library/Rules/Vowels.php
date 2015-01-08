<?php
namespace Respect\Validation\Rules;

class Vowels extends Vowel
{
    public function __construct()
    {
        parent::__construct();
        trigger_error("Use vowel instead.", E_USER_DEPRECATED);
    }
}
