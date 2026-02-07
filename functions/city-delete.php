<?php


function delete_city(PDO $pdo, string $units): void
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['delete_city_id'])) {
        return;
    }

    $idRaw = $_POST['delete_city_id'];

    if (is_string($idRaw) && ctype_digit($idRaw)) {
        $stmt = $pdo->prepare('DELETE FROM cities WHERE id = :id');
        $stmt->execute(['id' => (int)$idRaw]);
    }

    header('Location: /index.php?units=' . urlencode($units));
    exit;
}
