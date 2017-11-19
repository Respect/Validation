--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\DigitException;
use Respect\Validation\Validator as v;

try {
    v::digit()->check('a');
} catch (DigitException $e) {
    echo $e->getMainMessage();
}
?>
--EXPECTF--
"a" must contain only digits (0-9)
