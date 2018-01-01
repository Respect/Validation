--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\AllOfException;
use Respect\Validation\Validator as v;

try {
    v::not(v::arrayType())->assert([1, 2, 3]);
} catch (AllOfException $exception) {
    echo $exception->getFullMessage();
}
?>
--EXPECTF--
- `{ 1, 2, 3 }` must not be of the type array
