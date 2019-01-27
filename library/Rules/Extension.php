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

use SplFileInfo;
use const PATHINFO_EXTENSION;
use function is_string;
use function pathinfo;

/**
 * Validate file extensions.
 *
 * @author Danilo Correa <danilosilva87@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class Extension extends AbstractRule
{
    /**
     * @var string
     */
    private $extension;

    /**
     * Initializes the rule.
     *
     * @param string $extension
     */
    public function __construct(string $extension)
    {
        $this->extension = $extension;
    }

    /**
     * {@inheritdoc}
     */
    public function validate($input): bool
    {
        if ($input instanceof SplFileInfo) {
            return $this->extension === $input->getExtension();
        }

        if (!is_string($input)) {
            return false;
        }

        return $this->extension === pathinfo($input, PATHINFO_EXTENSION);
    }
}
