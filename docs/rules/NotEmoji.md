# NotEmoji

- `v::notEmoji()`

Validates if the input does not contain an emoji.

```php
v::notEmoji()->isValid('Hello World, without emoji'); // true
v::notEmoji()->isValid('🍕'); // false
v::notEmoji()->isValid('🎈'); // false
v::notEmoji()->isValid('⚡'); // false
v::notEmoji()->isValid('this is a spark ⚡'); // false
v::notEmoji()->isValid('🌊🌊🌊🌊🌊🏄🌊🌊🌊🏖🌴'); // false
```

Please consider that the performance of this validator is linear which
means the longer the text the longer it takes to perform the check.
However, the validator will break the execution as soon as it finds the
first emoji or until it checks the whole text.

*Note: this validator will check the Emoji as they are defined in
Unicode V11 check the following link for more details
[Unicode v11](https://unicode.org/emoji/charts/full-emoji-list.html)*

## Categorization

- Strings

## Changelog

Version | Description
--------|-------------
  2.0.0 | Created

***
See also:

- [Alnum](Alnum.md)
- [Alpha](Alpha.md)
- [Decimal](Decimal.md)
- [Digit](Digit.md)
