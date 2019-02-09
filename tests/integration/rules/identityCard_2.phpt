--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require_once 'vendor/autoload.php';

use Respect\Validation\Exceptions\Locale\PlIdentityCardException;
use Respect\Validation\Validator as v;

try {
    v::identityCard('PL')->check('AYE205411');
} catch (PlIdentityCardException $e) {
    echo $e->getMessage();
}
?>
--EXPECT--
"AYE205411" must be a valid Polish Identity Card number
