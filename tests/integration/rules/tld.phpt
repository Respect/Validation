--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::tld()->assert('42'));
exceptionMessage(static fn() => v::not(v::tld())->assert('com'));
exceptionFullMessage(static fn() => v::tld()->assert('1984'));
exceptionFullMessage(static fn() => v::not(v::tld())->assert('com'));
?>
--EXPECT--
"42" must be a valid top-level domain name
"com" must not be a valid top-level domain name
- "1984" must be a valid top-level domain name
- "com" must not be a valid top-level domain name
