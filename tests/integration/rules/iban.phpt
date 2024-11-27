--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::iban()->assert('SE35 5000 5880 7742'));
exceptionMessage(static fn() => v::not(v::iban())->assert('GB82 WEST 1234 5698 7654 32'));
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
