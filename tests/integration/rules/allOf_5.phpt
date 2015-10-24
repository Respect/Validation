--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\AllOfException;
use Respect\Validation\Validator as v;

try {
    v::not(v::allOf(v::stringType(), v::length(10)))->assert('Frank Zappa is fantastic');
} catch (AllOfException $e) {
    echo $e->getFullMessage();
}
?>
--EXPECTF--
- "Frank Zappa is fantastic" must not be string
