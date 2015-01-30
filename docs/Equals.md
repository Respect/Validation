# Equals

- `v::equals(mixed $value)`
- `v::equals(mixed $value, boolean $identical = false)`

Validates if the input is equal some value.

```php
v::equals('alganet')->validate('alganet'); //true
```

Identical validation (===) is possible:

```php
v::equals(10)->validate('10'); //true
v::equals(10, true)->validate('10'); //false
```

Message template for this validator includes `{{compareTo}}`.

See also:

  * [Contains](Contains.md)
