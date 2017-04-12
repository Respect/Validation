# StartsWith

- `StartsWith(mixed $value)`
- `StartsWith(mixed $value, bool $identical)`

This validator is similar to `Contains()`, but validates
only if the value is at the beginning of the input.

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

## Changelog

Version | Description
--------|-------------
  0.3.9 | Created

***
See also:

- [EndsWith](EndsWith.md)
- [Contains](Contains.md)
- [In](In.md)
