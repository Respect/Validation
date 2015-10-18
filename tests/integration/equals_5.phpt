--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\AllOfException;

try
{
	v::not(v::equals('test 123'))->assert('test 123');
} catch (AllOfException $e) {
	echo $e->getFullMessage();
}
?>
--EXPECTF--
\-"test 123" must not be equals "test 123"
