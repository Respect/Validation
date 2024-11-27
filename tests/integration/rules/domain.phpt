--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::domain()->assert('batman'));
exceptionMessage(static fn() => v::not(v::domain())->assert('r--w.com'));
exceptionFullMessage(static fn() => v::domain()->assert('p-éz-.kk'));
exceptionFullMessage(static fn() => v::not(v::domain())->assert('github.com'));
?>
--EXPECT--
"batman" must be a valid domain
"r--w.com" must not be a valid domain
- "p-éz-.kk" must be a valid domain
- "github.com" must not be a valid domain
