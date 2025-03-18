<?php
$servername = "127.0.0.1"; // Vérifie bien ce champ
$username = "root"; // Vérifie l'utilisateur
$password = ""; // Mets le bon mot de passe si nécessaire
$database = "cesizen"; // Vérifie le nom de la BDD

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}
echo "Connexion réussie à la base de données !";
$conn->close();
?>
