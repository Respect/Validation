--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::filterVar(FILTER_VALIDATE_IP)->check(42));
exceptionMessage(static fn() => v::not(v::filterVar(FILTER_VALIDATE_BOOLEAN))->check('On'));
exceptionFullMessage(static fn() => v::filterVar(FILTER_VALIDATE_EMAIL)->assert(1.5));
exceptionFullMessage(static fn() => v::not(v::filterVar(FILTER_VALIDATE_FLOAT))->assert(1.0));
?>
--EXPECT--
42 must be valid
"On" must not be valid
- 1.5 must be valid
- 1.0 must not be valid
