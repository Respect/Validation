--FILE--
<?php 

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\AllOfException;

try {
	v::not(v::arrayval())->assert(array(2, 3));
} catch (AllOfException $exception) {
	echo $exception->getFullMessage();
}

?>
--EXPECTF--
\-{ 2, 3 } must not be an array