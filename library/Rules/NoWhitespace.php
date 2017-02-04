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

use Respect\Validation\Result;
use Respect\Validation\Rule;

/**
 * Validates if a string contains no whitespace (spaces, tabs and line breaks).
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Augusto Pascutti <augusto@phpsp.org.br>
 * @author Henrique Moody <henriquemoody@gmail.com>
 *
 * @since 0.3.9
 */
final class NoWhitespace implements Rule
{
    /**
     * {@inheritdoc}
     */
    public function apply($input): Result
    {
        if (is_null($input)) {
            return new Result(true, $input, $this);
        }

        $scalarResult = (new ScalarVal())->apply($input);
        if (!$scalarResult->isValid()) {
            return new Result($scalarResult->isValid(), $input, $this, [], $scalarResult);
        }

        return new Result(0 === preg_match('/\s/', (string) $input), $input, $this);
    }
}
