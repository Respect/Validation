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

use Respect\Validation\Exceptions\ComponentException;

class VideoUrl extends AbstractRule
{
    /**
     * @var string
     */
    public $provider;

    /**
     * @var string
     */
    private $providerKey;

    /**
     * @var array
     */
    private $providers = array(
        'youtube' => '@^(http|https)://(www\.)?(?:youtube\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^\"&?/]{11})@i',
        'vimeo' => '@^(http|https)://(www\.)?(player\.)?(vimeo\.com/)((channels/[A-z]+/)|(groups/[A-z]+/videos/)|(video/))?([0-9]+)@i',
    );

    /**
     * Create a new instance VideoUrl
     *
     * @param string $provider
     */
    public function __construct($provider = null)
    {
        $providerKey = strtolower($provider);
        if (null !== $provider && !isset($this->providers[$providerKey])) {
            throw new ComponentException(sprintf('"%s" is not a recognized video URL provider.', $provider));
        }

        $this->provider = $provider;
        $this->providerKey = strtolower($provider);
    }

    /**
     * {@inheritdoc}
     */
    public function validate($input)
    {
        if (isset($this->providers[$this->providerKey])) {
            return (preg_match($this->providers[$this->providerKey], $input) > 0);
        }

        foreach ($this->providers as $pattern) {
            if (0 === preg_match($pattern, $input)) {
                continue;
            }

            return true;
        }

        return false;
    }
}
