--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\EmailException;

try {
    v::email()->check('batman');
} catch (EmailException $e) {
    echo $e->getMainMessage();
}
?>
--EXPECTF--
"batman" must be valid email
