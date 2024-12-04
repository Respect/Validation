--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::containsAny(['foo', 'bar'])->assert('baz'));
exceptionMessage(static fn() => v::not(v::containsAny(['foo', 'bar']))->assert('fool'));
exceptionFullMessage(static fn() => v::containsAny(['foo', 'bar'])->assert(['baz']));
exceptionFullMessage(static fn() => v::not(v::containsAny(['foo', 'bar'], true))->assert(['bar', 'foo']));
?>
--EXPECT--
"baz" must contain at least one value from `["foo", "bar"]`
"fool" must not contain any value from `["foo", "bar"]`
- `["baz"]` must contain at least one value from `["foo", "bar"]`
- `["bar", "foo"]` must not contain any value from `["foo", "bar"]`