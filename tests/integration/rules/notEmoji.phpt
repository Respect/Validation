--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::notEmoji()->assert('🍕'));
exceptionMessage(static fn() => v::not(v::notEmoji())->assert('AB'));
exceptionFullMessage(static fn() => v::notEmoji()->assert('🏄'));
exceptionFullMessage(static fn() => v::not(v::notEmoji())->assert('YZ'));
?>
--EXPECT--
"🍕" must not contain an Emoji
"AB" must contain an Emoji
- "🏄" must not contain an Emoji
- "YZ" must contain an Emoji
