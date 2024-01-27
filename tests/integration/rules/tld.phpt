--CREDITS--
Paul Karikari <paulkarikari1@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::tld()->check('42'));
exceptionMessage(static fn() => v::not(v::tld())->check('com'));
exceptionFullMessage(static fn() => v::tld()->assert('1984'));
exceptionFullMessage(static fn() => v::not(v::tld())->assert('com'));
?>
--EXPECT--
"42" must be a valid top-level domain name
"com" must not be a valid top-level domain name
- "1984" must be a valid top-level domain name
- "com" must not be a valid top-level domain name
