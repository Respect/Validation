--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\AllOfException;

try {
    v::iterable()->assert(4);
} catch (AllOfException $exception) {
    echo $exception->getFullMessage();
}

?>
--EXPECTF--
\-4 is not a valid iterable instance
