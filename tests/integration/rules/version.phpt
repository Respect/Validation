--CREDITS--
Danilo Correa <danilosilva87@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::version()->check('1.3.7--'));
exceptionMessage(static fn() => v::not(v::version())->check('1.0.0-alpha'));
exceptionFullMessage(static fn() => v::version()->assert('1.2.3.4-beta'));
exceptionFullMessage(static fn() => v::not(v::version())->assert('1.3.7-rc.1'));
?>
--EXPECT--
"1.3.7--" must be a version
"1.0.0-alpha" must not be a version
- "1.2.3.4-beta" must be a version
- "1.3.7-rc.1" must not be a version
