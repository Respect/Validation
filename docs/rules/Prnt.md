# Prnt

- `v::prnt()`
- `v::prnt(string $additionalChars)`

Similar to `v::graph` but accepts whitespace.

```php
v::prnt()->validate('LMKA0$% _123'); // true
```

***
See also:

  * [Cntrl](Cntrl.md)
  * [Graph](Graph.md)
  * [Punct](Punct.md)
