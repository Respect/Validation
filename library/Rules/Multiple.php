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

/**
 * @author Danilo Benevides <danilobenevides01@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Jean Pimentel <jeanfap@gmail.com>
 */
final class Multiple extends AbstractRule
{
    /**
     * @var int
     */
    public $multipleOf;

    /**
     * @param int $multipleOf
     */
    public function __construct(int $multipleOf)
    {
        $this->multipleOf = $multipleOf;
    }

    /**
     * {@inheritdoc}
     */
    public function validate($input): bool
    {
        if (0 == $this->multipleOf) {
            return 0 == $input;
        }

        return 0 == $input % $this->multipleOf;
    }
}
