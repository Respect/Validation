# NotBlank

- `v::notBlank()`

Validates if the given input is not a blank value (`null`, zeros, empty strings
or empty arrays, recursively).

```php
v::notBlank()->validate(null); // false
v::notBlank()->validate(''); // false
v::notBlank()->validate([]); // false
v::notBlank()->validate(' '); // false
v::notBlank()->validate(0); // false
v::notBlank()->validate('0'); // false
v::notBlank()->validate(0); // false
v::notBlank()->validate('0.0'); // false
v::notBlank()->validate(false); // false
v::notBlank()->validate(['']); // false
v::notBlank()->validate([' ']); // false
v::notBlank()->validate([0]); // false
v::notBlank()->validate(['0']); // false
v::notBlank()->validate([false]); // false
v::notBlank()->validate([[''], [0]]); // false
v::notBlank()->validate(new stdClass()); // false
```

It's similar to [NotEmpty](NotEmpty.md) but it's way more strict.

***
See also:

  * [NoWhitespace](NoWhitespace.md)
  * [NotEmpty](NotEmpty.md)
  * [NullType](NullType.md)
