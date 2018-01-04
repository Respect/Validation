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

use Respect\Validation\Message\Template;
use Respect\Validation\Message\Templates;
use Respect\Validation\Result;
use Respect\Validation\Rule;

/**
 * Validates if the input is equal to some value.
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Henrique Moody <henriquemoody@gmail.com>
 *
 * @since 0.3.9
 *
 * @Templates(
 *   regular={
 *     @Template("{{placeholder}} must equals {{compareTo}}"),
 *   },
 *   inverted={
 *     @Template("{{placeholder}} must not equals {{compareTo}}"),
 *   },
 * )
 */
final class Equals implements Rule
{
    /**
     * @var mixed
     */
    private $compareTo;

    /**
     * Initializes the rule.
     *
     * @param mixed $compareTo
     */
    public function __construct($compareTo)
    {
        $this->compareTo = $compareTo;
    }

    /**
     * {@inheritdoc}
     */
    public function apply($input): Result
    {
        return new Result(($input == $this->compareTo), $input, $this, ['compareTo' => $this->compareTo]);
    }
}
