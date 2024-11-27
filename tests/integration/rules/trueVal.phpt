--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::trueVal()->check(false));
exceptionMessage(static fn() => v::not(v::trueVal())->check(1));
exceptionFullMessage(static fn() => v::trueVal()->assert(0));
exceptionFullMessage(static fn() => v::not(v::trueVal())->assert('true'));
?>
--EXPECT--
`false` must evaluate to `true`
1 must not evaluate to `true`
- 0 must evaluate to `true`
- "true" must not evaluate to `true`
