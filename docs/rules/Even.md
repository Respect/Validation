# Even

- `v::even()`

Validates an even number.

```php
v::intVal()->even()->validate(2); // true
```

Using `int()` before `even()` is a best practice.

***
See also:

  * [Multiple](Multiple.md)
  * [Odd](Odd.md)
