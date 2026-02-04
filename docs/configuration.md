<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
-->

# Configuration

## Container configuration

The `ContainerRegistry::createContainer()` method returns a [PHP-DI](https://php-di.org/) container. The definitions array follows the [PHP-DI definitions format](https://php-di.org/doc/php-definitions.html).

If you prefer to use a different container, `ContainerRegistry::setContainer()` accepts any [PSR-11](https://www.php-fig.org/psr/psr-11/) compatible container:

```php
use Respect\Validation\ContainerRegistry;

ContainerRegistry::setContainer($yourPsr11Container);
```
