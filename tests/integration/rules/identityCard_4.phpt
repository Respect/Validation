--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require_once 'vendor/autoload.php';

use Respect\Validation\Exceptions\IdentityCardException;
use Respect\Validation\Validator as v;

try {
    v::not(v::identityCard('PL'))->check('AYE205410');
} catch (IdentityCardException $e) {
    echo $e->getMessage();
}
?>
--EXPECT--
"AYE205410" must not be a valid Identity Card number for "PL"
