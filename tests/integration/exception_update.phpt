--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

try {
    v::not(v::alnum())->check('abc123');
} catch (Exception $exception) {
    $exception->setParam('translator', function () {
        return '{{name}} não deve conter letras (a-z) ou dígitos (0-9)';
    });
    echo $exception->getMessage();
}
?>
--EXPECTF--
"abc123" não deve conter letras (a-z) ou dígitos (0-9)
