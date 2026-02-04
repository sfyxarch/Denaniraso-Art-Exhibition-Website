<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pembayaran Berhasil - Tiket Pameran</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background: #181c24;
      color: #f5f5f5;
      margin: 0;
      padding: 0;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .container {
      background: #232a36;
      border-radius: 18px;
      box-shadow: 0 8px 32px rgba(0,0,0,0.25);
      padding: 2.5rem 2rem;
      max-width: 420px;
      width: 100%;
      text-align: center;
    }
    .checkmark {
      font-size: 3.5rem;
      color: #4caf50;
      margin-bottom: 1rem;
    }
    h1 {
      margin: 0.5rem 0 1rem 0;
      font-size: 1.7rem;
      font-weight: 700;
    }
    .details {
      background: #2e3747;
      border-radius: 12px;
      padding: 1.2rem 1rem;
      margin-bottom: 1.5rem;
      text-align: left;
      font-size: 1rem;
    }
    .details p {
      margin: 0.4rem 0;
    }
    .qr {
      margin: 1.2rem 0;
    }
    .countdown {
      font-size: 1.1rem;
      color: #ffca28;
      margin-bottom: 1.2rem;
    }
    .actions {
      display: flex;
      flex-direction: column;
      gap: 0.7rem;
      margin-top: 1.2rem;
    }
    .button {
      background: #66b2b2;
      color: #fff;
      border: none;
      border-radius: 8px;
      padding: 0.7rem 0;
      font-size: 1rem;
      cursor: pointer;
      font-weight: 600;
      transition: background 0.2s;
    }
    .button.secondary {
      background: #374151;
    }
    .button:hover {
      opacity: 0.92;
    }
    .note {
      font-size: 0.92rem;
      color: #bdbdbd;
      margin-top: 1.2rem;
    }
    a.map-link {
      color: #90caf9;
      text-decoration: none;
    }
    a.map-link:hover {
      text-decoration: underline;
    }
    .logo {
      width: 70px;
      margin-bottom: 0.7rem;
    }
  </style>
</head>
<body>
  <div class="container">
    <img src="DENANIRASO.png" alt="Logo Pameran" class="logo" width="" height="70">
    <h1>Pembayaran Berhasil!</h1>
    <p>Terima kasih, pembayaran tiket Anda telah diterima.</p>
    <div class="details">
      <p><strong>Nama:</strong> </p>
      <p><strong>Acara:</strong> Denaniraso Art</p>
      <p><strong>Tanggal: </strong></p>
      <p><strong>Jumlah Tiket: </strong> </p>
      <p><strong>Harga Total: </strong></p>
      <p><strong>Kode Tiket:</strong> <span id="ticket-code">TXD25-092843</span></p>
      <p><strong>Lokasi:</strong> <a href="https://maps.app.goo.gl/wssGDMZwqE7QbVpu6" target="_blank" class="map-link">Center Point Slamet Riyadi</a></p>
    </div>
    <div class="countdown">
      Acara dimulai dalam <span id="countdown-timer">...</span>
    </div>
    <div class="qr">
      <img id="qr-image" src="" alt="QR Code Tiket" width="200" height="200">
    </div>
    <div class="actions">
      <button class="button" onclick="window.print()">🖨️ Unduh Tiket</button>
      <button class="button secondary" onclick="window.location.href='../landingpage/index.php'">🏠 Kembali ke Beranda</button>
    </div>
    <div class="note">
      Tunjukkan tiket atau QR code ini saat masuk ke lokasi pameran
    </div>
  </div>
  <script>
    // Generate QR code dari kode tiket
    const ticketCode = document.getElementById("ticket-code").innerText;
    const qrUrl = `https://chart.googleapis.com/chart?cht=qr&chs=200x200&chl=${encodeURIComponent(ticketCode)}`;
    document.getElementById("qr-image").src = qrUrl;

    // Countdown ke tanggal acara
    const eventDate = new Date("2025-06-28T09:00:00");
    const countdownEl = document.getElementById("countdown-timer");
    function updateCountdown() {
      const now = new Date();
      const diff = eventDate - now;
      if (diff <= 0) {
        countdownEl.textContent = "Acara sudah dimulai!";
        return;
      }
      const days = Math.floor(diff / (1000 * 60 * 60 * 24));
      const hours = Math.floor((diff / (1000 * 60 * 60)) % 24);
      const minutes = Math.floor((diff / (1000 * 60)) % 60);
      const seconds = Math.floor((diff / 1000) % 60);
      countdownEl.textContent = `${days} hari, ${hours} jam, ${minutes} menit, ${seconds} detik`;
    }
    setInterval(updateCountdown, 1000);
    updateCountdown();
  </script>
</body>
</html>