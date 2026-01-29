<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# Case Insensitive Validation

For most simple cases, you can use `v::call` wrappers to perform
case normalization before comparison.

For strings:

```php
v::call(strtolower(...), v::contains('cde'))->assert('ABCDEF');
// Validation passes successfully

v::call(strtolower(...), v::contains('xxx'))->assert('ABCDEF');
// → "abcdef" must contain "xxx"
```

For arrays:

```php
v::call(
    static fn ($i) => array_map(strtolower(...), $i),
    v::contains('abc')
)->assert(['ABC', 'DEF']);
// Validation passes successfully

v::call(
    static fn ($i) => array_map(strtolower(...), $i),
    v::contains('xxx')
)->assert(['ABC', 'DEF']);
// → `["abc", "def"]` must contain "xxx"
```
