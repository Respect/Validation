--FILE--
<?php 

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\IterableException;

try {
	v::iterable()->check(3);
} catch (IterableException $exception) {
	echo $exception->getMainMessage();
}
?>
--EXPECTF--
3 is not a valid iterable instance