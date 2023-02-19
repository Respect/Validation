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
use function mb_strtoupper;

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
     * {@inheritDoc}
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

        return in_array(mb_strtoupper((string) $input), $dataSource, true);
    }
}
