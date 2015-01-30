# Numeric

- `v::numeric()`

Validates on any numeric value.

```php
v::numeric()->validate(-12); //true
v::numeric()->validate('135.0'); //true
```

See also:

  * [Int](Int.md)
  * [Digit](Digit.md)
