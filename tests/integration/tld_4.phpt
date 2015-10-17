--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\TldException;

try {
    v::not(v::tld())->check('com');
} catch (TldException $exception) {
    echo $exception->getMainMessage();
}
?>
--EXPECTF--
"com" must not be a valid top-level domain name
