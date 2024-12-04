--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::notEmoji()->assert('🍕'));
exceptionMessage(static fn() => v::not(v::notEmoji())->assert('AB'));
exceptionFullMessage(static fn() => v::notEmoji()->assert('🏄'));
exceptionFullMessage(static fn() => v::not(v::notEmoji())->assert('YZ'));
?>
--EXPECT--
"🍕" must not contain an emoji
"AB" must contain an emoji
- "🏄" must not contain an emoji
- "YZ" must contain an emoji