<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Helpers\CanValidateUndefined;

/**
 * Abstract class for searches into arrays.
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
abstract class AbstractSearcher extends AbstractRule
{
    use CanValidateUndefined;

    /**
     * @return array
     */
    abstract protected function getDataSource(): array;

    /**
     * {@inheritdoc}
     */
    public function validate($input): bool
    {
        $dataSource = $this->getDataSource();
        if ($this->isUndefined($input) && empty($dataSource)) {
            return true;
        }

        return in_array($input, $dataSource, true);
    }
}
