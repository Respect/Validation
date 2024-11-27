--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::resourceType()->assert('test'));
exceptionMessage(static fn() => v::not(v::resourceType())->assert(tmpfile()));
exceptionFullMessage(static fn() => v::resourceType()->assert([]));
exceptionFullMessage(static fn() => v::not(v::resourceType())->assert(tmpfile()));
?>
--EXPECT--
"test" must be a resource
`resource <stream>` must not be a resource
- `[]` must be a resource
- `resource <stream>` must not be a resource
