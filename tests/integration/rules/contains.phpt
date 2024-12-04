--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::contains('foo')->assert('bar'));
exceptionMessage(static fn() => v::not(v::contains('foo'))->assert('fool'));
exceptionFullMessage(static fn() => v::contains('foo')->assert(['bar']));
exceptionFullMessage(static fn() => v::not(v::contains('foo', true))->assert(['bar', 'foo']));
?>
--EXPECT--
"bar" must contain "foo"
"fool" must not contain "foo"
- `["bar"]` must contain "foo"
- `["bar", "foo"]` must not contain "foo"