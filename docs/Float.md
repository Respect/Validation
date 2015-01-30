# Float

- `v::float()`

Validates a floating point number.

```php
v::float()->validate(1.5); //true
v::float()->validate('1e5'); //true
```
