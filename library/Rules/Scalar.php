<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace Respect\Validation\Rules;

/**
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
class Scalar extends AbstractRule
{
    /**
     * {@inheritdoc}
     */
    public function validate($input)
    {
        if ($this->isOptional($input)) {
            return true;
        }

        return is_scalar($input);
    }
}
