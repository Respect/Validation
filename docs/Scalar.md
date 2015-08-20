# Scalar

- `v::scalar()`

Validates if the input is a scalar value.

```php
v::scalar()->validate(array()); //false
v::scalar()->validate(135.0); //true
```

See also:

  * [Type](Type.md)
