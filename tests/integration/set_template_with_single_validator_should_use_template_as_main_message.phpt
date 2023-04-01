--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
--TEST--
setTemplate() with single validator should use template as main message
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator;

$rule = Validator::callback('is_int')->setTemplate('{{name}} is not tasty');

exceptionMessage(static fn() => $rule->assert('something'));
exceptionMessage(static fn() => $rule->check('something'));
?>
--EXPECT--
"something" is not tasty
"something" is not tasty
