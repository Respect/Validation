--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\UuidException;
use Respect\Validation\Rules\Uuid;
use Respect\Validation\Validator as v;

v::uuid()->check('3b152a69-5117-4612-aa30-cacd114cfbc4');
v::uuid(Uuid::VERSION_3)->check('3b152a69-5117-3612-aa30-cacd114cfbc4');

try {
    v::uuid()->check('4785effc-383b-6507-b27a-3db6369060b9');
} catch (UuidException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::uuid(Uuid::VERSION_2)->check('3111e7ae-3ce2-4ea8-b9e5-371345f8552a');
} catch (UuidException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

?>
--EXPECTF--
"4785effc-383b-6507-b27a-3db6369060b9" must be a valid UUID
"3111e7ae-3ce2-4ea8-b9e5-371345f8552a" must be a valid UUID
