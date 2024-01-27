--CREDITS--
Mazen Touati <mazen_touati@hotmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::iban()->check('SE35 5000 5880 7742'));
exceptionMessage(static fn() => v::not(v::iban())->check('GB82 WEST 1234 5698 7654 32'));
exceptionFullMessage(static fn() => v::iban()->assert('NOT AN IBAN'));
exceptionFullMessage(static fn() => v::not(v::iban())->assert('HU93 1160 0006 0000 0000 1234 5676'));?>
--SKIPIF--
<?php
if (!extension_loaded('bcmath')) {
    echo 'skip: Extension "bcmath" is required to execute this test';
}
?>
--EXPECT--
"SE35 5000 5880 7742" must be a valid IBAN
"GB82 WEST 1234 5698 7654 32" must not be a valid IBAN
- "NOT AN IBAN" must be a valid IBAN
- "HU93 1160 0006 0000 0000 1234 5676" must not be a valid IBAN
