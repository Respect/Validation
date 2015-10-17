--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\AllOfException;

try {
    v::yes()->assert(null);
} catch (AllOfException $e) {
    echo $e->getFullMessage();
}
?>
--EXPECTF--
\-null is not considered as "Yes"
