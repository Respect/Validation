# EndsWith

- `EndsWith(mixed $value)`
- `EndsWith(mixed $value, bool $identical)`

This validator is similar to `Contains()`, but validates
only if the value is at the end of the input.

For strings:

```php
v::endsWith('ipsum')->validate('lorem ipsum'); // true
```

For arrays:

```php
v::endsWith('ipsum')->validate(['lorem', 'ipsum']); // true
```

A second parameter may be passed for identical comparison instead
of equal comparison.

Message template for this validator includes `{{endValue}}`.

## Changelog

Version | Description
--------|-------------
  0.3.9 | Created

***
See also:

- [StartsWith](StartsWith.md)
- [Contains](Contains.md)
- [In](In.md)
