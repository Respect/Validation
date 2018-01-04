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

namespace Respect\Validation\Message;

use Doctrine\Common\Annotations\Annotation;
use Doctrine\Common\Annotations\Annotation\Required;
use Doctrine\Common\Annotations\Annotation\Target;

/**
 * @Annotation
 * @Target("ANNOTATION")
 */
final class Template
{
    const ID_KEY = '__id';
    const DEFAULT_ID_VALUE = 'standard';

    /**
     * @Required
     *
     * @var string
     */
    public $message;

    /**
     * @var string
     */
    public $id = self::DEFAULT_ID_VALUE;
}
