--FILE--
<?php 

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\ArrayValException;

try {
	v::arrayval()->check('Bla %123');
} catch (ArrayValException $exception) {
	echo $exception->getMainMessage();
}

?>
--EXPECTF--
"Bla %123" must be an array