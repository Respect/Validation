--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\AllOfException;
use Respect\Validation\Exceptions\Base64Exception;
use Respect\Validation\Validator as v;

try {
    v::base64()->check('=c3VyZS4');
} catch (Base64Exception $exception) {
    echo $exception->getMainMessage().PHP_EOL;
}

try {
    v::base64()->assert('=c3VyZS4');
} catch (AllOfException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
"=c3VyZS4" must be Base64-encoded
- "=c3VyZS4" must be Base64-encoded
