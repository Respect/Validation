--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\AllOfException;

try{
	v::Countable()->assert(123);
}catch(AllOfException $exception){
	echo $exception->getFullMessage();
}

?>
--EXPECTF--
\-123 must be an array