--FILE--
<?php

require_once 'vendor/autoload.php';

use Respect\Validation\Exceptions\PeselException;
use Respect\Validation\Validator as v;

try {
    v::not(v::pesel())->assert('21120209256');
} catch (PeselException $e) {
    echo $e->getMainMessage();
}
?>
--EXPECTF--
"21120209256" must not be a valid PESEL
