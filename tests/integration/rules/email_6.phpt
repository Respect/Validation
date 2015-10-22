--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\EmailException;
use Respect\Validation\Validator as v;

try {
    v::email()->check('iambatman@gothancity..com');
} catch (EmailException $e) {
    echo $e->getMainMessage();
}
?>
--EXPECTF--
"iambatman@gothancity..com" must be valid email
