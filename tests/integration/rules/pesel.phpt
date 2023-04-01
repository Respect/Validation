--CREDITS--
Danilo Correa <danilosilva87@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require_once 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::pesel()->check('21120209251'));
exceptionMessage(static fn() => v::not(v::pesel())->check('21120209256'));
exceptionFullMessage(static fn() => v::pesel()->assert('21120209251'));
exceptionFullMessage(static fn() => v::not(v::pesel())->assert('21120209256'));
?>
--EXPECT--;
"21120209251" must be a valid PESEL
"21120209256" must not be a valid PESEL
- "21120209251" must be a valid PESEL
- "21120209256" must not be a valid PESEL
