--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\ArrayValException;
use Respect\Validation\Validator as v;

try {
    v::not(v::arrayVal())->assert([42]);
} catch (ArrayValException $exception) {
    echo $exception->getMainMessage();
}
?>
--EXPECTF--
`{ 42 }` must not be an array
