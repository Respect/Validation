--TEST--
Do not rely on nested validation exception interface for check
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator;

exceptionMessage(
    static fn () => Validator::alnum('__')
        ->length(Validator::between(1, 15))
        ->noWhitespace()
        ->check('really messed up screen#name')
);
?>
--EXPECT--
"really messed up screen#name" must contain only letters (a-z), digits (0-9) and "__"
