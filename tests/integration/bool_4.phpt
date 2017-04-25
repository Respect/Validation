--FILE--
<?php 

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\BoolTypeException;

try {
	v::not(v::boolType())->check(true);
} catch (BoolTypeException $e) {
	echo $e->getMainMessage();
}
?>
--EXPECTF--
true must not be a boolean