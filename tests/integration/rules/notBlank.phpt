--CREDITS--
Danilo Correa <danilosilva87@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::notBlank()->check(null));
exceptionMessage(static fn() => v::notBlank()->setName('Field')->check(null));
exceptionMessage(static fn() => v::not(v::notBlank())->check(1));
exceptionFullMessage(static fn() => v::notBlank()->assert(''));
exceptionFullMessage(static fn() => v::notBlank()->setName('Field')->assert(''));
exceptionFullMessage(static fn() => v::not(v::notBlank())->assert([1]));
?>
--EXPECT--
The value must not be blank
Field must not be blank
1 must be blank
- The value must not be blank
- Field must not be blank
- `{ 1 }` must be blank
