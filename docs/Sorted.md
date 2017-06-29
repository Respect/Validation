# Ordered

- `Sorted(callable $fn = null, bool $ascending = true)`

Validates if the input is Sorted

```php
v::sorted()->validate([1,2,3]); // true
v::sorted()->validate([1,6,3]); // false
v::sorted(null, false)->validate([3,2,1]); // true
v::sorted(function($x){
    return $x['key'];
})->validate([
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
})->validate([
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
