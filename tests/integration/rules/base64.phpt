--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\Base64Exception;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::base64()->check('=c3VyZS4');
} catch (Base64Exception $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::base64())->check('c3VyZS4=');
} catch (Base64Exception $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::base64()->assert('=c3VyZS4');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::base64())->assert('c3VyZS4=');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
"=c3VyZS4" must be Base64-encoded
"c3VyZS4=" must not be Base64-encoded
- "=c3VyZS4" must be Base64-encoded
- "c3VyZS4=" must not be Base64-encoded
