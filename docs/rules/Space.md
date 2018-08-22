# Space

- `v::space()`
- `v::space(string $additionalChars)`

Accepts only whitespace:

```php
v::space()->validate('    '); // true
```

***
See also:

  * [Cntrl](Cntrl.md)
