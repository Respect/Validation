--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\AllOfException;

try
{
	v::equals('test 123')->assert('test 1234');
} catch (AllOfException $e) {
	echo $e->getFullMessage();
}
?>
--EXPECTF--
\-"test 1234" must be equals "test 123"
