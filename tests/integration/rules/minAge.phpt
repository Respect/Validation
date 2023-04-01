--CREDITS--
Emmerson Siqueira <emmersonsiqueira@gmail.com>
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

date_default_timezone_set('UTC');

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::minAge(18)->check('17 years ago'));
exceptionMessage(static fn() => v::not(v::minAge(18))->check('-30 years'));
exceptionFullMessage(static fn() => v::minAge(18)->assert('yesterday'));
exceptionFullMessage(static fn() => v::minAge(18, 'd/m/Y')->assert('12/10/2010'));
?>
--EXPECT--
"17 years ago" must be 18 years or more
"-30 years" must not be 18 years or more
- "yesterday" must be 18 years or more
- "12/10/2010" must be 18 years or more
