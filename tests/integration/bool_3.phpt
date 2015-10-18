--FILE--
<?php 

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\AllOfException;

try {
	v::boolType()->assert('12345');
} catch (AllOfException $e) {
	echo $e->getFullMessage();
}
?>
--EXPECTF--
\-"12345" must be a boolean