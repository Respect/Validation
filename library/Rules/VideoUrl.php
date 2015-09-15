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

class VideoUrl extends OneOf
{
    /**
     * @var array
     */
    public $provider;

    /**
     * @var array
     */
    private $providers = array(
        'youtube' => '/^(http|https):\/\/(www\.)?(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^\"&?\/]{11})/i',
        'vimeo' => '/^(http|https):\/\/(www\.)?(player\.)?(vimeo\.com\/)((channels\/[A-z]+\/)|(groups\/[A-z]+\/videos\/)|(video\/))?([0-9]+)/i',
    );

    /**
     * Create a new instance VideoUrl
     *
     * @param mixed $provider
     */
    public function __construct($provider)
    {
        $this->provider = $this->toProvider(is_array($provider) ? $provider : func_get_args());
        $this->createRules();

        parent::__construct();
    }

    /**
     * toProvider.
     *
     * @param array $providers
     *
     * @return array
     */
    private function toProvider(array $providers)
    {
        $result = array();

        foreach($providers as $item) {
            if(empty($item)) continue;

            if(!array_key_exists($item, $this->providers)) {
                throw new ComponentException(sprintf('"%s" is not a recognized video url provider.', $item));
            }

            array_push($result, $item);
        }

        return $result;
    }

    /**
     * createRules
     *
     * @return void
     */
    private function createRules()
    {
        $providers = count($this->provider) === 0 ? array_keys($this->providers) :  $this->provider;

        foreach($providers as $provider)
        {
            $this->addRule(new Regex($this->providers[$provider]));
        }
    }

    /**
     * validate
     *
     * @param mixed $input
     *
     * @return bool
     */
    public function validate($input)
    {
        $url = new Url();

        return !empty($input) && $url->validate($input) && parent::validate($input);
    }
}
