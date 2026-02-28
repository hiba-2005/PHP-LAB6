<?php
declare(strict_types=1);

namespace App\Dto;

/**
 * DTO représentant les données nécessaires
 * à la création d’une nouvelle filière.
 */
final class FiliereCreateDTO
{
    private string $filiereCode;
    private string $label;

    public function __construct(string $filiereCode, string $label)
    {
        $this->filiereCode = $filiereCode;
        $this->label       = $label;
    }

    public function getCode(): string
    {
        return $this->filiereCode;
    }

    public function getLibelle(): string
    {
        return $this->label;
    }
}