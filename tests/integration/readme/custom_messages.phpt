--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessages(
    static fn() => v::alnum()
        ->noWhitespace()
        ->length(v::between(1, 15))
        ->assert('really messed up screen#name', [
            'alnum' => '{{name}} must contain only letters and digits',
            'noWhitespace' => '{{name}} cannot contain spaces',
            'length' => '{{name}} must not have more than 15 chars',
        ])
);
?>
--EXPECT--
[
    '__root__' => 'All of the required rules must pass for "really messed up screen#name"',
    'alnum' => '"really messed up screen#name" must contain only letters and digits',
    'noWhitespace' => '"really messed up screen#name" cannot contain spaces',
    'lengthBetween' => 'The length of "really messed up screen#name" must be between 1 and 15',
]
