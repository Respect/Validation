# TrueVal

- `TrueVal()`

Validates if a value is considered as `true`.

```php
v::trueVal()->validate(true); // true
v::trueVal()->validate(1); // true
v::trueVal()->validate('1'); // true
v::trueVal()->validate('true'); // true
v::trueVal()->validate('on'); // true
v::trueVal()->validate('yes'); // true
v::trueVal()->validate('0.5'); // false
v::trueVal()->validate('2'); // false
```

## Changelog

Version | Description
--------|-------------
  1.0.0 | Renamed from `True` to `TrueVal`
  0.8.0 | Created as `True`

***
See also:

- [FalseVal](FalseVal.md)
