# In

- `v::in(mixed $haystack)`
- `v::in(mixed $haystack, boolean $identical = false)`

Validates if the input is contained in a specific haystack.

For strings:

```php
v::in('lorem ipsum')->validate('ipsum'); // true
```

For arrays:

```php
v::in(['lorem', 'ipsum'])->validate('lorem'); // true
```

A second parameter may be passed for identical comparison instead
of equal comparison.

Message template for this validator includes `{{haystack}}`.

***
See also:

  * [Contains](Contains.md)
  * [EndsWith](EndsWith.md)
  * [Roman](Roman.md)
  * [StartsWith](StartsWith.md)
