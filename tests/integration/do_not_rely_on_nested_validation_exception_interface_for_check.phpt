--TEST--
Do not rely on nested validation exception interface for check
--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Validator;

exceptionMessage(
    static fn () => Validator::alnum('__')->lengthBetween(1, 15)->noWhitespace()->assert('really messed up screen#name')
);
?>
--EXPECT--
"really messed up screen#name" must contain only letters (a-z), digits (0-9) and "__"
