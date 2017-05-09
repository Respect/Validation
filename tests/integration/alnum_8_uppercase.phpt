--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\AllOfException;

if (!v::alnum()->uppercase()->validate('ASDF'))
	echo 'ok';

?>
--EXPECTF--