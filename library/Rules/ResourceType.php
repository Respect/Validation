<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use function is_resource;

/**
 * Validates whether the input is a resource.
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
class ResourceType extends AbstractRule
{
    /**
     * {@inheritDoc}
     */
    public function validate($input): bool
    {
        return is_resource($input);
    }
}
