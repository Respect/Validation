# In

- `In(mixed $haystack)`
- `In(mixed $haystack, bool $identical)`

Validates if the input is contained in a specific haystack.

For strings:

```php
v::in('lorem ipsum')->isValid('ipsum'); // true
```

For arrays:

```php
v::in(['lorem', 'ipsum'])->isValid('lorem'); // true
```

A second parameter may be passed for identical comparison instead
of equal comparison.

Message template for this validator includes `{{haystack}}`.

## Categorization

- Arrays
- Comparisons
- Strings

## Changelog

Version | Description
--------|-------------
  0.3.9 | Created

***
See also:

- [Contains](Contains.md)
- [ContainsAny](ContainsAny.md)
- [EndsWith](EndsWith.md)
- [Roman](Roman.md)
- [StartsWith](StartsWith.md)
