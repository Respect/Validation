--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::callback('is_string')->assert([]));
exceptionMessage(static fn() => v::not(v::callback('is_string'))->assert('foo'));
exceptionFullMessage(static fn() => v::callback('is_string')->assert(true));
exceptionFullMessage(static fn() => v::not(v::callback('is_string'))->assert('foo'));
?>
--EXPECT--
`[]` must be valid
"foo" must not be valid
- `true` must be valid
- "foo" must not be valid
