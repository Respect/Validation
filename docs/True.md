# True

- `v::true()`

Validates if a value is considered as `true`.

```php
v::true()->validate(true); //true
v::true()->validate(1); //true
v::true()->validate('1'); //true
v::true()->validate('true'); //true
v::true()->validate('on'); //true
v::true()->validate('yes'); //true
v::true()->validate('0.5'); //false
v::true()->validate('2'); //false
```

***
See also:

  * [FalseVal](FalseVal.md)
