--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\ObjectTypeException;
use Respect\Validation\Validator as v;

try {
    v::not(v::objectType())->check(new stdClass());
} catch (ObjectTypeException $exception) {
    echo $exception->getMainMessage();
}
?>
--EXPECTF--
`[object] (stdClass: { })` must not be an object
