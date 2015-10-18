--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\AllOfException;

try {
	v::ArrayType()->assert('teste');
}catch(AllOfException $exception){
	echo $exception->getFullMessage();
}

?>
--EXPECTF--
\-"teste" must be of the type array