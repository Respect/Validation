# StartsWith

- `v::startsWith(mixed $value)`
- `v::startsWith(mixed $value, boolean $identical = false)`

This validator is similar to `v::contains()`, but validates
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

***
See also:

  * [Contains](Contains.md)
  * [EndsWith](EndsWith.md)
  * [In](In.md)
  * [Regex](Regex.md)
