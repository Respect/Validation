# TrueVal

- `TrueVal()`

Validates if a value is considered as `true`.

```php
v::trueVal()->isValid(true); // true
v::trueVal()->isValid(1); // true
v::trueVal()->isValid('1'); // true
v::trueVal()->isValid('true'); // true
v::trueVal()->isValid('on'); // true
v::trueVal()->isValid('yes'); // true
v::trueVal()->isValid('0.5'); // false
v::trueVal()->isValid('2'); // false
```

## Categorization

- Booleans

## Changelog

Version | Description
--------|-------------
  1.0.0 | Renamed from `True` to `TrueVal`
  0.8.0 | Created as `True`

***
See also:

- [BoolType](BoolType.md)
- [BoolVal](BoolVal.md)
- [FalseVal](FalseVal.md)
