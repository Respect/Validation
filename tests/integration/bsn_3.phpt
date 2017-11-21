--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\BsnException;
use Respect\Validation\Validator as v;

try {
    v::bsn()->assert(null);
} catch (BsnException $e) {
    echo $e->getMainMessage();
}
?>
--EXPECTF--
`NULL` must be a BSN
