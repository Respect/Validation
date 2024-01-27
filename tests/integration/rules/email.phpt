--CREDITS--
Paul Karikari <paulkarikari1@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::email()->check('batman'));
exceptionMessage(static fn() => v::not(v::email())->check('bruce.wayne@gothancity.com'));
exceptionFullMessage(static fn() => v::email()->assert('bruce wayne'));
exceptionFullMessage(static fn() => v::not(v::email())->assert('iambatman@gothancity.com'));
?>
--EXPECT--
"batman" must be valid email
"bruce.wayne@gothancity.com" must not be an email
- "bruce wayne" must be valid email
- "iambatman@gothancity.com" must not be an email
