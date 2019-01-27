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

use finfo;
use SplFileInfo;
use const FILEINFO_MIME_TYPE;
use function is_file;
use function is_string;

/**
 * Validates if the input is a file and if its MIME type matches the expected one.
 *
 * @author Danilo Correa <danilosilva87@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class Mimetype extends AbstractRule
{
    /**
     * @var string
     */
    private $mimetype;

    /**
     * @var finfo
     */
    private $fileInfo;

    /**
     * Initializes the rule by defining the expected mimetype from the input.
     *
     * @param string $mimetype
     * @param finfo $fileInfo
     */
    public function __construct(string $mimetype, finfo $fileInfo = null)
    {
        $this->mimetype = $mimetype;
        $this->fileInfo = $fileInfo ?: new finfo();
    }

    /**
     * {@inheritdoc}
     */
    public function validate($input): bool
    {
        if ($input instanceof SplFileInfo) {
            return $this->validate($input->getPathname());
        }

        if (!is_string($input)) {
            return false;
        }

        if (!is_file($input)) {
            return false;
        }

        return $this->mimetype === $this->fileInfo->file($input, FILEINFO_MIME_TYPE);
    }
}
