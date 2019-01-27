--CREDITS--
Mazen Touati <mazen_touati@hotmail.com>
--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\NotEmojiException;
use Respect\Validation\Exceptions\AllOfException;

$notEmojiValues = [
    'Hello World, without emoji',
    'مرحبا جميعا',
    'こんにちは世界',
];

//Check not emoji values
foreach ($notEmojiValues as $value) {
  v::notEmoji()->assert($value);
  v::notEmoji()->check($value);
}

$emojiValues = [
    '🍕',
    [
      'field' => 'fullName',
      'value' => 'this is a spark ⚡'
    ],
    '🌊🌊🌊🌊🌊🏄🌊🌊🌊🏖🌴',
];

//Check emoji values

// check
foreach ($emojiValues as $value) {
  try {
    if (is_array($value)) {
      v::notEmoji()->setName($value['field'])->check($value['value']);
    } else {
      v::notEmoji()->check($value);
    }
  } catch (NotEmojiException $e) {
    echo $e->getMessage().PHP_EOL;
  }
}

// check negation
foreach ($notEmojiValues as $value) {
  try {
    if (is_array($value)) {
      v::not(v::notEmoji())->setName($value['field'])->check($value['value']);
    } else {
      v::not(v::notEmoji())->check($value);
    }
  } catch (NotEmojiException $e) {
    echo $e->getMessage().PHP_EOL;
  }
}

// assert
foreach ($emojiValues as $value) {
  try {
    if (is_array($value)) {
      v::notEmoji()->setName($value['field'])->assert($value['value']);
    } else {
      v::notEmoji()->assert($value);
    }
  } catch (AllOfException $e) {
    echo $e->getFullMessage().PHP_EOL;
  }
}

?>
--EXPECT--
"🍕" must not contain an Emoji
fullName must not contain an Emoji
"🌊🌊🌊🌊🌊🏄🌊🌊🌊🏖🌴" must not contain an Emoji
"Hello World, without emoji" must contain an Emoji
"مرحبا جميعا" must contain an Emoji
"こんにちは世界" must contain an Emoji
- "🍕" must not contain an Emoji
- fullName must not contain an Emoji
- "🌊🌊🌊🌊🌊🏄🌊🌊🌊🏖🌴" must not contain an Emoji
