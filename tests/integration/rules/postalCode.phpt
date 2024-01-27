--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::postalCode('BR')->check('1057BV'));
exceptionMessage(static fn() => v::not(v::postalCode('NL'))->check('1057BV'));
exceptionFullMessage(static fn() => v::postalCode('BR')->assert('1057BV'));
exceptionFullMessage(static fn() => v::not(v::postalCode('NL'))->assert('1057BV'));
?>
--EXPECT--
"1057BV" must be a valid postal code on "BR"
"1057BV" must not be a valid postal code on "NL"
- "1057BV" must be a valid postal code on "BR"
- "1057BV" must not be a valid postal code on "NL"
