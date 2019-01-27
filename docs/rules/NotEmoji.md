# NotEmoji

- `v::notEmoji()`

Validates if the given input does not contain an Emoji

```php
v::notEmoji()->validate('🍕');                           //false
v::notEmoji()->validate('🎈');                           //false
v::notEmoji()->validate('⚡');                           //false
v::notEmoji()->validate('this is a spark ⚡');           //false
v::notEmoji()->validate('🌊🌊🌊🌊🌊🏄🌊🌊🌊🏖🌴');     //false

v::notEmoji()->validate('Hello World, without emoji');    //true
```

Please consider that the performance of this validator is linear which means the longer the text the longer it takes to perform the check. Though, The validator will break the execution as soon as it finds the first emoji or until it checks the whole text.

*Note: this validator will check the Emoji as they are defined in Unicode V11*
*check the following link for more details [Unicode v11](https://unicode.org/emoji/charts/full-emoji-list.html)*
