# False

- `v::false()`

Validates if a value is considered as `false`.

```php
v::false()->validate(false); //true
v::false()->validate(0); //true
v::false()->validate('0'); //true
v::false()->validate('false'); //true
v::false()->validate('off'); //true
v::false()->validate('no'); //true
```

See also

  * [True](True.md)
