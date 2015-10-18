--FILE--
<?php 

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\AllOfException;

try {
	v::not(v::boolType())->assert(true);
} catch (AllOfException $e) {
	echo $e->getFullMessage();
}
?>
--EXPECTF--
\-true must not be a boolean