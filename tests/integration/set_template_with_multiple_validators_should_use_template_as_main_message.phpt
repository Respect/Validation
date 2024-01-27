--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
--TEST--
setTemplate() with multiple validators should use template as main message
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator;

exceptionMessage(static function () {
    Validator::callback('is_int')->between(1, 2)->setTemplate('{{name}} is not tasty')->assert('something');
});
?>
--EXPECT--
"something" is not tasty
