--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::objectType()->assert(new stdClass);
v::objectType()->check(new stdClass);
?>
--EXPECTF--
--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\ObjectTypeException;

try {
    v::not(v::objectType())->check(new stdClass);
} catch (ObjectTypeException $exception) {
    echo $exception->getMainMessage();
}

?>
--EXPECTF--
`[object] (stdClass: { })` must not be an object