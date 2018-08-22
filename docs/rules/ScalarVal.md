# ScalarVal

- `v::scalarVal()`

Validates if the input is a scalar value.

```php
v::scalarVal()->validate([]); // false
v::scalarVal()->validate(135.0); // true
```

***
See also:

  * [Type](Type.md)
