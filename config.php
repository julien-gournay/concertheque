<?php 
    $cnt = mysqli_connect ('localhost','root','');
    $mabase= mysqli_select_db($cnt, "concerts");

    $host = 'localhost';  // ou ton adresse de serveur
    $dbname = 'concerts';  // nom de ta base de données
    $username = 'root';  // ton utilisateur
    $password = '';  // ton mot de passe

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>