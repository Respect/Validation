--CREDITS--
Cameron Hall <me@chall.id.au>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::not(v::yes())->check('Yes'));
exceptionMessage(static fn() => v::yes()->check('si'));
exceptionFullMessage(static fn() => v::not(v::yes())->assert('Yes'));
exceptionFullMessage(static fn() => v::yes()->assert('si'));
?>
--EXPECT--
"Yes" must not be similar to "Yes"
"si" must be similar to "Yes"
- "Yes" must not be similar to "Yes"
- "si" must be similar to "Yes"
