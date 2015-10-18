# CallableType

- `v::callableType()`

Validates if the input is a callable value.

```php
v::callableType()->validate(function () {}); //true
v::callableType()->validate('trim'); //true
v::callableType()->validate([new ObjectType, 'methodName']); //true
```

***
See also:

  * [Callback](Callback.md)
  * [Type](Type.md)
