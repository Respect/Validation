--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\AllOfException;
use Respect\Validation\Validator as v;

try {
    v::not(v::email())->assert('iambatman@gothancity.com');
} catch (AllOfException $e) {
    echo $e->getFullMessage();
}
?>
--EXPECTF--
- "iambatman@gothancity.com" must not be an email
