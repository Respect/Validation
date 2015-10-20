# Punct

- `v::punct()`
- `v::punct(string $additionalChars)`

Accepts only punctuation characters:

```php
v::punct()->validate('&,.;[]'); // true
```

***
See also:

  * [Cntrl](Cntrl.md)
  * [Graph](Graph.md)
  * [Prnt](Prnt.md)
