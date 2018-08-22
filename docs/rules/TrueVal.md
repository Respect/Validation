# TrueVal

- `v::trueVal()`

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

***
See also:

  * [FalseVal](FalseVal.md)
