--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::not(v::no())->check('No'));
exceptionMessage(static fn() => v::no()->check('Yes'));
exceptionFullMessage(static fn() => v::not(v::no())->assert('No'));
exceptionFullMessage(static fn() => v::no()->assert('Yes'));
?>
--EXPECT--
"No" must not be similar to "No"
"Yes" must be similar to "No"
- "No" must not be similar to "No"
- "Yes" must be similar to "No"
