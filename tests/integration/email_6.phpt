--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\EmailException;

try {
    v::email()->check('iambatman@gothancity..com');
} catch (EmailException $e) {
    echo $e->getMainMessage();
}
?>
--EXPECTF--
"iambatman@gothancity..com" must be valid email
