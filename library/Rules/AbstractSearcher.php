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

/**
 * Abstract class for searches into arrays.
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
abstract class AbstractSearcher extends AbstractRule
{
    use CanValidateUndefined;

    /**
     * @param mixed $input
     * @return mixed[]
     */
    abstract protected function getDataSource($input = null): array;

    /**
     * @deprecated Calling `validate()` directly from rules is deprecated. Please use {@see \Respect\Validation\Validator::isValid()} instead.
     */
    public function validate($input): bool
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
