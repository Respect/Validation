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
 * Validates an array key.
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Henrique Moody <henriquemoody@gmail.com>
 *
 * @since 0.3.9
 *
 * @Templates(
 *   regular={
 *     @Template("Key {{reference}} must be valid"),
 *     @Template("Key {{reference}} must be present", id="missing"),
 *   },
 *   inverted={
 *     @Template("Key {{reference}} must not be valid"),
 *     @Template("Key {{reference}} must not be present", id="missing"),
 *   },
 * )
 */
final class Key extends AbstractRelated
{
    /**
     * {@inheritdoc}
     */
    protected function getReferenceValue($input, $reference)
    {
        return $input[$reference];
    }

    /**
     * {@inheritdoc}
     */
    protected function hasReference($input, $reference): bool
    {
        if (is_array($input)) {
            return array_key_exists($reference, $input);
        }

        return isset($input[$reference]);
    }
}
