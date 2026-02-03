<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Dev\Spdx;

use function str_ends_with;

final readonly class Contributor
{
    private const array CONTRIBUTOR_ALIASES = [
        'alexandre@gaigalas.net' => ['Alexandre Gomes Gaigalas', 'alganet@gmail.com'],
        'alganet+github@gmail.com' => ['Alexandre Gomes Gaigalas', 'alganet@gmail.com'],
        'alganet@alganet-laptop.(none)' => ['Alexandre Gomes Gaigalas', 'alganet@gmail.com'],
        'alganet@alganet-workstation.(none)' => ['Alexandre Gomes Gaigalas', 'alganet@gmail.com'],
        'gaigalas@yahoo-inc.com' => ['Alexandre Gomes Gaigalas', 'alganet@gmail.com'],
        'augusto@phpsp.org.br' => ['Augusto Pascutti', 'augusto.hp@gmail.com'],
        'github@jigsoft.co.za' => ['Nick Lombard', 'github@jigsoft.co.za'],
        'nick@jigsoft.co.za' => ['Nick Lombard', 'github@jigsoft.co.za'],
        'emmersonsiqueira@gmail.com' => ['Emmerson Siqueira', 'emmersonsiqueira@gmail.com'],
        'jayson.reis@sabbre.com.br' => ['Jayson Reis', 'santosdosreis@gmail.com'],
        'kolyshkin@.sqlmaze.local' => ['Kir Kolyshkin', 'kolyshkin@gmail.com'],
        'pathumhdes@gmail.com' => ['Pathum Harshana De Silva', 'pathumhdes@gmail.com'],
        'andre@andre.(none)' => ['Carlos André Ferrari', 'caferrari@gmail.com'],
        'mazanax@yandex.ru' => ['Aleksandr Gorshkov', 'mazanax@yandex.ru'],
        'paulkarikari1@gmail.com' => ['Paul Karikari', 'paulkarikari1@gmail.com'],
    ];

    private function __construct(
        public string $name,
        public string|null $email,
    ) {
    }

    public static function create(string $name, string|null $email): self
    {
        if ($email !== null && isset(self::CONTRIBUTOR_ALIASES[$email])) {
            [$name, $email] = self::CONTRIBUTOR_ALIASES[$email];
        }

        if ($email !== null && str_ends_with($email, 'users.noreply.github.com')) {
            $email = null;
        }

        return new self($name, $email);
    }
}
