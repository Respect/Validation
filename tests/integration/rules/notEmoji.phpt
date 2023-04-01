--CREDITS--
Mazen Touati <mazen_touati@hotmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::notEmoji()->check('🍕'));
exceptionMessage(static fn() => v::not(v::notEmoji())->check('AB'));
exceptionFullMessage(static fn() => v::notEmoji()->assert('🏄'));
exceptionFullMessage(static fn() => v::not(v::notEmoji())->assert('YZ'));
?>
--EXPECT--
"🍕" must not contain an Emoji
"AB" must contain an Emoji
- "🏄" must not contain an Emoji
- "YZ" must contain an Emoji
