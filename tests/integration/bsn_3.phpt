--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\BsnException;

try {
    v::bsn()->check(null);
} catch (BsnException $e) {
    echo $e->getMainMessage();
}
?>
--EXPECTF--
null must be a BSN
