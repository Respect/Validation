# Arr

- `v::arr()`

Validates if the input is an array or traversable object.

```php
v::arr()->validate(array()); //true
v::arr()->validate(new ArrayObject); //true
```

See also:

  * [Each](Each.md)
  * [Key](Key.md)
