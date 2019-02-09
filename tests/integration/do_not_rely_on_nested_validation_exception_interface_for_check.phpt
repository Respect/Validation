--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
--TEST--
Do not rely on nested validation exception interface for check
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validator;

$usernameValidator = Validator::alnum('_')->length(1, 15)->noWhitespace();
try {
    $usernameValidator->check('really messed up screen#name');
} catch (NestedValidationException $e) {
    echo 'Check used NestedValidationException';
} catch (ValidationException $e) {
    echo $e->getMessage();
}
?>
--EXPECT--
"really messed up screen#name" must contain only letters (a-z), digits (0-9) and "_"
