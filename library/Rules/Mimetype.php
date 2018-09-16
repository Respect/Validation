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
use function is_file;
use function is_string;

/**
 * Validate file mimetypes.
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
     * @param string $mimetype
     * @param finfo  $fileInfo
     */
    public function __construct($mimetype, finfo $fileInfo = null)
    {
        $this->mimetype = $mimetype;
        $this->fileInfo = $fileInfo ?: new finfo(FILEINFO_MIME_TYPE);
    }

    /**
     * {@inheritdoc}
     */
    public function validate($input): bool
    {
        if ($input instanceof SplFileInfo) {
            $input = $input->getPathname();
        }

        if (!is_string($input)) {
            return false;
        }

        if (!is_file($input)) {
            return false;
        }

        return $this->fileInfo->file($input) == $this->mimetype;
    }
}
