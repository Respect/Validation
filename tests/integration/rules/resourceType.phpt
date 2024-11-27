--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::resourceType()->check('test'));
exceptionMessage(static fn() => v::not(v::resourceType())->check(tmpfile()));
exceptionFullMessage(static fn() => v::resourceType()->assert([]));
exceptionFullMessage(static fn() => v::not(v::resourceType())->assert(tmpfile()));
?>
--EXPECT--
"test" must be a resource
`resource <stream>` must not be a resource
- `[]` must be a resource
- `resource <stream>` must not be a resource
