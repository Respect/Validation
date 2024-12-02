# FalseVal

- `FalseVal()`

Validates if a value is considered as `false`.

```php
v::falseVal()->isValid(false); // true
v::falseVal()->isValid(0); // true
v::falseVal()->isValid('0'); // true
v::falseVal()->isValid('false'); // true
v::falseVal()->isValid('off'); // true
v::falseVal()->isValid('no'); // true
v::falseVal()->isValid('0.5'); // false
v::falseVal()->isValid('2'); // false
```

## Categorization

- Booleans

## Changelog

Version | Description
--------|-------------
  1.0.0 | Renamed from `False` to `FalseVal`
  0.8.0 | Created as `False`

***
See also:

- [TrueVal](TrueVal.md)
