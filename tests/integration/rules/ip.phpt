--CREDITS--
Danilo Benevides <danilobenevides01@gmail.com>
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::ip()->check('257.0.0.1'));
exceptionMessage(static fn() => v::not(v::ip())->check('127.0.0.1'));
exceptionMessage(static fn() => v::ip('127.0.1.*')->check('127.0.0.1'));
exceptionMessage(static fn() => v::not(v::ip('127.0.1.*'))->check('127.0.1.1'));
exceptionFullMessage(static fn() => v::ip()->assert('257.0.0.1'));
exceptionFullMessage(static fn() => v::not(v::ip())->assert('127.0.0.1'));
exceptionFullMessage(static fn() => v::ip('127.0.1.*')->assert('127.0.0.1'));
exceptionFullMessage(static fn() => v::not(v::ip('127.0.1.*'))->assert('127.0.1.1'));?>
--SKIPIF--
<?php
if (!extension_loaded('bcmath')) {
    echo 'skip: Extension "bcmath" is required to execute this test';
}
?>
--EXPECT--
"257.0.0.1" must be an IP address
"127.0.0.1" must not be an IP address
"127.0.0.1" must be an IP address in the "127.0.1.0-127.0.1.255" range
"127.0.1.1" must not be an IP address in the "127.0.1.0-127.0.1.255" range
- "257.0.0.1" must be an IP address
- "127.0.0.1" must not be an IP address
- "127.0.0.1" must be an IP address in the "127.0.1.0-127.0.1.255" range
- "127.0.1.1" must not be an IP address in the "127.0.1.0-127.0.1.255" range
