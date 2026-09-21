<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
-->

# Prefixes

Prefixes are convenience methods that make complex validators easier to use. They are dynamically generated to simplify the creation of common validation patterns.

## Overview

Prefixes are automatically created for the following validators:

- [All](validators/All.md)
- [Key](validators/Key.md)
- [Length](validators/Length.md)
- [Max](validators/Max.md)
- [Min](validators/Min.md)
- [Not](validators/Not.md)
- [NullOr](validators/NullOr.md)
- [Property](validators/Property.md)
- [UndefOr](validators/UndefOr.md)

These prefixes allow you to write more concise validators. For example, `v::allEmoji()` is automatically transformed into `v::all(v::emoji())`.

## How it works

The prefix system works by detecting method names that start with specific prefixes and automatically wrapping the remaining part of the method name with the appropriate validator. This transformation happens internally, so you can use these prefixes seamlessly.

## Available prefixes

### `all`

Any method starting with `all` will be transformed into `v::all(v::remainingPart())`.

- `v::allEmoji()` → `v::all(v::emoji())`
- `v::allIntType()` → `v::all(v::intType())`
- `v::allPositive()` → `v::all(v::positive())`

```php
v::allEmoji()->assert(['😀', '😁', '😂'])
// Validation passes successfully

v::allEmoji()->assert(['😀', 'abc', '😂']);
// → Every item in `["😀", "abc", "😂"]` must be an emoji
```

### `length`

Any method starting with `length` will be transformed into `v::length(v::remainingPart())`.

- `v::lengthBetween(5, 10)` → `v::length(v::between(5, 10))`
- `v::lengthGreaterThan(3)` → `v::length(v::greaterThan(3))`

```php
v::lengthBetween(5, 10)->assert('hello')
// Validation passes successfully

v::lengthBetween(5, 10)->assert('hi');
// → The length of "hi" must be between 5 and 10
```

### `max`

Any method starting with `max` will be transformed into `v::max(v::remainingPart())`.

- `v::maxLessThan(100)` → `v::max(v::lessThan(100))`
- `v::maxPositive()` → `v::max(v::positive())`

```php
v::maxLessThan(100)->assert([99, 50, 1])
// Validation passes successfully

v::maxLessThan(100)->assert([100, 50, 1]);
// → The maximum of `[100, 50, 1]` must be less than 100
```

### `min`

Any method starting with `min` will be transformed into `v::min(v::remainingPart())`.

- `v::minGreaterThan(0)` → `v::min(v::greaterThan(0))`
- `v::minPositive()` → `v::min(v::positive())`

```php
v::minGreaterThan(0)->assert([1, 2, 3])
// Validation passes successfully

v::minGreaterThan(0)->assert([0, 1, 2]);
// → The minimum of `[0, 1, 2]` must be greater than 0
```

### `not`

Any method starting with `not` will be transformed into `v::not(v::remainingPart())`.

- `v::notFalsy()` → `v::not(v::falsy())`
- `v::notNullType()` → `v::not(v::nullType())`

```php
v::notFalsy()->assert('hello')
// Validation passes successfully

v::notFalsy()->assert('');
// → "" must not be falsy
```

### `nullOr`

Any method starting with `nullOr` will be transformed into `v::nullOr(v::remainingPart())`.

- `v::nullOrEmail()` → `v::nullOr(v::email())`
- `v::nullOrPositive()` → `v::nullOr(v::positive())`

```php
v::nullOrEmail()->assert(null)
v::nullOrEmail()->assert('test@example.com')
// Validation passes successfully

v::nullOrEmail()->assert('invalid-email');
// → The value must be null or a valid email
```

### `undefOr`

Any method starting with `undefOr` will be transformed into `v::undefOr(v::remainingPart())`.

- `v::undefOrPositive()` → `v::undefOr(v::positive())`
- `v::undefOrEmail()` → `v::undefOr(v::email())`

```php
v::undefOrPositive()->assert(undefined)
v::undefOrPositive()->assert(5)
// Validation passes successfully

v::undefOrPositive()->assert(-5);
// → The value must be undefined or a positive number
```

### `key`

Any method starting with `key` will be transformed into `v::key($key, v::remainingPart())`. The first argument is used as the key.

- `v::keyEmail('email')` → `v::key('email', v::email())`
- `v::keyPositive('age')` → `v::key('age', v::positive())`

```php
v::keyEmail('email')->assert(['email' => 'test@example.com'])
// Validation passes successfully

v::keyEmail('email')->assert(['email' => 'invalid-email']);
// → The key `email` must be a valid email
```

### `property`

Any method starting with `property` will be transformed into `v::property($property, v::remainingPart())`. The first argument is used as the property.

- `v::propertyPositive('age')` → `v::property('age', v::positive())`
- `v::propertyEmail('email')` → `v::property('email', v::email())`

```php
v::propertyPositive('age')->assert((object)['age' => 25])
// Validation passes successfully

v::propertyPositive('age')->assert((object)['age' => -5]);
// → The property `age` must be a positive number
```
