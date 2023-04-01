--CREDITS--
Danilo Correa <danilosilva87@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::falseVal()->check(true));
exceptionMessage(static fn() => v::not(v::falseVal())->check('false'));
exceptionFullMessage(static fn() => v::falseVal()->assert(1));
exceptionFullMessage(static fn() => v::not(v::falseVal())->assert(0));
?>
--EXPECT--
`TRUE` must evaluate to `false`
"false" must not evaluate to `false`
- 1 must evaluate to `false`
- 0 must not evaluate to `false`
