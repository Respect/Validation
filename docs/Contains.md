# Contains

- `Contains(mixed $expectedValue)`
- `Contains(mixed $expectedValue, bool $identical)`

Validates if the input contains some value.

For strings:

```php
v::contains('ipsum')->validate('lorem ipsum'); // true
```

For arrays:

```php
v::contains('ipsum')->validate(['ipsum', 'lorem']); // true
```

A second parameter may be passed for identical comparison instead
of equal comparison.

Message template for this validator includes `{{containsValue}}`.

## Changelog

Version | Description
--------|-------------
  0.3.9 | Created

***
See also:

- [StartsWith](StartsWith.md)
- [EndsWith](EndsWith.md)
- [In](In.md)
