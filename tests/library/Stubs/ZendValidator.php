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

namespace Respect\Validation\Test\Stubs;

use Zend\Validator\ValidatorInterface;

final class ZendValidator implements ValidatorInterface
{
    /**
     * {@inheritdoc}
     */
    public function isValid($value)
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function getMessages()
    {
        return [];
    }
}
