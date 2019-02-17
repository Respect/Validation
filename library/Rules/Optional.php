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
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class Optional extends AbstractWrapper
{
    use CanValidateUndefined;

    /**
     * {@inheritdoc}
     */
    public function assert($input): void
    {
        if ($this->isUndefined($input)) {
            return;
        }

        parent::assert($input);
    }

    /**
     * {@inheritdoc}
     */
    public function check($input): void
    {
        if ($this->isUndefined($input)) {
            return;
        }

        parent::check($input);
    }

    /**
     * {@inheritdoc}
     */
    public function validate($input): bool
    {
        if ($this->isUndefined($input)) {
            return true;
        }

        return parent::validate($input);
    }
}
