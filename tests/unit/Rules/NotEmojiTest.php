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

/**
 * @group  rule
 * @covers Respect\Validation\Rules\HelloWorld
 */
class NotEmojiTest extends RuleTestCase
{
    public function providerForValidInput()
    {
        $rule = new NotEmoji();
        
        return [
          [$rule, 'Hello World'],
          [$rule, '0123456789'],
          [$rule, 'ABCDEFGHIKLMNOPQRSTVXYZabcdefghiklmnopqrstvxyz'],
          [$rule, '&"\'(-_)@-*/+.'],
          [$rule, 'çàéè⁊ǷÞÐÆ'],
          [$rule, 'ضصثقفغعهخحجشسيبلاتنمكطئءؤرلاىةوزظذ'],
          [$rule, 'ろぬふあうえおやゆよわ゛へちついすかんなにらせれせ゜たqとしはきくまのりもろむてさそひこみねるめ!'],
        ];
    }

    public function providerForInvalidInput()
    {
        $rule = new NotEmoji();

        return [
            //Smileys & People
            [$rule, '🤣'],
              // with modifier
              [$rule, '👉🏿'],
              [$rule, '🎅🏾'],
              [$rule, '🙍🏻‍♂'],

            // Animals & Nature
            [$rule, '🐵'],

            // Food & Drink
            [$rule, '🍎'],

            // Travel & Places
            [$rule, '⛰️'],

            // Activities
            [$rule, '🎈'],

            // Objects
            [$rule, '📢'],

            // Symbols: symbols are cancer as they are not necessarly within a range; their unicodes are spread...
            [$rule, '⚠️'],
            [$rule, '⏺'],
            [$rule, '✅'],

            // Flags
            [$rule, '🇹🇳'],
            [$rule, '🏴󠁧󠁢󠁥󠁮󠁧󠁿'],
            [$rule, '🏳‍🌈󠁧󠁢󠁥󠁮󠁧󠁿'],
            [$rule, '🏴‍☠️󠁧󠁢󠁥󠁮󠁧󠁿'],

            // Mixed with text
            [$rule, 'this is a pizza 🍕'],
        ];
    }
}
