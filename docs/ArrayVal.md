# ArrayVal

- `v::arrayVal()`

Validates if the input is an array or traversable object.

```php
v::arrayVal()->validate(array()); //true
v::arrayVal()->validate(new ArrayObject); //true
```

***
See also:

  * [Each](Each.md)
  * [Key](Key.md)
