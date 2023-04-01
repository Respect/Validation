--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
Tomasz Regdos <tomek@regdos.com>
--FILE--
<?php

declare(strict_types=1);

require_once 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::nip()->check('1645865778'));
exceptionMessage(static fn() => v::not(v::nip())->check('1645865777'));
exceptionFullMessage(static fn() => v::nip()->assert('1645865778'));
exceptionFullMessage(static fn() => v::not(v::nip())->assert('1645865777'));
?>
--EXPECT--
"1645865778" must be a valid Polish VAT identification number
"1645865777" must not be a valid Polish VAT identification number
- "1645865778" must be a valid Polish VAT identification number
- "1645865777" must not be a valid Polish VAT identification number
