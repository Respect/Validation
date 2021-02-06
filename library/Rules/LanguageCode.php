<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\ComponentException;
use Sokil\IsoCodes\IsoCodesFactory;
use Sokil\IsoCodes\TranslationDriver\DummyDriver;

use function in_array;
use function is_string;
use function sprintf;

/**
 * Validates whether the input is language code based on ISO 639.
 *
 * @author Danilo Benevides <danilobenevides01@gmail.com>
 * @author Emmerson Siqueira <emmersonsiqueira@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class LanguageCode extends AbstractRule
{
    public const ALPHA2 = 'alpha-2';
    public const ALPHA3 = 'alpha-3';

    public const AVAILABLE_SETS = [self::ALPHA2, self::ALPHA3];

    /**
     * @var string
     */
    private $set;

    /**
     * @var IsoCodesFactory
     */
    private $factory;

    /**
     * Initializes the rule defining the ISO 639 set.
     *
     * @throws ComponentException
     */
    public function __construct(string $set = self::ALPHA2)
    {
        if (!in_array($set, self::AVAILABLE_SETS)) {
            throw new ComponentException(sprintf('"%s" is not a valid language set for ISO 639', $set));
        }

        $this->set = $set;
        $this->factory = new IsoCodesFactory(null, new DummyDriver());
    }

    /**
     * {@inheritDoc}
     */
    public function validate($input): bool
    {
        if (!is_string($input) || $input === '') {
            return false;
        }

        $languages = $this->factory->getLanguages();
        if ($this->set === self::ALPHA2) {
            return $languages->getByAlpha2($input) !== null;
        }

        return $languages->getByAlpha3($input) !== null;
    }
}
