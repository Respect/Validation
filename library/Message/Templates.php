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
 * @Target("CLASS")
 */
final class Templates
{
    /**
     * @Required
     *
     * @var array<Respect\Validation\Message\Template>
     */
    public $regular;

    /**
     * @Required
     *
     * @var array<Respect\Validation\Message\Template>
     */
    public $inverted;

    /**
     * @var bool
     */
    public $isIgnorable = false;

    public static function getDefault(): self
    {
        $templates = new self();
        $templates->regular[0] = new Template();
        $templates->regular[0]->message = '{{placeholder}} must be valid';
        $templates->inverted[0] = new Template();
        $templates->inverted[0]->message = '{{placeholder}} must not be valid';

        return $templates;
    }
}
