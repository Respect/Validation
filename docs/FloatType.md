# FloatType

- `v::floatType()`

Validates whether the type of a value is float.

```php
v::floatType()->validate(1.5); // true
v::floatType()->validate('1.5'); // false
v::floatType()->validate(0e5); // true
```

***
See also:

  * [FloatVal](FloatVal.md)
  * [IntType](IntType.md)
  * [IntVal](IntVal.md)
