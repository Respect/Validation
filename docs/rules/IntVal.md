# IntVal

- `IntVal()`

Validates if the input is an integer, allowing leading zeros and other number bases.

```php
v::intVal()->validate('10'); // true
v::intVal()->validate('089'); // true
v::intVal()->validate(10); // true
v::intVal()->validate(0b101010); // true
v::intVal()->validate(0x2a); // true
```

This rule will consider as valid any input that PHP can convert to an integer,
but that does not contain non-integer values. That way, one can safely use the
value this rule validates, without having surprises.

```php
v::intVal()->validate(true); // false
v::intVal()->validate('89a'); // false
```

Even though PHP can cast the values above as integers, this rule will not
consider them as valid.

## Categorization

- Numbers
- Types

## Changelog

Version  | Description
---------|-------------
  2.0.14 | Allow leading zeros
  1.0.0  | Renamed from `Int` to `IntVal`
  0.3.9  | Created as `Int`

***
See also:

- [Decimal](Decimal.md)
- [Digit](Digit.md)
- [Finite](Finite.md)
- [FloatType](FloatType.md)
- [FloatVal](FloatVal.md)
- [Infinite](Infinite.md)
- [IntType](IntType.md)
- [NumericVal](NumericVal.md)
- [Type](Type.md)
