--FILE--
<?php

require_once 'vendor/autoload.php';

use Respect\Validation\Exceptions\IdentityCardException;
use Respect\Validation\Validator as v;

try {
    v::not(v::identityCard('PL'))->check('AYE205410');
} catch (IdentityCardException $e) {
    echo $e->getMainMessage();
}
?>
--EXPECTF--
"AYE205410" must not be a valid Identity Card number for "PL"
