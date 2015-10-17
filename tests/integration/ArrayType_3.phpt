--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\AllOfException;

try {
	v::ArrayType()->assert(new \ArrayObject());
}catch(AllOfException $exception){
	echo $exception->getFullMessage();
}

?>
--EXPECTF--
\-`[traversable] (ArrayObject: { })` must be of the type array