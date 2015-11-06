--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\AllOfException;
use Respect\Validation\Validator as v;

try {
    v::not(v::iterable())->assert(new stdClass());
} catch (AllOfException $exception) {
    echo $exception->getFullMessage();
}

?>
--EXPECTF--
- `[object] (stdClass: { })` must not be iterable
