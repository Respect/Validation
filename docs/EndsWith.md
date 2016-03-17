# EndsWith

- `v::endsWith(mixed $value)`
- `v::endsWith(mixed $value, boolean $identical = false)`

This validator is similar to `v::contains()`, but validates
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

***
See also:

  * [StartsWith](StartsWith.md)
  * [Contains](Contains.md)
  * [In](In.md)
