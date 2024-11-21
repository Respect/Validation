# EndsWith

- `EndsWith(mixed $value)`
- `EndsWith(mixed $value, bool $identical)`

This validator is similar to `Contains()`, but validates
only if the value is at the end of the input.

For strings:

```php
use Respect\Validation\Validator as v;

v::endsWith('ipsum')->validate('lorem ipsum'); // true
```

For arrays:

```php
use Respect\Validation\Validator as v;

v::endsWith('ipsum')->validate(['lorem', 'ipsum']); // true
```

A second parameter may be passed for identical comparison instead
of equal comparison.

Message template for this validator includes `{{endValue}}`.

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
- [In](In.md)
- [Regex](Regex.md)
- [StartsWith](StartsWith.md)
