--FILE--
<?php 

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\BoolTypeException;
use Respect\Validation\Validator as v;

try {
    v::boolType()->check('12345');
} catch (BoolTypeException $e) {
    echo $e->getMainMessage();
}
?>
--EXPECTF--
"12345" must be a boolean