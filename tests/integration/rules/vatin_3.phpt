--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
Tomasz Regdos <tomek@regdos.com>
--FILE--
<?php

declare(strict_types=1);

require_once 'vendor/autoload.php';

use Respect\Validation\Exceptions\AllOfException;
use Respect\Validation\Validator as v;

try {
    v::vatin('PL')->assert('1645865778');
} catch (AllOfException $e) {
    echo $e->getFullMessage();
}
?>
--EXPECT--
- "1645865778" must be a valid Polish VAT identification number
