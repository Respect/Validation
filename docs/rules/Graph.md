# Graph

- `v::graph()`
- `v::graph(string $additionalChars)`

Validates all characters that are graphically represented.

```php
v::graph()->validate('LKM@#$%4;'); // true
```

***
See also:

  * [Prnt](Prnt.md)
  * [Punct](Punct.md)
