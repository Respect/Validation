--CREDITS--
William Espindola <oi@williamespindola.com.br>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::countryCode()->check('1'));
exceptionMessage(static fn() => v::not(v::countryCode())->check('BR'));
exceptionFullMessage(static fn() => v::countryCode()->assert('1'));
exceptionFullMessage(static fn() => v::not(v::countryCode())->assert('BR'));
?>
--EXPECT--
"1" must be a valid country
"BR" must not be a valid country
- "1" must be a valid country
- "BR" must not be a valid country
