--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::graph()->assert("foo\nbar"));
exceptionMessage(static fn() => v::graph('foo')->assert("foo\nbar"));
exceptionMessage(static fn() => v::not(v::graph())->assert('foobar'));
exceptionMessage(static fn() => v::not(v::graph("\n"))->assert("foo\nbar"));
exceptionFullMessage(static fn() => v::graph()->assert("foo\nbar"));
exceptionFullMessage(static fn() => v::graph('foo')->assert("foo\nbar"));
exceptionFullMessage(static fn() => v::not(v::graph())->assert('foobar'));
exceptionFullMessage(static fn() => v::not(v::graph("\n"))->assert("foo\nbar"));
?>
--EXPECT--
"foo\nbar" must contain only graphical characters
"foo\nbar" must contain only graphical characters and "foo"
"foobar" must not contain graphical characters
"foo\nbar" must not contain graphical characters or "\n"
- "foo\nbar" must contain only graphical characters
- "foo\nbar" must contain only graphical characters and "foo"
- "foobar" must not contain graphical characters
- "foo\nbar" must not contain graphical characters or "\n"
