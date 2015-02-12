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
```

See also

  * [False](False.md)
