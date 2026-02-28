<?php
declare(strict_types=1);

namespace App\Service;

use App\Dao\FiliereDao;
use App\Dao\EtudiantDao;
use App\Dto\FiliereCreateDTO;
use App\Entity\Filiere;
use App\Exception\BusinessException;
use App\Log\Logger;
use PDO;

class FiliereService
{
    private $filiereDao;   // DAO filière
    private $etudiantDao;  // DAO étudiant
    private $pdo;          // Connexion DB
    private $logger;       // Logger app

    public function __construct(
        FiliereDao $filiereDao,
        EtudiantDao $etudiantDao,
        PDO $pdo,
        Logger $logger
    ) {
        $this->filiereDao  = $filiereDao;
        $this->etudiantDao = $etudiantDao;
        $this->pdo         = $pdo;
        $this->logger      = $logger;
    }

    // Création d'une filière
    public function createFiliere(FiliereCreateDTO $dto): int
    {
        $code = trim($dto->getCode());
        $lib  = trim($dto->getLibelle());

        // Vérification champs obligatoires
        if ($code === '' || $lib === '') {
            throw new BusinessException('Code et libellé requis');
        }

        // Longueur maximale du code
        if (strlen($code) > 16) {
            throw new BusinessException('Code > 16 caractères interdit');
        }

        $code = strtoupper($code); // Normalisation

        // Création de l'entité
        $entity = new Filiere(null, $code, $lib);

        // Insertion via DAO
        return $this->filiereDao->insert($entity);
    }

    // Suppression d'une filière
    public function deleteFiliere(int $id): bool
    {
        // Vérifier ID valide
        if ($id <= 0) {
            throw new BusinessException('Id filière invalide');
        }

        // Vérifier absence d’étudiants liés
        $count = $this->etudiantDao->countByFiliereId($id);

        if ($count > 0) {
            throw new BusinessException('Suppression interdite: étudiants existants');
        }

        // Suppression via DAO
        return $this->filiereDao->delete($id);
    }
}