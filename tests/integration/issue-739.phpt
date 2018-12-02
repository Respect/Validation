--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validator as v;

try {
    v::when(v::alwaysInvalid(), v::alwaysValid())->check('foo');
} catch (ValidationException $exception) {
    echo $exception->getMessage();
}
?>
--EXPECT--
"foo" is not valid
