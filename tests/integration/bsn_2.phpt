--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\BsnException;

try {
    v::bsn()->check('acb');
} catch (BsnException $e) {
    echo $e->getMainMessage();
}
?>
--EXPECTF--
"acb" must be a BSN
