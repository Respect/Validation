--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::equivalent(true)->assert(false));
exceptionMessage(static fn() => v::not(v::equivalent('Something'))->assert('someThing'));
exceptionFullMessage(static fn() => v::equivalent(123)->assert('true'));
exceptionFullMessage(static fn() => v::not(v::equivalent(true))->assert(1));
?>
--EXPECT--
`false` must be equivalent to `true`
"someThing" must not be equivalent to "Something"
- "true" must be equivalent to 123
- 1 must not be equivalent to `true`
