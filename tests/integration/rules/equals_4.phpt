--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\EqualsException;
use Respect\Validation\Validator as v;

try {
    v::not(v::equals('test 123'))->check('test 123');
} catch (EqualsException $e) {
    echo $e->getMainMessage();
}
?>
--EXPECTF--
"test 123" must not be equals "test 123"
