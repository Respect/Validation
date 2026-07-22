--CREDITS--
Ville Hukkamäki <vhukkamaki@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::hetu()->check('not a hetu'));
exceptionMessage(static fn() => v::not(v::hetu())->check('010106A9012'));
exceptionFullMessage(static fn() => v::hetu()->assert('not a hetu'));
exceptionFullMessage(static fn() => v::not(v::hetu())->assert('010106A9012'));
?>
--EXPECT--
"not a hetu" must be a valid Finnish personal identity code
"010106A9012" must not be a valid Finnish personal identity code
- "not a hetu" must be a valid Finnish personal identity code
- "010106A9012" must not be a valid Finnish personal identity code
