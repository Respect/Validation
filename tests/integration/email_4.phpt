--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\EmailException;

try {
    v::not(v::email())->check('bruce.wayne@gothancity.com');
} catch (EmailException $e) {
    echo $e->getMainMessage();
}
?>
--EXPECTF--
"bruce.wayne@gothancity.com" must not be an email