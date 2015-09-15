# Youtube

- `v::youtube()`

Validates if the input is a Youtube value:

```php
v::youtube()->validate('https://www.youtube.com/watch?v=netHLn9TScY'); //true
v::youtube()->validate('https://youtu.be/netHLn9TScY'); //true
v::youtube()->validate('https://www.youtube.com/embed/netHLn9TScY'); //true
```
