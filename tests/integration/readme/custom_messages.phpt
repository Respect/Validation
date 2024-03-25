--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessages(
    static fn() => v::alnum()
        ->noWhitespace()
        ->length(v::between(1, 15))
        ->setTemplates([
            'alnum' => '{{name}} must contain only letters and digits',
            'noWhitespace' => '{{name}} cannot contain spaces',
            'length' => '{{name}} must not have more than 15 chars',
        ])
        ->assert('really messed up screen#name')
);
?>
--EXPECT--
[
    '__root__' => 'All of the required rules must pass for "really messed up screen#name"',
    'alnum' => '"really messed up screen#name" must contain only letters and digits',
    'noWhitespace' => '"really messed up screen#name" cannot contain spaces',
    'length' => '"really messed up screen#name" must not have more than 15 chars',
]
