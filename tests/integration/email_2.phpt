--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\EmailException;
use Respect\Validation\Validator as v;

try {
    v::email()->check('batman');
} catch (EmailException $e) {
    echo $e->getMainMessage();
}
?>
--EXPECTF--
"batman" must be valid email
