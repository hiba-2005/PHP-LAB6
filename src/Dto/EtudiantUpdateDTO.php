<?php
declare(strict_types=1);

namespace App\Dto;

/**
 * DTO utilisé pour transporter les informations
 * nécessaires à la mise à jour d’un étudiant.
 */
final class EtudiantUpdateDTO
{
    private int $studentId;
    private string $lastName;
    private string $firstName;
    private string $emailAddress;
    private int $filiereId;

    public function __construct(
        int $studentId,
        string $lastName,
        string $firstName,
        string $emailAddress,
        int $filiereId
    ) {
        $this->studentId   = $studentId;
        $this->lastName    = $lastName;
        $this->firstName   = $firstName;
        $this->emailAddress= $emailAddress;
        $this->filiereId   = $filiereId;
    }

    public function getId(): int
    {
        return $this->studentId;
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