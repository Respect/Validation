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

use Respect\Validation\Exceptions\ComponentException;
use function is_string;
use function preg_match;
use function sprintf;

/**
 * Validates whether the input is a valid UUID.
 *
 * It also supports validation of specific versions 1, 3, 4 and 5.
 *
 * @author Dick van der Heiden <d.vanderheiden@inthere.nl>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Michael Weimann <mail@michael-weimann.eu>
 */
final class Uuid extends AbstractRule
{
    /**
     * Placeholder in "sprintf()" format used to create the REGEX that validates inputs.
     */
    private const PATTERN_FORMAT = '/^[0-9a-f]{8}-[0-9a-f]{4}-%s[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/i';

    /**
     * The UUID version to validate for.
     *
     * @var int|null
     */
    private $version;

    /**
     * Initializes the rule with the desired version.
     *
     * @param int|null $version
     *
     * @throws ComponentException when the version is not valid
     */
    public function __construct(int $version = null)
    {
        if (null !== $version && !$this->isSupportedVersion($version)) {
            throw new ComponentException(sprintf('Only versions 1, 3, 4, and 5 are supported: %d given', $version));
        }

        $this->version = $version;
    }

    /**
     * {@inheritdoc}
     */
    public function validate($input): bool
    {
        if (!is_string($input)) {
            return false;
        }

        return preg_match($this->getPattern(), $input) > 0;
    }

    private function isSupportedVersion(int $version): bool
    {
        return $version >= 1 && $version <= 5 && 2 !== $version;
    }

    private function getPattern(): string
    {
        if (null !== $this->version) {
            return sprintf(self::PATTERN_FORMAT, $this->version);
        }

        return sprintf(self::PATTERN_FORMAT, '[13-5]');
    }
}
