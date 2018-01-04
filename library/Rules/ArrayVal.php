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

use ArrayAccess;
use Respect\Validation\Result;
use Respect\Validation\Rule;
use SimpleXMLElement;

/**
 * Validates if the input is an array or if the input can be used as an array.
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Guilherme Siani <guilherme@siani.com.br>
 * @author Henrique Moody <henriquemoody@gmail.com>
 *
 * @since 0.3.9
 */
final class ArrayVal implements Rule
{
    /**
     * {@inheritdoc}
     */
    public function apply($input): Result
    {
        return new Result($this->isArray($input), $input, $this);
    }

    /**
     * Returns whether the input can be used as an array or not.
     *
     * @param mixed $input
     *
     * @return bool
     */
    private function isArray($input): bool
    {
        return is_array($input) || $input instanceof ArrayAccess || $input instanceof SimpleXMLElement;
    }
}
