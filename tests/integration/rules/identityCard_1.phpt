--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require_once 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::identityCard('PL')->check('AYE205410');
v::identityCard('PL')->assert('AYE205410');
?>
--EXPECT--
