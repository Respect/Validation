--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
--TEST--
setTemplate() with multiple validators should use template as full message
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator;

try {
    Validator::callback('is_string')->between(1, 2)->setTemplate('{{name}} is not tasty')->assert('something');
} catch (NestedValidationException $e) {
    echo $e->getFullMessage();
}
?>
--EXPECT--
- "something" is not tasty
