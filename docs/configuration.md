<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
-->

# Configuration

## Container configuration

The `ContainerRegistry::createContainer()` method returns a [Respect\Config](https://github.com/Respect/Config) container, which is [PSR-11](https://www.php-fig.org/psr/psr-11/) compatible. Definitions may be plain values, closures, or Respect\Config's `Autowire`, `Instantiator`, and `Ref` helpers.

If you prefer to use a different container, `ContainerRegistry::setContainer()` accepts any PSR-11 compatible container:

```php
use Respect\Validation\ContainerRegistry;

ContainerRegistry::setContainer($yourPsr11Container);
```
