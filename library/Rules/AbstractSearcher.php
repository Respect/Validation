<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Helpers\CanValidateUndefined;

use function in_array;
use function is_scalar;

abstract class AbstractSearcher extends AbstractRule
{
    use CanValidateUndefined;

    /**
     * @return mixed[]
     */
    abstract protected function getDataSource(mixed $input = null): array;

    public function validate(mixed $input): bool
    {
        $dataSource = $this->getDataSource($input);

        if ($this->isUndefined($input) && empty($dataSource)) {
            return true;
        }

        if (!is_scalar($input)) {
            return false;
        }

        return in_array((string) $input, $dataSource, true);
    }
}
