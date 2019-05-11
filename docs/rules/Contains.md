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

## Categorization

- Arrays
- Strings

## Changelog

Version | Description
--------|-------------
  0.3.9 | Created

***
See also:

- [ContainsAny](ContainsAny.md)
- [EndsWith](EndsWith.md)
- [Equals](Equals.md)
- [Equivalent](Equivalent.md)
- [Identical](Identical.md)
- [In](In.md)
- [Regex](Regex.md)
- [StartsWith](StartsWith.md)
- [Unique](Unique.md)
