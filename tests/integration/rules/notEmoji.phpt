--CREDITS--
Mazen Touati <mazen_touati@hotmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\NotEmojiException;
use Respect\Validation\Validator as v;

try {
    v::notEmoji()->check('🍕');
} catch (NotEmojiException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::not(v::notEmoji())->check('AB');
} catch (NotEmojiException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::notEmoji()->assert('🏄');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

try {
    v::not(v::notEmoji())->assert('YZ');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}
?>
--EXPECT--
"🍕" must not contain an Emoji
"AB" must contain an Emoji
- "🏄" must not contain an Emoji
- "YZ" must contain an Emoji
