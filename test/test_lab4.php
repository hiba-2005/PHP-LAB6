<?php
declare(strict_types=1);

ini_set('display_errors', '1');
error_reporting(E_ALL);

/**
 * Autoload simple (PSR-4 light)
 */
spl_autoload_register(function (string $fqcn): void {
    $rootNs = 'App\\';
    $srcDir = __DIR__ . '/../src/';

    if (strpos($fqcn, $rootNs) !== 0) {
        return;
    }

    $relative = substr($fqcn, strlen($rootNs));
    $path = $srcDir . str_replace('\\', DIRECTORY_SEPARATOR, $relative) . '.php';

    if (is_file($path)) {
        require_once $path;
    }
});

use App\Container\AppFactory;
use App\Controller\Response;

/**
 * Affichage des résultats d’un test
 */
function showResult(string $title, Response $response): void
{
    $ok = $response->isSuccess() ? 'OK' : 'KO';

    echo "<pre>";
    echo "=== {$title} ===" . PHP_EOL;
    echo "status: {$ok}" . PHP_EOL;

    if ($response->isSuccess()) {
        echo "payload: " . json_encode(
            $response->getData(),
            JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
        ) . PHP_EOL;
    } else {
        echo "message: " . $response->getError() . PHP_EOL;
    }

    echo "</pre>";
}

try {
    $controller = AppFactory::createController();

    // Cas 1 — Succès: créer filière puis étudiant (transaction)
    $resA = $controller->handle([
        'action'  => 'create_filiere_then_student',
        'code'    => 'gd',
        'libelle' => 'Géologie Digitale',
        'cne'     => 'CNE8931',
        'nom'     => 'ouirouane',
        'prenom'  => 'hiba',
        'email'   => 'hibaouirouane@example.com',
    ]);
    showResult('Test A - Création Filière + Étudiant', $resA);

    // Cas 2 — Échec attendu: domaine email interdit
    $resB = $controller->handle([
        'action'     => 'create_etudiant',
        'cne'        => 'CNE1970',
        'nom'        => 'yasmine',
        'prenom'     => 'Yassmine',
        'email'      => 'yassmine@mailinator.com',
        'filiere_id' => 1,
    ]);
    showResult('Test B - Email interdit', $resB);

    // Cas 3 — Échec attendu: CNE invalide (format)
    $resC = $controller->handle([
        'action'     => 'create_etudiant',
        'cne'        => 'CNE-95', // volontairement faux
        'nom'        => 'amine',
        'prenom'     => 'saad',
        'email'      => 'saad.amine@example.com',
        'filiere_id' => 1,
    ]);
    showResult('Test C - CNE invalide', $resC);

    // Cas 4 — Échec attendu: suppression filière avec étudiants rattachés
    $resD = $controller->handle([
        'action' => 'delete_filiere',
        'id'     => 1,
    ]);
    showResult('Test D - Suppression filière interdite', $resD);

} catch (Throwable $err) {
    echo "<pre>ERREUR FATALE: {$err->getMessage()}\n{$err->getTraceAsString()}</pre>";
}