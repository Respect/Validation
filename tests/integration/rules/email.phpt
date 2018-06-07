--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\EmailException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::email()->check('batman');
} catch (EmailException $e) {
    echo $e->getMessage().PHP_EOL;
}

try {
    v::not(v::email())->check('bruce.wayne@gothancity.com');
} catch (EmailException $e) {
    echo $e->getMessage().PHP_EOL;
}

try {
    v::email()->assert('bruce wayne');
} catch (NestedValidationException $e) {
    echo $e->getFullMessage().PHP_EOL;
}

try {
    v::not(v::email())->assert('iambatman@gothancity.com');
} catch (NestedValidationException $e) {
    echo $e->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
"batman" must be valid email
"bruce.wayne@gothancity.com" must not be an email
- "bruce wayne" must be valid email
- "iambatman@gothancity.com" must not be an email
