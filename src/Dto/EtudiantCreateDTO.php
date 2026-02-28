<?php
declare(strict_types=1);

namespace App\Dto;

/**
 * DTO utilisé pour transporter les données
 * nécessaires à la création d’un étudiant.
 */
final class EtudiantCreateDTO
{
    private string $cne;
    private string $lastName;
    private string $firstName;
    private string $emailAddress;
    private int $filiereId;

    public function __construct(
        string $cne,
        string $lastName,
        string $firstName,
        string $emailAddress,
        int $filiereId
    ) {
        $this->cne          = $cne;
        $this->lastName     = $lastName;
        $this->firstName    = $firstName;
        $this->emailAddress = $emailAddress;
        $this->filiereId    = $filiereId;
    }

    public function getCne(): string
    {
        return $this->cne;
    }

    public function getNom(): string
    {
        return $this->lastName;
    }

    public function getPrenom(): string
    {
        return $this->firstName;
    }

    public function getEmail(): string
    {
        return $this->emailAddress;
    }

    public function getFiliereId(): int
    {
        return $this->filiereId;
    }
}