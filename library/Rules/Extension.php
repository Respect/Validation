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

use SplFileInfo;

/**
 * Validate file extensions.
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
class Extension extends AbstractRule
{
    /**
     * @var string
     */
    public $extension;

    /**
     * @param string $extension
     */
    public function __construct($extension)
    {
        $this->extension = $extension;
    }

    /**
     * {@inheritdoc}
     */
    public function validate($input)
    {
        if ($input instanceof SplFileInfo) {
            return ($input->getExtension() == $this->extension);
        }

        if (!is_string($input)) {
            return false;
        }

        return (pathinfo($input, PATHINFO_EXTENSION) == $this->extension);
    }
}
