--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\AllOfException;

if (v::alnum()->notEmpty()->validate(''))
	echo 'error';

?>
--EXPECTF--