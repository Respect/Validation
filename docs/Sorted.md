# Ordered

- `Sorted(callable $fn = null, bool $ascending = true)`

Validates if the input is Sorted

```php
v::sorted()->isValid([1,2,3]); // true
v::sorted()->isValid([1,6,3]); // false
v::sorted(null, false)->isValid([3,2,1]); // true
v::sorted(function($x){
    return $x['key'];
})->isValid([
    [
        'key' => 1,
    ],
    [
        'key' => 5,
    ],
    [
        'key' => 9,
    ],
]); // true
v::sorted(function($x){
    return $x['key'];
})->isValid([
    [
        'key' => 1,
    ],
    [
        'key' => 7,
    ],
    [
        'key' => 4,
    ],
]); // false
```

## Changelog

Version | Description
--------|-------------
  1.1.1 | Created

***
See also:

- [ArrayVal](ArrayVal.md)
