--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
--TEST--
setTemplate() with single validator should use template as main message
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator;

$rule = Validator::callback('is_int')->setTemplate('{{name}} is not tasty');
try {
    $rule->assert('something');
} catch (NestedValidationException $e) {
    echo $e->getMessage();
}

echo PHP_EOL;

try {
    $rule->check('something');
} catch (NestedValidationException $e) {
    echo $e->getMessage();
}
?>
--EXPECT--
"something" is not tasty
"something" is not tasty
