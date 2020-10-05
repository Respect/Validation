# Decimal

- `Decimal(int $decimals)`

Validates whether the input matches the expected number of decimals.

```php
v::decimals(2)->validate('27990.50'); // true
v::decimals(1)->validate('27990.50'); // false
v::decimal(1)->validate(1.5); // true

```

## Known limitations

When validating float types, it is not possible to determine the amount of
ending zeros and because of that, validations like the ones below will pass.

```php
v::decimal(1)->validate(1.50); // true
```

## Categorization

- Numbers

## Changelog

Version | Description
--------|-------------
  2.0.0 | Created

***
See also:

- [Alnum](Alnum.md)
- [Alpha](Alpha.md)
- [Consonant](Consonant.md)
- [CreditCard](CreditCard.md)
- [Factor](Factor.md)
- [Finite](Finite.md)
- [Infinite](Infinite.md)
- [IntType](IntType.md)
- [IntVal](IntVal.md)
- [NotEmoji](NotEmoji.md)
- [NumericVal](NumericVal.md)
- [Regex](Regex.md)
- [Uuid](Uuid.md)
- [Vowel](Vowel.md)
- [Xdigit](Xdigit.md)
