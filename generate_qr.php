<?php
include 'db.php';

// Získání uživatelského jména z předchozí registrace
$username = $_GET['username'] ?? '';

// Kontrola, zda uživatel existuje
if (!isset($_SESSION['users'][$username])) {
    echo "User not found!";
    exit;
}

// Vygenerování unikátního QR kódu pro uživatele
$qr_code_value = md5(uniqid($username, true));  // Unikátní kód pro QR
save_qr_code($username, $qr_code_value);

// Generování URL pro ověření QR kódu
$verification_url = "http://yourserver/verify_qr.php?user=$username&code=$qr_code_value";

// URL pro generování QR kódu pomocí API
$qr_code_url = "https://api.qrserver.com/v1/create-qr-code/?data=" . urlencode($verification_url) . "&size=150x150";

// Zobrazení QR kódu uživateli
echo "<h2>Scan this QR Code within 5 minutes:</h2>";
echo "<img src='$qr_code_url' alt='QR Code'><br>";
echo "<a href='index.php'>Go back to homepage</a>";
?>
