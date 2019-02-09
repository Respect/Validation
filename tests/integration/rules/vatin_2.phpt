--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
Tomasz Regdos <tomek@regdos.com>
--FILE--
<?php

declare(strict_types=1);

require_once 'vendor/autoload.php';

use Respect\Validation\Exceptions\Locale\PlVatinException;
use Respect\Validation\Validator as v;

try {
    v::vatin('PL')->check('1645865778');
} catch (PlVatinException $e) {
    echo $e->getMessage();
}
?>
--EXPECT--
"1645865778" must be a valid Polish VAT identification number
