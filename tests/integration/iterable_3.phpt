--FILE--
<?php 

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\IterableException;

try {
	v::not(v::iterable())->check(array(2, 3));
} catch (IterableException $exception) {
	echo $exception->getMainMessage();
}
?>
--EXPECTF--
{ 2, 3 } must not be iterable