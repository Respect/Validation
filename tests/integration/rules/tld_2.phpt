--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\TldException;
use Respect\Validation\Validator as v;

try {
    v::tld()->check('42');
} catch (TldException $exception) {
    echo $exception->getMainMessage();
}
?>
--EXPECTF--
"42" must be a valid top-level domain name
