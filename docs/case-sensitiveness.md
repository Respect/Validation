<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
-->

# Case Insensitive Validation

For most simple cases, you can use `v::call` wrappers to perform
case normalization before comparison.

For strings:

```php
v::after(strtolower(...), v::contains('cde'))->assert('ABCDEF');
// Validation passes successfully

v::after(strtolower(...), v::contains('xxx'))->assert('ABCDEF');
// → "abcdef" must contain "xxx"
```

For arrays:

```php
v::after(
    static fn ($i) => array_map(strtolower(...), $i),
    v::contains('abc')
)->assert(['ABC', 'DEF']);
// Validation passes successfully

v::after(
    static fn ($i) => array_map(strtolower(...), $i),
    v::contains('xxx')
)->assert(['ABC', 'DEF']);
// → `["abc", "def"]` must contain "xxx"
```
