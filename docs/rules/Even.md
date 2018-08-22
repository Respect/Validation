# Even

- `v::even()`

Validates an even number.

```php
v::intVal()->even()->validate(2); // true
```

Using `int()` before `even()` is a best practice.

***
See also:

  * [Odd](Odd.md)
  * [Multiple](Multiple.md)
