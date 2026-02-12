<?php

namespace App\Enums;

class PoissonCategorie
{
    const SIMPLE = 'poisson_simple';
    const ECAILLER = 'poisson_ecailler';
    const ECAILLER_MARINER = 'poisson_ecailler_mariner';
    const ROUGE = 'poisson_rouge';
    const DORADE = 'dorade';
    const CORYPHENE = 'coryphene';

    public static function label($categorie): string
    {
        return match($categorie) {
            self::SIMPLE => 'Poisson Simple',
            self::ECAILLER => 'Poisson Écailler',
            self::ECAILLER_MARINER => 'Poisson Écailler et Mariné',
            self::ROUGE => 'Poisson Rouge',
            self::DORADE => 'Dorade',
            self::CORYPHENE => 'Coryphène',
            default => 'Inconnu'
        };
    }

    public static function all(): array
    {
        return [
            self::SIMPLE,
            self::ECAILLER,
            self::ECAILLER_MARINER,
            self::ROUGE,
            self::DORADE,
            self::CORYPHENE,
        ];
    }
}
