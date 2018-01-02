--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\AllOfException;
use Respect\Validation\Exceptions\NullTypeException;
use Respect\Validation\Validator as v;

try {
    v::not(v::nullType())->check(null);
} catch (NullTypeException $e) {
    echo $e->getMainMessage().PHP_EOL;
}

try {
    v::not(v::nullType())->assert(null);
} catch (AllOfException $e) {
    echo $e->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
`NULL` must not be null
- `NULL` must not be null
