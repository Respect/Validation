--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
Jens Segers <segers.jens@gmail.com>
William Espindola <oi@williamespindola.com.br>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::base64()->check('=c3VyZS4'));
exceptionMessage(static fn() => v::not(v::base64())->check('c3VyZS4='));
exceptionFullMessage(static fn() => v::base64()->assert('=c3VyZS4'));
exceptionFullMessage(static fn() => v::not(v::base64())->assert('c3VyZS4='));
?>
--EXPECT--
"=c3VyZS4" must be Base64-encoded
"c3VyZS4=" must not be Base64-encoded
- "=c3VyZS4" must be Base64-encoded
- "c3VyZS4=" must not be Base64-encoded
