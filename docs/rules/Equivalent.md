# Equivalent

- `Equivalent(mixed $compareTo)`

Validates if the input is equivalent to some value.

```php
v::equivalent(1)->validate(true); // true
v::equivalent('Something')->validate('someThing'); // true
v::equivalent(new ArrayObject([1, 2, 3, 4, 5]))->validate(new ArrayObject([1, 2, 3, 4, 5])); // true
```

This rule is very similar to [Equals](Equals.md) but it does not make case-sensitive
comparisons.

Message template for this validator includes `{{compareTo}}`.

## Changelog

Version | Description
--------|-------------
  2.0.0 | Created

***
See also:

- [Contains](Contains.md)
- [Equals](Equals.md)
- [Identical](Identical.md)
