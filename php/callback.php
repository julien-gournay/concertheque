<?php
session_start();  // On va stocker le token en session

$client_id = "adef4007c20249c9abcacb00abad0df2";
$client_secret = "aed9aa2e8ccf43c5a535128e7cb78e08";
$redirect_uri = "http://localhost/concert/php/callback.php";

if (!isset($_GET['code'])) {
    die("Code manquant !");
}

$code = $_GET['code'];
$url = "https://accounts.spotify.com/api/token";

$data = [
    "grant_type" => "authorization_code",
    "code" => $code,
    "redirect_uri" => $redirect_uri,
    "client_id" => $client_id,
    "client_secret" => $client_secret
];

$options = [
    "http" => [
        "header" => "Content-Type: application/x-www-form-urlencoded",
        "method" => "POST",
        "content" => http_build_query($data)
    ]
];

$context = stream_context_create($options);
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/x-www-form-urlencoded"]);
$response = curl_exec($ch);
if ($response === false) {
    die("Erreur cURL : " . curl_error($ch));
}
curl_close($ch);

var_dump($response);
$token_info = json_decode($response, true);

if (!isset($token_info['access_token'])) {
    die("Erreur d'authentification !");
}

$_SESSION['access_token'] = $token_info['access_token'];  // Stocker le token en session
echo($_SESSION['access_token']);
header("Location: ../top_artists.php");  // Rediriger vers la page des artistes
exit;
?>
