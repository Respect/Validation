--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\EqualsException;
use Respect\Validation\Validator as v;

try {
    v::equals('test 123')->check('test 1234');
} catch (EqualsException $e) {
    echo $e->getMainMessage();
}
?>
--EXPECTF--
"test 1234" must be equals "test 123"
