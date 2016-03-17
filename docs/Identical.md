# Identical

- `v::identical(mixed $value)`

Validates if the input is identical to some value.

```php
v::identical(42)->validate(42); // true
v::identical(42)->validate('42'); // false
```

Message template for this validator includes `{{compareTo}}`.

***
See also:

  * [Contains](Contains.md)
  * [Equals](Equals.md)
