--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::slug()->assert('my-Slug'));
exceptionMessage(static fn() => v::not(v::slug())->assert('my-slug'));
exceptionFullMessage(static fn() => v::slug()->assert('my-Slug'));
exceptionFullMessage(static fn() => v::not(v::slug())->assert('my-slug'));
?>
--EXPECT--
"my-Slug" must be a valid slug
"my-slug" must not be a valid slug
- "my-Slug" must be a valid slug
- "my-slug" must not be a valid slug
