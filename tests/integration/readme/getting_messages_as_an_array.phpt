--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessages(
    static fn() => v::alnum()->noWhitespace()->lengthBetween(1, 15)->assert('really messed up screen#name')
);
?>
--EXPECT--
[
    '__root__' => 'All of the required rules must pass for "really messed up screen#name"',
    'alnum' => '"really messed up screen#name" must contain only letters (a-z) and digits (0-9)',
    'noWhitespace' => '"really messed up screen#name" must not contain whitespace',
    'lengthBetween' => 'The length of "really messed up screen#name" must be between 1 and 15',
]
