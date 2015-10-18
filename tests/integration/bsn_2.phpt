--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\BsnException;
use Respect\Validation\Validator as v;

try {
    v::bsn()->check('acb');
} catch (BsnException $e) {
    echo $e->getMainMessage();
}
?>
--EXPECTF--
"acb" must be a BSN
