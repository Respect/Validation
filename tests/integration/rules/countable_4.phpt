--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\CountableException;
use Respect\Validation\Validator as v;

try {
    v::not(v::countable())->check([]);
} catch (CountableException $e) {
    echo $e->getMainMessage();
}
?>
--EXPECTF--
{ } must not be countable
