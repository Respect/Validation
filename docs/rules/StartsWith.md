# StartsWith

- `StartsWith(mixed $value)`
- `StartsWith(mixed $value, bool $identical)`

Validates whether the input starts with a given value.

This validator is similar to [Contains](Contains.md), but validates only
if the value is at the beginning of the input.

For strings:

```php
v::startsWith('lorem')->validate('lorem ipsum'); // true
```

For arrays:

```php
v::startsWith('lorem')->validate(['lorem', 'ipsum']); // true
```

`true` may be passed as a parameter to indicate identical comparison
instead of equal.

Message template for this validator includes `{{startValue}}`.

## Categorization

- Arrays
- Strings

## Changelog

Version | Description
--------|-------------
  0.3.9 | Created

***
See also:

- [Contains](Contains.md)
- [EndsWith](EndsWith.md)
- [In](In.md)
- [Regex](Regex.md)
