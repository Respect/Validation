--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
Wojciech Frącz <fraczwojciech@gmail.com>
--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Rules\Instance;

try {
    (new Instance('stdClass'))->setTemplate('invalid object')->assert('test');
} catch (ValidationException $exception) {
    print_r($exception->getMessage());
}
?>
--EXPECT--
invalid object
