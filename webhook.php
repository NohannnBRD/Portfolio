<?php
// webhook.php - Proxy sécurisé pour Discord
// Sécurité : Seul ton site a le droit d'appeler ce script
header("Access-Control-Allow-Origin: https://nbrd.fr");
header("Content-Type: application/json");

// Vérifie que c'est bien une requête POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    die(json_encode(["error" => "Method not allowed"]));
}

// --- CONFIGURATION ---
// ⚠️ METS TON LIEN WEBHOOK DISCORD ICI ENTRE LES GUILLEMETS ⚠️
$webhookurl = "https://discord.com/api/webhooks/1444493131868541109/2CUejtsrRMtpKntbMPQ7j1GujGJbra-R0m0VQVOdXMysPai8yxxgvJFCmEuXEulhAnnF";

// Récupération de l'IP du visiteur (pour le log)
$ip = $_SERVER['REMOTE_ADDR'];

// --- SÉCURITÉ : Anti-Spam (Rate Limiting) ---
// Objectif : Empêcher un bot d'appeler l'alerte discord en boucle
$cache_dir = sys_get_temp_dir();
$ip_hash = md5($ip);
$cache_file = $cache_dir . '/webhook_limit_' . $ip_hash . '.txt';

// Limite à 1 alerte toutes les 60 secondes par IP
if (file_exists($cache_file) && (time() - filemtime($cache_file)) < 60) {
    http_response_code(429); // 429 Too Many Requests
    die(json_encode(["error" => "Rate limit exceeded. Try again later."]));
}
// Mise à jour du timer de l'IP
file_put_contents($cache_file, time());
// --------------------------------------------

$date = date('d/m/Y H:i:s');
$user_agent = $_SERVER['HTTP_USER_AGENT'];

// Construction du message stylé (Embed Discord)
$json_data = json_encode([
    "username" => "Honeypot Security",
    "avatar_url" => "https://nbrd.fr/img/favicon.svg", // Ton logo
    "embeds" => [
        [
            "title" => "🚨 ALERTE : Honeypot Déclenché !",
            "type" => "rich",
            "description" => "Un visiteur a cliqué sur le lien administrateur caché.",
            "color" => hexdec("FF0000"), // Rouge
            "fields" => [
                [
                    "name" => "📅 Date",
                    "value" => $date,
                    "inline" => true
                ],
                [
                    "name" => "🌐 IP",
                    "value" => $ip,
                    "inline" => true
                ],
                [
                    "name" => "🕵️ User Agent",
                    "value" => $user_agent,
                    "inline" => false
                ]
            ],
            "footer" => [
                "text" => "Système de surveillance NBRD"
            ]
        ]
    ]
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

// Envoi de la requête à Discord via cURL (Côté Serveur)
$ch = curl_init($webhookurl);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$response = curl_exec($ch);
curl_close($ch);

echo json_encode(["status" => "success", "message" => "Alerte envoyée"]);
?>