# Roman

- `v::roman()`

Validates roman numbers

```php
v::roman()->validate('IV'); //true
```

This validator ignores empty values, use `notEmpty()` when
appropriate.
