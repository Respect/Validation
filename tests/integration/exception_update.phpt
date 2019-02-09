--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Factory;
use Respect\Validation\Validator as v;

Factory::setDefaultInstance(new Factory([], [], function (string $message): string {
    return '{{name}} não deve conter letras (a-z) ou dígitos (0-9)';
}));

try {
    v::not(v::alnum())->check('abc123');
} catch (Throwable $exception) {
    echo $exception->getMessage();
}
?>
--EXPECT--
"abc123" não deve conter letras (a-z) ou dígitos (0-9)
