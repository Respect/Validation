--CREDITS--
Paul Karikari <paulkarikari1@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::even()->check(-1));
exceptionFullMessage(static fn() => v::even()->assert(5));
exceptionMessage(static fn() => v::not(v::even())->check(6));
exceptionFullMessage(static fn() => v::not(v::even())->assert(8));
?>
--EXPECT--
-1 must be an even number
- 5 must be an even number
6 must not be an even number
- 8 must not be an even number
