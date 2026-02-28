<?php
declare(strict_types=1);

namespace App\Entity;

final class Etudiant
{
    private ?int $id;
    private string $cne;
    private string $nom;
    private string $prenom;
    private string $email;
    private int $filiereId;

    public function __construct(
        ?int $id,
        string $cne,
        string $nom,
        string $prenom,
        string $email,
        int $filiereId
    ) {
        $this->id = $id;
        $this->setCne($cne);
        $this->setNom($nom);
        $this->setPrenom($prenom);
        $this->setEmail($email);
        $this->setFiliereId($filiereId);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getCne(): string
    {
        return $this->cne;
    }

    public function setCne(string $cne): void
    {
        $value = trim($cne);
        if ($value === '') {
            throw new \InvalidArgumentException('CNE obligatoire');
        }
        $this->cne = $value;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function setNom(string $nom): void
    {
        $value = trim($nom);
        if ($value === '') {
            throw new \InvalidArgumentException('Nom obligatoire');
        }
        $this->nom = $value;
    }

    public function getPrenom(): string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): void
    {
        $value = trim($prenom);
        if ($value === '') {
            throw new \InvalidArgumentException('Prénom obligatoire');
        }
        $this->prenom = $value;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $value = trim($email);

        if ($value === '' || filter_var($value, FILTER_VALIDATE_EMAIL) === false) {
            throw new \InvalidArgumentException('Adresse email non valide');
        }

        $this->email = $value;
    }

    public function getFiliereId(): int
    {
        return $this->filiereId;
    }

    public function setFiliereId(int $filiereId): void
    {
        if ($filiereId < 1) {
            throw new \InvalidArgumentException('Id filière invalide (>= 1)');
        }

        $this->filiereId = $filiereId;
    }
}