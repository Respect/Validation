# Cntrl

- `v::cntrl()`
- `v::cntrl(string $additionalChars)`

This is similar to `v::alnum()`, but only accepts control characters:

```php
v::cntrl()->validate("\n\r\t"); // true
```

***
See also:

  * [Alnum](Alnum.md)
  * [Prnt](Prnt.md)
  * [Punct](Punct.md)
  * [Space](Space.md)
