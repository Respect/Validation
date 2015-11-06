# FloatVal

- `v::floatVal()`

Validates a floating point number.

```php
v::floatVal()->validate(1.5); // true
v::floatVal()->validate('1e5'); // true
```

***
See also:

  * [FloatType](FloatType.md)
  * [IntType](IntType.md)
  * [IntVal](IntVal.md)
