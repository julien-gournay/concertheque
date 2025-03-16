<?php
$client_id = "adef4007c20249c9abcacb00abad0df2";
$redirect_uri = "http://localhost/concert/php/callback.php";  // Mets l'URL définie dans Spotify
$scope = "user-top-read";  // Permission pour récupérer les artistes et titres écoutés

$auth_url = "https://accounts.spotify.com/authorize?" . http_build_query([
    "client_id" => $client_id,
    "response_type" => "code",
    "redirect_uri" => $redirect_uri,
    "scope" => $scope
]);

header("Location: $auth_url");
exit;
?>
