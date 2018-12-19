--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

require_once 'vendor/autoload.php';

use Respect\Validation\Exceptions\AllOfException;
use Respect\Validation\Validator as v;

try {
    v::identityCard('PL')->assert('AYE205411');
} catch (AllOfException $e) {
    echo $e->getFullMessage();
}
?>
--EXPECT--
- "AYE205411" must be a valid Polish Identity Card number
