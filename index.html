<?php
session_start();

/*
  TEK DOSYA KURULUM: index.php

  GEREKENLER
  1) Bu dosyayı index.php olarak yükleyin.
  2) PHP 8+ önerilir.
  3) SMTP için PHPMailer kurulu olmalı:
     - Composer kullanıyorsanız: vendor/autoload.php
     - Manuel kullanıyorsanız: /PHPMailer/src/ klasörü
  4) Aşağıdaki SQL ile tabloyu oluşturun:

  CREATE TABLE quote_requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(150) NOT NULL,
    phone VARCHAR(50) NOT NULL,
    email VARCHAR(190) DEFAULT NULL,
    site_name VARCHAR(190) NOT NULL,
    service_type VARCHAR(120) NOT NULL,
    independent_count VARCHAR(50) DEFAULT NULL,
    message TEXT DEFAULT NULL,
    ip_address VARCHAR(64) DEFAULT NULL,
    user_agent VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
  ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
*/

mb_internal_encoding('UTF-8');
date_default_timezone_set('Europe/Istanbul');

$config = [
    'site_name' => 'Güzey Grup',
    'admin_email' => 'info@gzygrup.com',
    'db' => [
        'host' => 'localhost',
        'name' => 'gzygrup_db',
        'user' => 'gzygrup_user',
        'pass' => 'SIFRENIZI_BURAYA_YAZIN',
        'charset' => 'utf8mb4',
    ],
    'smtp' => [
        'host' => 'mail.gzygrup.com',
        'username' => 'info@gzygrup.com',
        'password' => 'SMTP_SIFRENIZI_BURAYA_YAZIN',
        'port' => 587,
        'secure' => 'tls',
        'from_email' => 'info@gzygrup.com',
        'from_name' => 'Güzey Grup Web Formu',
    ],
];

$phpMailerLoaded = false;
if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/vendor/autoload.php';
    $phpMailerLoaded = true;
} elseif (
    file_exists(__DIR__ . '/PHPMailer/src/PHPMailer.php') &&
    file_exists(__DIR__ . '/PHPMailer/src/SMTP.php') &&
    file_exists(__DIR__ . '/PHPMailer/src/Exception.php')
) {
    require_once __DIR__ . '/PHPMailer/src/Exception.php';
    require_once __DIR__ . '/PHPMailer/src/PHPMailer.php';
    require_once __DIR__ . '/PHPMailer/src/SMTP.php';
    $phpMailerLoaded = true;
}

function e(string $value): string {
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function old(string $key): string {
    return e($_POST[$key] ?? '');
}

function csrf_token(): string {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function valid_csrf(string $token): bool {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

function get_pdo(array $db): ?PDO {
    try {
        $dsn = sprintf('mysql:host=%s;dbname=%s;charset=%s', $db['host'], $db['name'], $db['charset']);
        return new PDO($dsn, $db['user'], $db['pass'], [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]);
    } catch (Throwable $e) {
        return null;
    }
}

function rate_limited(): bool {
    $now = time();
    $window = 60;
    $limit = 4;

    if (!isset($_SESSION['quote_attempts'])) {
        $_SESSION['quote_attempts'] = [];
    }

    $_SESSION['quote_attempts'] = array_values(array_filter(
        $_SESSION['quote_attempts'],
        static fn($ts) => ($now - (int)$ts) < $window
    ));

    if (count($_SESSION['quote_attempts']) >= $limit) {
        return true;
    }

    $_SESSION['quote_attempts'][] = $now;
    return false;
}

function save_quote(?PDO $pdo, array $data): bool {
    if (!$pdo) return false;

    try {
        $stmt = $pdo->prepare('INSERT INTO quote_requests
            (full_name, phone, email, site_name, service_type, independent_count, message, ip_address, user_agent)
            VALUES (:full_name, :phone, :email, :site_name, :service_type, :independent_count, :message, :ip_address, :user_agent)');

        return $stmt->execute([
            ':full_name' => $data['full_name'],
            ':phone' => $data['phone'],
            ':email' => $data['email'] ?: null,
            ':site_name' => $data['site_name'],
            ':service_type' => $data['service_type'],
            ':independent_count' => $data['independent_count'] ?: null,
            ':message' => $data['message'] ?: null,
            ':ip_address' => $data['ip_address'] ?: null,
            ':user_agent' => $data['user_agent'] ?: null,
        ]);
    } catch (Throwable $e) {
        return false;
    }
}

function send_quote_mail(array $config, array $data, bool $phpMailerLoaded): array {
    if (!$phpMailerLoaded) {
        return ['ok' => false, 'message' => 'PHPMailer bulunamadı.'];
    }

    try {
        $mail = new PHPMailer\PHPMailer\PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = $config['smtp']['host'];
        $mail->SMTPAuth = true;
        $mail->Username = $config['smtp']['username'];
        $mail->Password = $config['smtp']['password'];
        $mail->Port = (int)$config['smtp']['port'];
        $mail->CharSet = 'UTF-8';

        if ($config['smtp']['secure'] === 'ssl') {
            $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_SMTPS;
        } else {
            $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
        }

        $mail->setFrom($config['smtp']['from_email'], $config['smtp']['from_name']);
        $mail->addAddress($config['admin_email'], $config['site_name']);

        if (!empty($data['email']) && filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $mail->addReplyTo($data['email'], $data['full_name']);
        }

        $mail->isHTML(true);
        $mail->Subject = 'Yeni Teklif Talebi | ' . $data['site_name'] . ' | ' . $data['service_type'];

        $html = '
            <h2>Yeni teklif talebi alındı</h2>
            <table cellpadding="8" cellspacing="0" border="0">
              <tr><td><strong>Ad Soyad</strong></td><td>' . e($data['full_name']) . '</td></tr>
              <tr><td><strong>Telefon</strong></td><td>' . e($data['phone']) . '</td></tr>
              <tr><td><strong>E-Posta</strong></td><td>' . e($data['email'] ?: '-') . '</td></tr>
              <tr><td><strong>Site / Apartman</strong></td><td>' . e($data['site_name']) . '</td></tr>
              <tr><td><strong>Hizmet</strong></td><td>' . e($data['service_type']) . '</td></tr>
              <tr><td><strong>Bağımsız Bölüm</strong></td><td>' . e($data['independent_count'] ?: '-') . '</td></tr>
              <tr><td><strong>Mesaj</strong></td><td>' . nl2br(e($data['message'] ?: '-')) . '</td></tr>
              <tr><td><strong>IP</strong></td><td>' . e($data['ip_address'] ?: '-') . '</td></tr>
            </table>';

        $plain = "Yeni teklif talebi alındı\n\n";
        $plain .= "Ad Soyad: {$data['full_name']}\n";
        $plain .= "Telefon: {$data['phone']}\n";
        $plain .= "E-Posta: " . ($data['email'] ?: '-') . "\n";
        $plain .= "Site / Apartman: {$data['site_name']}\n";
        $plain .= "Hizmet: {$data['service_type']}\n";
        $plain .= "Bağımsız Bölüm: " . ($data['independent_count'] ?: '-') . "\n";
        $plain .= "Mesaj: " . ($data['message'] ?: '-') . "\n";
        $plain .= "IP: " . ($data['ip_address'] ?: '-') . "\n";

        $mail->Body = $html;
        $mail->AltBody = $plain;
        $mail->send();

        return ['ok' => true, 'message' => 'Mail gönderildi.'];
    } catch (Throwable $e) {
        return ['ok' => false, 'message' => 'SMTP gönderimi başarısız: ' . $e->getMessage()];
    }
}

$successMessage = '';
$errorMessage = '';
$openModalOnLoad = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['form_type'] ?? '') === 'quote_request') {
    $openModalOnLoad = true;

    $fullName = trim($_POST['fullName'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $siteName = trim($_POST['siteName'] ?? '');
    $serviceType = trim($_POST['serviceType'] ?? '');
    $independentCount = trim($_POST['independentCount'] ?? '');
    $message = trim($_POST['message'] ?? '');
    $csrf = $_POST['csrf_token'] ?? '';
    $websiteField = trim($_POST['website'] ?? '');
    $formStartedAt = (int)($_POST['form_started_at'] ?? 0);

    if (!valid_csrf($csrf)) {
        $errorMessage = 'Güvenlik doğrulaması başarısız oldu. Sayfayı yenileyip tekrar deneyin.';
    } elseif ($websiteField !== '') {
        $errorMessage = 'Spam tespit edildi.';
    } elseif ($formStartedAt > 0 && (time() - $formStartedAt) < 4) {
        $errorMessage = 'Form çok hızlı gönderildi. Lütfen bilgileri kontrol edip tekrar deneyin.';
    } elseif (rate_limited()) {
        $errorMessage = 'Çok sık deneme yapıldı. Lütfen 1 dakika sonra tekrar deneyin.';
    } elseif ($fullName === '' || $phone === '' || $siteName === '' || $serviceType === '') {
        $errorMessage = 'Lütfen zorunlu alanları doldurun.';
    } elseif ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessage = 'Geçerli bir e-posta adresi girin.';
    } else {
        $data = [
            'full_name' => $fullName,
            'phone' => $phone,
            'email' => $email,
            'site_name' => $siteName,
            'service_type' => $serviceType,
            'independent_count' => $independentCount,
            'message' => $message,
            'ip_address' => $_SERVER['REMOTE_ADDR'] ?? '',
            'user_agent' => substr($_SERVER['HTTP_USER_AGENT'] ?? '', 0, 255),
        ];

        $pdo = get_pdo($config['db']);
        $saved = save_quote($pdo, $data);
        $mailResult = send_quote_mail($config, $data, $phpMailerLoaded);

        if ($saved && $mailResult['ok']) {
            $successMessage = 'Teklif talebiniz başarıyla gönderildi. En kısa sürede sizinle iletişime geçeceğiz.';
            $_POST = [];
            $openModalOnLoad = true;
        } elseif (!$saved && $mailResult['ok']) {
            $successMessage = 'Mail gönderildi ancak veritabanına kayıt yapılamadı. Veritabanı ayarlarını kontrol edin.';
        } elseif ($saved && !$mailResult['ok']) {
            $errorMessage = 'Talep veritabanına kaydedildi ancak mail gönderilemedi. ' . $mailResult['message'];
        } else {
            $errorMessage = 'Talep gönderilemedi. Veritabanı ve SMTP ayarlarını kontrol edin. ' . $mailResult['message'];
        }
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Güzey Grup | Profesyonel Bina ve Site Yönetimi</title>
  <meta name="description" content="Güzey Grup; bina ve site yönetimi, hukuk, temizlik, güvenlik, peyzaj ve teknik destek alanlarında profesyonel çözümler sunar." />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500;600;700&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <style>
    :root {
      --gold: #b89133;
      --gold-dark: #8e6d1e;
      --bg: #f7f7f5;
      --bg-soft: #ffffff;
      --panel: #ffffff;
      --panel-2: #fcfcfa;
      --line: #e7e4dc;
      --line-dark: #d9d4c8;
      --text: #1b1f23;
      --muted: #69707a;
      --shadow: 0 18px 40px rgba(17, 24, 39, 0.08);
      --shadow-soft: 0 10px 25px rgba(17, 24, 39, 0.05);
      --radius: 26px;
      --container: 1200px;
      --success-bg: #edf9f1;
      --success-line: #b8e2c3;
      --success-text: #1f6a37;
      --error-bg: #fff1f1;
      --error-line: #f0c5c5;
      --error-text: #9b2c2c;
    }
    * { box-sizing: border-box; margin: 0; padding: 0; }
    html { scroll-behavior: smooth; }
    body { font-family: 'Inter', Arial, sans-serif; background: linear-gradient(180deg, #fafaf8 0%, #f4f3ef 100%); color: var(--text); line-height: 1.6; overflow-x: hidden; letter-spacing: -0.01em; }
    a { text-decoration: none; color: inherit; }
    img { max-width: 100%; display: block; }
    button, input, select, textarea { font: inherit; }
    .container { width: min(var(--container), calc(100% - 34px)); margin: 0 auto; }
    .icon { width: 22px; height: 22px; stroke: currentColor; fill: none; stroke-width: 1.8; stroke-linecap: round; stroke-linejoin: round; flex: 0 0 auto; }
    header { position: sticky; top: 0; z-index: 1000; background: rgba(255,255,255,0.92); backdrop-filter: blur(14px); border-bottom: 1px solid rgba(0,0,0,0.05); }
    .header-inner { min-height: 84px; display: flex; align-items: center; justify-content: space-between; gap: 24px; }
    .brand { display: flex; align-items: center; gap: 14px; }
    .brand-mark { width: 48px; height: 48px; display: grid; place-items: center; border-radius: 16px; background: linear-gradient(180deg, #fffef9 0%, #f3ecdd 100%); border: 1px solid var(--line-dark); box-shadow: var(--shadow-soft); color: var(--gold-dark); font-family: 'Cormorant Garamond', serif; font-size: 1.1rem; font-weight: 700; letter-spacing: 0.08em; }
    .brand-text strong { display: block; font-family: 'Cormorant Garamond', serif; font-size: 1.7rem; line-height: 1; letter-spacing: 0.03em; }
    .brand-text span { display: block; color: var(--muted); font-size: 0.86rem; margin-top: 3px; }
    nav { display: flex; align-items: center; gap: 28px; }
    nav a { font-weight: 600; color: #38414b; position: relative; }
    nav a::after { content: ""; position: absolute; left: 0; bottom: -9px; width: 100%; height: 2px; background: var(--gold); transform: scaleX(0); transform-origin: left; transition: transform 0.25s ease; }
    nav a:hover::after, nav a:focus-visible::after { transform: scaleX(1); }
    .nav-actions { display: flex; align-items: center; gap: 12px; }
    .btn { display: inline-flex; align-items: center; justify-content: center; gap: 10px; padding: 14px 22px; border-radius: 999px; border: 1px solid transparent; font-weight: 700; cursor: pointer; transition: 0.25s ease; }
    .btn-primary { background: var(--gold); color: #fff; box-shadow: 0 12px 26px rgba(184,145,51,0.22); }
    .btn-primary:hover { transform: translateY(-2px); }
    .btn-secondary { background: #fff; color: var(--text); border-color: var(--line); }
    .btn-secondary:hover { border-color: var(--line-dark); color: var(--gold-dark); }
    .menu-toggle { display: none; background: transparent; border: 0; font-size: 1.7rem; color: var(--gold-dark); cursor: pointer; }
    .hero { padding: 76px 0 52px; }
    .hero-grid { display: grid; grid-template-columns: 1.05fr 0.95fr; gap: 34px; align-items: center; min-height: calc(100vh - 120px); }
    .hero-copy .eyebrow { display: inline-flex; align-items: center; gap: 10px; padding: 10px 16px; border-radius: 999px; background: #fffdf6; border: 1px solid #eee4cb; color: var(--gold-dark); font-size: 0.9rem; font-weight: 700; margin-bottom: 18px; }
    .hero h1 { font-family: 'Cormorant Garamond', serif; font-size: clamp(3rem, 6vw, 5.3rem); line-height: 0.95; letter-spacing: 0.01em; margin-bottom: 18px; }
    .hero h1 span { color: var(--gold-dark); display: block; margin-top: 10px; }
    .hero p { color: var(--muted); font-size: 1.08rem; max-width: 680px; margin-bottom: 28px; }
    .hero-actions { display: flex; flex-wrap: wrap; gap: 12px; margin-bottom: 22px; }
    .hero-trust { display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 34px; }
    .hero-trust span { padding: 10px 14px; border-radius: 999px; background: #fff; border: 1px solid var(--line); color: var(--muted); font-size: 0.9rem; font-weight: 600; box-shadow: var(--shadow-soft); }
    .hero-stats { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 14px; max-width: 760px; }
    .stat { background: var(--panel); border: 1px solid var(--line); border-radius: 20px; padding: 18px; box-shadow: var(--shadow-soft); }
    .stat strong { display: block; color: var(--gold-dark); font-size: 1.25rem; margin-bottom: 6px; }
    .stat span { color: var(--muted); font-size: 0.92rem; }
    .hero-card { background: linear-gradient(180deg, #ffffff 0%, #fbfaf7 100%); border: 1px solid var(--line); border-radius: 30px; box-shadow: var(--shadow); overflow: hidden; padding: 18px; }
    .hero-showcase { min-height: 560px; border-radius: 24px; background: linear-gradient(180deg, #ffffff 0%, #f8f6f1 100%); border: 1px solid var(--line); overflow: hidden; position: relative; }
    .showcase-topbar { height: 58px; display: flex; align-items: center; justify-content: space-between; padding: 0 18px; background: rgba(255,255,255,0.8); border-bottom: 1px solid var(--line); }
    .topbar-dots { display: flex; gap: 8px; }
    .topbar-dots span { width: 10px; height: 10px; border-radius: 50%; background: #d9d9d9; }
    .topbar-label { color: var(--muted); font-size: 0.88rem; font-weight: 600; }
    .showcase-content { padding: 22px; display: grid; grid-template-columns: 1fr 1fr; gap: 18px; height: calc(100% - 58px); }
    .showcase-panel, .logo-panel { border-radius: 22px; background: #fff; border: 1px solid var(--line); box-shadow: var(--shadow-soft); }
    .showcase-panel { padding: 26px; display: flex; flex-direction: column; justify-content: space-between; }
    .showcase-panel h3 { font-family: 'Cormorant Garamond', serif; font-size: 2.3rem; line-height: 1; margin-bottom: 12px; }
    .showcase-panel p { color: var(--muted); max-width: 300px; }
    .showcase-mini-cards { display: grid; gap: 12px; margin-top: 24px; }
    .showcase-mini-card { display: flex; align-items: center; justify-content: space-between; gap: 12px; padding: 14px 16px; border-radius: 18px; background: #fcfbf8; border: 1px solid var(--line); }
    .showcase-mini-card strong { display: block; font-size: 0.96rem; margin-bottom: 4px; }
    .showcase-mini-card span { color: var(--muted); font-size: 0.84rem; }
    .mini-status { width: 13px; height: 13px; border-radius: 50%; background: var(--gold); box-shadow: 0 0 0 6px rgba(184,145,51,0.12); }
    .logo-panel { padding: 26px; display: grid; place-items: center; position: relative; overflow: hidden; background: linear-gradient(180deg, #fff 0%, #fbfaf6 100%); }
    .logo-panel::before { content: ""; position: absolute; inset: 22px; border: 1px dashed #e8deca; border-radius: 18px; pointer-events: none; }
    .logo-wrap { width: min(74%, 290px); aspect-ratio: 1 / 1; display: grid; place-items: center; border-radius: 26px; background: linear-gradient(180deg, #fffdf8 0%, #f5efdf 100%); border: 1px solid #eadfc5; box-shadow: 0 16px 30px rgba(184,145,51,0.12); padding: 22px; position: relative; z-index: 1; }
    .logo-wrap img { max-width: 100%; max-height: 100%; object-fit: contain; filter: drop-shadow(0 8px 18px rgba(17,24,39,0.08)); }
    .mini-badge { position: absolute; left: 22px; right: 22px; bottom: 22px; padding: 16px 18px; border-radius: 18px; background: rgba(255,255,255,0.95); border: 1px solid var(--line); box-shadow: var(--shadow-soft); z-index: 1; }
    .mini-badge strong { display: block; font-family: 'Cormorant Garamond', serif; font-size: 1.25rem; margin-bottom: 5px; }
    .mini-badge p { color: var(--muted); font-size: 0.9rem; }
    section { padding: 92px 0; }
    .section-head { max-width: 760px; margin: 0 auto 42px; text-align: center; }
    .section-head .tag { display: inline-block; margin-bottom: 12px; color: var(--gold-dark); font-size: 0.8rem; font-weight: 800; letter-spacing: 0.1em; text-transform: uppercase; }
    .section-head h2 { font-family: 'Cormorant Garamond', serif; font-size: clamp(2.4rem, 4vw, 3.5rem); line-height: 1; margin-bottom: 14px; }
    .section-head p { color: var(--muted); font-size: 1rem; }
    .about-grid, .contact-wrap { display: grid; grid-template-columns: 1fr 1fr; gap: 24px; }
    .glass-card { background: var(--panel); border: 1px solid var(--line); border-radius: var(--radius); box-shadow: var(--shadow-soft); padding: 30px; }
    .about-text p, .contact-card p, .contact-info p { color: var(--muted); margin-bottom: 16px; }
    .feature-list { display: grid; gap: 16px; }
    .feature-item { display: flex; gap: 14px; align-items: flex-start; }
    .feature-icon { width: 44px; height: 44px; display: grid; place-items: center; border-radius: 14px; background: #fffaf0; border: 1px solid #eddcae; color: var(--gold-dark); flex: 0 0 auto; }
    .feature-item strong { display: block; margin-bottom: 4px; }
    .feature-item p { color: var(--muted); font-size: 0.96rem; }
    .services-grid { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 20px; }
    .service-card { background: var(--panel); border: 1px solid var(--line); border-radius: 24px; padding: 26px; box-shadow: var(--shadow-soft); transition: 0.25s ease; }
    .service-card:hover { transform: translateY(-6px); border-color: #dcc99a; box-shadow: 0 20px 32px rgba(17, 24, 39, 0.08); }
    .service-icon { width: 56px; height: 56px; display: grid; place-items: center; border-radius: 18px; margin-bottom: 18px; background: linear-gradient(180deg, #fffaf0 0%, #f7eed9 100%); border: 1px solid #ecdcae; color: var(--gold-dark); }
    .service-card h3 { font-family: 'Cormorant Garamond', serif; font-size: 1.55rem; margin-bottom: 8px; }
    .service-card p { color: var(--muted); font-size: 0.96rem; }
    .highlight-band { margin-top: 32px; display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 14px; }
    .highlight-item { background: #fff; border: 1px solid var(--line); border-radius: 20px; padding: 20px; text-align: center; box-shadow: var(--shadow-soft); }
    .highlight-item strong { display: block; font-family: 'Cormorant Garamond', serif; font-size: 1.22rem; margin-bottom: 5px; }
    .highlight-item span { color: var(--muted); font-size: 0.92rem; }
    .contact-card h3, .contact-info h3 { font-family: 'Cormorant Garamond', serif; font-size: 2rem; margin-bottom: 12px; }
    .contact-list { display: grid; gap: 14px; margin-top: 20px; }
    .contact-row { display: flex; gap: 14px; align-items: flex-start; padding: 16px 18px; background: #fcfbf8; border: 1px solid var(--line); border-radius: 18px; }
    .contact-row strong { display: block; margin-bottom: 4px; }
    .contact-row span, .contact-row a { color: var(--muted); font-size: 0.95rem; }
    .contact-row a:hover { color: var(--gold-dark); }
    .cta-box { margin-top: 24px; padding: 22px; border-radius: 20px; background: linear-gradient(180deg, #fffdf7 0%, #f7f0df 100%); border: 1px solid #ead9ab; }
    .cta-box strong { display: block; font-family: 'Cormorant Garamond', serif; font-size: 1.45rem; margin-bottom: 8px; }
    .cta-box p { margin-bottom: 16px; }
    .modal-overlay { position: fixed; inset: 0; background: rgba(16, 18, 21, 0.46); backdrop-filter: blur(6px); display: none; align-items: center; justify-content: center; padding: 18px; z-index: 2000; }
    .modal-overlay.active { display: flex; }
    .quote-modal { width: min(760px, 100%); max-height: 90vh; overflow-y: auto; background: #fff; border: 1px solid var(--line); border-radius: 28px; padding: 28px; box-shadow: 0 28px 70px rgba(17, 24, 39, 0.18); position: relative; }
    .modal-close { position: absolute; top: 14px; right: 14px; width: 42px; height: 42px; border-radius: 50%; border: 1px solid var(--line); background: #fff; cursor: pointer; color: var(--text); font-size: 1.4rem; }
    .quote-modal-head h2 { font-family: 'Cormorant Garamond', serif; font-size: 2.5rem; line-height: 1; margin: 8px 0 10px; }
    .quote-modal-head p { color: var(--muted); margin-bottom: 24px; }
    .quote-form { display: grid; gap: 18px; }
    .form-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 16px; }
    .form-group { display: grid; gap: 8px; }
    .form-group label { font-weight: 600; color: var(--text); font-size: 0.95rem; }
    .form-group input, .form-group select, .form-group textarea { width: 100%; border: 1px solid var(--line); background: #fff; color: var(--text); border-radius: 16px; padding: 14px 16px; outline: none; transition: border-color 0.2s ease, box-shadow 0.2s ease; }
    .form-group input:focus, .form-group select:focus, .form-group textarea:focus { border-color: #d6be7c; box-shadow: 0 0 0 4px rgba(184,145,51,0.10); }
    .full-width { grid-column: 1 / -1; }
    .form-note, .form-success, .form-error { padding: 14px 16px; border-radius: 16px; font-size: 0.94rem; }
    .form-note { background: #fffaf0; border: 1px solid #efdfb3; color: #6f6553; }
    .form-success { background: var(--success-bg); border: 1px solid var(--success-line); color: var(--success-text); font-weight: 600; }
    .form-error { background: var(--error-bg); border: 1px solid var(--error-line); color: var(--error-text); font-weight: 600; }
    .form-actions { display: flex; flex-wrap: wrap; gap: 12px; }
    .hp-field { position: absolute !important; left: -9999px !important; opacity: 0 !important; pointer-events: none !important; height: 0 !important; width: 0 !important; overflow: hidden !important; }
    footer { border-top: 1px solid var(--line); padding: 28px 0 40px; color: var(--muted); background: rgba(255,255,255,0.6); }
    .footer-inner { display: flex; justify-content: space-between; gap: 20px; align-items: center; flex-wrap: wrap; }
    .footer-links { display: flex; gap: 18px; flex-wrap: wrap; }
    .footer-links a:hover { color: var(--gold-dark); }
    .whatsapp-float { position: fixed; right: 20px; bottom: 20px; z-index: 1000; background: #c49a3a; color: #fff; padding: 14px 18px; border-radius: 999px; font-weight: 800; box-shadow: 0 16px 30px rgba(184,145,51,0.24); }
    @media (max-width: 1100px) { .hero-grid, .about-grid, .contact-wrap, .showcase-content { grid-template-columns: 1fr; } .hero-showcase { min-height: auto; } .services-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); } .highlight-band { grid-template-columns: repeat(2, minmax(0, 1fr)); } }
    @media (max-width: 860px) { .menu-toggle { display: inline-flex; } nav { position: absolute; top: calc(100% + 8px); left: 16px; right: 16px; display: none; flex-direction: column; align-items: flex-start; gap: 16px; padding: 20px; background: #fff; border: 1px solid var(--line); border-radius: 22px; box-shadow: var(--shadow); } nav.active { display: flex; } .nav-actions .btn-secondary { display: none; } .hero { padding-top: 54px; } .hero-grid { min-height: auto; } .hero-stats, .services-grid, .highlight-band, .form-grid { grid-template-columns: 1fr; } }
    @media (max-width: 560px) { .container { width: min(var(--container), calc(100% - 24px)); } .hero h1 { font-size: 2.4rem; } .quote-modal { padding: 22px 16px; } .quote-modal-head h2 { font-size: 2rem; } .brand-text strong { font-size: 1.45rem; } .showcase-panel, .logo-panel, .glass-card, .service-card { padding: 22px; } .logo-wrap { width: min(76%, 230px); } .whatsapp-float { right: 12px; bottom: 12px; padding: 12px 15px; font-size: 0.92rem; } }
  </style>
</head>
<body>
  <header>
    <div class="container header-inner">
      <a href="#home" class="brand" aria-label="Güzey Grup ana sayfa">
        <div class="brand-mark">GG</div>
        <div class="brand-text">
          <strong>GÜZEY GRUP</strong>
          <span>Bina ve Site Yönetim Hizmetleri</span>
        </div>
      </a>
      <button class="menu-toggle" id="menuToggle" aria-label="Menüyü aç">☰</button>
      <nav id="navMenu">
        <a href="#about">Hakkımızda</a>
        <a href="#services">Hizmetler</a>
        <a href="#contact">İletişim</a>
      </nav>
      <div class="nav-actions">
        <a class="btn btn-secondary" href="mailto:info@gzygrup.com">E-Posta</a>
      </div>
    </div>
  </header>

  <main>
    <section class="hero" id="home">
      <div class="container hero-grid">
        <div class="hero-copy">
          <div class="eyebrow">Kurumsal Yönetimde Güven, Şeffaflık ve Düzen</div>
          <h1>Profesyonel <span>Bina ve Site Yönetimi</span></h1>
          <p>Güzey Grup olarak İzmir merkezli yapımızla; bina ve site yönetimi, hukuk, temizlik, güvenlik, peyzaj ve destek hizmetlerinde daha düzenli, daha güven veren ve kurumsal çözümler sunuyoruz.</p>
          <div class="hero-actions">
            <button type="button" class="btn btn-primary" id="openQuoteModal">Teklif Al</button>
            <a href="#services" class="btn btn-secondary">Hizmetleri İncele</a>
          </div>
          <div class="hero-trust">
            <span>Profesyonel görünüm</span>
            <span>Düzenli operasyon</span>
            <span>Hızlı iletişim</span>
          </div>
          <div class="hero-stats">
            <div class="stat"><strong>2005</strong><span>İzmir'de kurulan köklü yapı</span></div>
            <div class="stat"><strong>7+ Hizmet</strong><span>Tek çatı altında çözüm</span></div>
            <div class="stat"><strong>Kurumsal</strong><span>Planlı takip ve raporlama</span></div>
          </div>
        </div>
        <div class="hero-card">
          <div class="hero-showcase">
            <div class="showcase-topbar">
              <div class="topbar-dots"><span></span><span></span><span></span></div>
              <div class="topbar-label">Güzey Grup Kurumsal Hizmet Yapısı</div>
            </div>
            <div class="showcase-content">
              <div class="showcase-panel">
                <div>
                  <h3>Güven veren<br>yönetim modeli</h3>
                  <p>Site ve apartman yönetiminde düzenli süreç, güçlü iletişim ve kontrollü operasyon yapısı.</p>
                </div>
                <div class="showcase-mini-cards">
                  <div class="showcase-mini-card"><div><strong>Operasyon Takibi</strong><span>Planlı ve kontrollü süreç yönetimi</span></div><div class="mini-status"></div></div>
                  <div class="showcase-mini-card"><div><strong>Finansal Düzen</strong><span>Takip edilebilir kurumsal yaklaşım</span></div><div class="mini-status"></div></div>
                  <div class="showcase-mini-card"><div><strong>Hızlı İletişim</strong><span>Teklif ve destek taleplerine dönüş</span></div><div class="mini-status"></div></div>
                </div>
              </div>
              <div class="logo-panel">
                <div class="logo-wrap"><img src="logo.png" alt="Güzey Grup logo" /></div>
                <div class="mini-badge"><strong>Profesyonel Yönetim Anlayışı</strong><p>Kurumsal görünüm, düzenli iletişim ve güven veren hizmet yaklaşımı.</p></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="about">
      <div class="container">
        <div class="section-head"><span class="tag">Hakkımızda</span><h2>Kurumsal yaklaşım, sürdürülebilir yönetim</h2><p>Yönetim süreçlerini yalnızca takip etmiyor; düzenli hale getiriyor, kayıt altına alıyor ve profesyonel bir yapıya dönüştürüyoruz.</p></div>
        <div class="about-grid">
          <div class="glass-card about-text">
            <p>2005 yılında İzmir'de kurulan Güzey Grup, bina ve site yönetimi alanında edindiği tecrübesini hukuk, temizlik, güvenlik, peyzaj ve destek hizmetleriyle birleştirerek kapsamlı bir hizmet yapısı sunmaktadır.</p>
            <p>Amacımız; yaşam alanlarında düzeni artırmak, yönetsel yükü azaltmak ve kat malikleri ile sakinler için güven veren, erişilebilir ve sistemli bir yönetim modeli oluşturmaktır.</p>
          </div>
          <div class="glass-card">
            <div class="feature-list">
              <div class="feature-item"><div class="feature-icon"><svg class="icon" viewBox="0 0 24 24"><path d="M3 10.5 12 3l9 7.5"></path><path d="M5 9.5V21h14V9.5"></path></svg></div><div><strong>Şeffaf yönetim</strong><p>Gider, süreç ve operasyon takibinde net, anlaşılır ve düzenli bir yapı.</p></div></div>
              <div class="feature-item"><div class="feature-icon"><svg class="icon" viewBox="0 0 24 24"><path d="M8 3h8"></path><path d="M9 3v4"></path><path d="M15 3v4"></path><path d="M5 9h14"></path><rect x="4" y="7" width="16" height="13" rx="2"></rect></svg></div><div><strong>Mevzuata uygun süreçler</strong><p>Kat mülkiyeti ve yönetsel işlemlerde profesyonel kontrol ve hukuki destek.</p></div></div>
              <div class="feature-item"><div class="feature-icon"><svg class="icon" viewBox="0 0 24 24"><path d="M4 12h16"></path><path d="M12 4v16"></path><circle cx="12" cy="12" r="9"></circle></svg></div><div><strong>Tek noktadan çözüm</strong><p>Yönetimden teknik desteğe kadar bütüncül hizmet organizasyonu.</p></div></div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="services">
      <div class="container">
        <div class="section-head"><span class="tag">Hizmetlerimiz</span><h2>Yaşam alanlarınız için kapsamlı hizmet yapısı</h2><p>Site ve apartman yönetiminde ihtiyaç duyulan temel operasyonları tek çatı altında planlı şekilde yürütüyoruz.</p></div>
        <div class="services-grid">
          <article class="service-card"><div class="service-icon"><svg class="icon" viewBox="0 0 24 24"><path d="M3 21h18"></path><path d="M5 21V7l7-4 7 4v14"></path><path d="M9 21v-6h6v6"></path></svg></div><h3>Bina ve Site Yönetimi</h3><p>Yönetim planı, aidat takibi, operasyon organizasyonu ve mevzuata uygun düzenli yönetim süreçleri.</p></article>
          <article class="service-card"><div class="service-icon"><svg class="icon" viewBox="0 0 24 24"><path d="M12 3 4 7v5c0 5 3.5 8 8 9 4.5-1 8-4 8-9V7l-8-4Z"></path><path d="M9.5 12.5 11 14l3.5-3.5"></path></svg></div><h3>Hukuk Hizmetleri</h3><p>Kat mülkiyeti, site yönetimi ve yönetsel süreçlerde hukuki danışmanlık ve destek hizmetleri.</p></article>
          <article class="service-card"><div class="service-icon"><svg class="icon" viewBox="0 0 24 24"><path d="M4 19h16"></path><path d="M6 19l2-9h8l2 9"></path><path d="M9 10V6h6v4"></path></svg></div><h3>Temizlik Hizmetleri</h3><p>Ortak alanlarda düzenli, kontrollü ve hijyen odaklı periyodik temizlik çözümleri.</p></article>
          <article class="service-card"><div class="service-icon"><svg class="icon" viewBox="0 0 24 24"><circle cx="11" cy="11" r="6"></circle><path d="m20 20-4.2-4.2"></path></svg></div><h3>Emlak Hizmetleri</h3><p>Güvenilir ve profesyonel gayrimenkul danışmanlığı ile ihtiyaçlara uygun yönlendirme desteği.</p></article>
          <article class="service-card"><div class="service-icon"><svg class="icon" viewBox="0 0 24 24"><path d="M7 14c0-5 3-8 5-10 2 2 5 5 5 10a5 5 0 0 1-10 0Z"></path><path d="M10 14c0 1.5.8 2.5 2 3"></path></svg></div><h3>İlaçlama</h3><p>Ortak yaşam alanlarında planlı, kontrollü ve çevreye duyarlı zararlı mücadele hizmetleri.</p></article>
          <article class="service-card"><div class="service-icon"><svg class="icon" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V7l-8-4-8 4v5c0 6 8 10 8 10Z"></path></svg></div><h3>Güvenlik</h3><p>Site ve apartmanlarda huzur, düzen ve kontrolü destekleyen güvenlik hizmetleri.</p></article>
          <article class="service-card"><div class="service-icon"><svg class="icon" viewBox="0 0 24 24"><path d="M12 21V11"></path><path d="M7 8c0-2.2 2.2-4 5-4s5 1.8 5 4-2.2 4-5 4-5-1.8-5-4Z"></path><path d="M5 21c.5-3.5 2.6-5 7-5s6.5 1.5 7 5"></path></svg></div><h3>Peyzaj</h3><p>Yaşam alanlarını daha estetik ve düzenli hale getiren çevre düzenleme ve bakım çözümleri.</p></article>
          <article class="service-card"><div class="service-icon"><svg class="icon" viewBox="0 0 24 24"><path d="M12 6v6l4 2"></path><circle cx="12" cy="12" r="9"></circle></svg></div><h3>Destek ve Takip</h3><p>Teknik konular, saha kontrolleri ve hizmet koordinasyonunda düzenli takip ve yönlendirme desteği.</p></article>
          <article class="service-card"><div class="service-icon"><svg class="icon" viewBox="0 0 24 24"><path d="M6 18V9"></path><path d="M12 18V5"></path><path d="M18 18v-7"></path></svg></div><h3>Raporlama</h3><p>Yönetim süreçlerini daha izlenebilir hale getiren planlı bilgi akışı ve düzenli durum bildirimi.</p></article>
        </div>
        <div class="highlight-band">
          <div class="highlight-item"><strong>Kurumsal iletişim</strong><span>Hızlı geri dönüş ve düzenli bilgilendirme</span></div>
          <div class="highlight-item"><strong>Operasyon takibi</strong><span>Süreçlerin kontrollü ve planlı ilerlemesi</span></div>
          <div class="highlight-item"><strong>Güven odaklı yapı</strong><span>Site sakinleri için düzenli yaşam alanları</span></div>
          <div class="highlight-item"><strong>Tek çatı altında çözüm</strong><span>Birden fazla hizmette koordineli yönetim</span></div>
        </div>
      </div>
    </section>

    <section id="contact">
      <div class="container">
        <div class="section-head"><span class="tag">İletişim</span><h2>Bizimle iletişime geçin</h2><p>Apartman, site ve yaşam alanı yönetimi için profesyonel hizmet talebinizi bizimle paylaşabilirsiniz.</p></div>
        <div class="contact-wrap">
          <div class="glass-card contact-card">
            <h3>Hızlı iletişim</h3>
            <p>Teklif, bilgi talebi ve hizmet detayları için aşağıdaki iletişim kanallarımızdan bize ulaşabilirsiniz.</p>
            <div class="contact-list">
              <div class="contact-row"><div><svg class="icon" viewBox="0 0 24 24"><path d="M22 16.9v3a2 2 0 0 1-2.2 2A19.8 19.8 0 0 1 3.1 5.2 2 2 0 0 1 5.1 3h3a2 2 0 0 1 2 1.7l.4 2.6a2 2 0 0 1-.6 1.8l-1.4 1.4a16 16 0 0 0 5 5l1.4-1.4a2 2 0 0 1 1.8-.6l2.6.4A2 2 0 0 1 22 16.9Z"></path></svg></div><div><strong>Telefon</strong><a href="tel:+905074725877">0507 472 58 77</a><br><a href="tel:+905526620158">0552 662 01 58</a><br><a href="tel:+902324847332">0232 484 73 32</a></div></div>
              <div class="contact-row"><div><svg class="icon" viewBox="0 0 24 24"><path d="M4 6h16v12H4z"></path><path d="m4 7 8 6 8-6"></path></svg></div><div><strong>E-Posta</strong><a href="mailto:info@gzygrup.com">info@gzygrup.com</a></div></div>
              <div class="contact-row"><div><svg class="icon" viewBox="0 0 24 24"><path d="M12 21s7-4.5 7-11a7 7 0 1 0-14 0c0 6.5 7 11 7 11Z"></path><circle cx="12" cy="10" r="2.5"></circle></svg></div><div><strong>Adres</strong><span>Manas Bulvarı No: 39, Folkart Towers B Kule, Kat: 33, Daire No: 3306, Bayraklı / İzmir</span></div></div>
            </div>
          </div>
          <div class="glass-card contact-info">
            <h3>Neden Güzey Grup?</h3>
            <p>Yönetim süreçlerinde yalnızca hizmet vermeyi değil, güven inşa etmeyi hedefliyoruz. Düzenli takip, profesyonel iletişim ve planlı operasyon anlayışıyla süreci uçtan uca yönetiyoruz.</p>
            <div class="cta-box"><strong>Teklif formu ve hızlı ulaşım</strong><p>Sorularınızı ve teklif taleplerinizi doğrudan bize iletebilir, WhatsApp hattımızdan hızlı iletişim kurabilirsiniz.</p><button type="button" class="btn btn-primary" id="openQuoteModalSecondary">Teklif Formunu Aç</button></div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <div class="modal-overlay <?php echo $openModalOnLoad ? 'active' : ''; ?>" id="quoteModal" aria-hidden="<?php echo $openModalOnLoad ? 'false' : 'true'; ?>">
    <div class="quote-modal" role="dialog" aria-modal="true" aria-labelledby="quoteModalTitle">
      <button type="button" class="modal-close" id="closeQuoteModal" aria-label="Formu kapat">×</button>
      <div class="quote-modal-head"><span class="tag">Teklif Talebi</span><h2 id="quoteModalTitle">Teklif formunu doldurun</h2><p>Form; spam koruması, SMTP ile e-posta gönderimi ve veritabanı kaydı ile çalışır.</p></div>
      <form id="quoteForm" class="quote-form" method="POST" action="">
        <input type="hidden" name="form_type" value="quote_request">
        <input type="hidden" name="csrf_token" value="<?php echo e(csrf_token()); ?>">
        <input type="hidden" name="form_started_at" value="<?php echo time(); ?>">
        <div class="hp-field" aria-hidden="true"><label for="website">Website</label><input type="text" id="website" name="website" tabindex="-1" autocomplete="off"></div>
        <?php if ($successMessage !== ''): ?><div class="form-success"><?php echo e($successMessage); ?></div><?php endif; ?>
        <?php if ($errorMessage !== ''): ?><div class="form-error"><?php echo e($errorMessage); ?></div><?php endif; ?>
        <div class="form-grid">
          <div class="form-group"><label for="fullName">Ad Soyad</label><input type="text" id="fullName" name="fullName" value="<?php echo old('fullName'); ?>" placeholder="Adınız Soyadınız" required></div>
          <div class="form-group"><label for="phone">Telefon</label><input type="tel" id="phone" name="phone" value="<?php echo old('phone'); ?>" placeholder="05xx xxx xx xx" required></div>
          <div class="form-group"><label for="email">E-Posta</label><input type="email" id="email" name="email" value="<?php echo old('email'); ?>" placeholder="ornek@mail.com"></div>
          <div class="form-group"><label for="siteName">Site / Apartman Adı</label><input type="text" id="siteName" name="siteName" value="<?php echo old('siteName'); ?>" placeholder="Site veya apartman adı" required></div>
          <div class="form-group"><label for="serviceType">Talep Edilen Hizmet</label><select id="serviceType" name="serviceType" required><option value="">Hizmet seçin</option><?php $services=['Bina ve Site Yönetimi','Hukuk Hizmetleri','Temizlik Hizmetleri','Güvenlik Hizmetleri','Peyzaj Hizmetleri','İlaçlama','Emlak Hizmetleri','Diğer']; $oldService=$_POST['serviceType'] ?? ''; foreach($services as $service): ?><option value="<?php echo e($service); ?>" <?php echo $oldService === $service ? 'selected' : ''; ?>><?php echo e($service); ?></option><?php endforeach; ?></select></div>
          <div class="form-group"><label for="independentCount">Bağımsız Bölüm Sayısı</label><input type="number" id="independentCount" name="independentCount" value="<?php echo old('independentCount'); ?>" placeholder="Örn: 48"></div>
        </div>
        <div class="form-group full-width"><label for="message">Talep Detayı</label><textarea id="message" name="message" rows="5" placeholder="İhtiyacınızı kısaca yazın"><?php echo old('message'); ?></textarea></div>
        <div class="form-note">Bu sürümde form gönderimleri <strong>SMTP</strong> ile e-posta olarak iletilir, ayrıca <strong>veritabanına kaydedilir</strong>. Spam koruması için <strong>CSRF</strong>, <strong>honeypot</strong>, <strong>zaman kontrolü</strong> ve <strong>oturum bazlı hız limiti</strong> uygulanır.</div>
        <div class="form-actions"><button type="submit" class="btn btn-primary">Teklif Talebini Gönder</button><button type="button" class="btn btn-secondary" id="cancelQuoteModal">Vazgeç</button></div>
      </form>
    </div>
  </div>

  <footer>
    <div class="container footer-inner"><div>© 2026 Güzey Grup. Tüm hakları saklıdır.</div><div class="footer-links"><a href="#about">Hakkımızda</a><a href="#services">Hizmetler</a><a href="#contact">İletişim</a></div></div>
  </footer>

  <a href="https://wa.me/905074725877" class="whatsapp-float" target="_blank" aria-label="WhatsApp ile iletişim">WhatsApp</a>

  <script>
    const menuToggle = document.getElementById('menuToggle');
    const navMenu = document.getElementById('navMenu');
    const quoteModal = document.getElementById('quoteModal');
    const openQuoteModal = document.getElementById('openQuoteModal');
    const openQuoteModalSecondary = document.getElementById('openQuoteModalSecondary');
    const closeQuoteModal = document.getElementById('closeQuoteModal');
    const cancelQuoteModal = document.getElementById('cancelQuoteModal');

    if (menuToggle) {
      menuToggle.addEventListener('click', () => navMenu.classList.toggle('active'));
    }
    document.querySelectorAll('nav a').forEach(link => {
      link.addEventListener('click', () => navMenu.classList.remove('active'));
    });

    function openModal() {
      quoteModal.classList.add('active');
      quoteModal.setAttribute('aria-hidden', 'false');
      document.body.style.overflow = 'hidden';
    }
    function closeModal() {
      quoteModal.classList.remove('active');
      quoteModal.setAttribute('aria-hidden', 'true');
      document.body.style.overflow = '';
    }

    if (openQuoteModal) openQuoteModal.addEventListener('click', openModal);
    if (openQuoteModalSecondary) openQuoteModalSecondary.addEventListener('click', openModal);
    if (closeQuoteModal) closeQuoteModal.addEventListener('click', closeModal);
    if (cancelQuoteModal) cancelQuoteModal.addEventListener('click', closeModal);
    if (quoteModal) {
      quoteModal.addEventListener('click', e => {
        if (e.target === quoteModal) closeModal();
      });
    }
    document.addEventListener('keydown', e => {
      if (e.key === 'Escape' && quoteModal && quoteModal.classList.contains('active')) closeModal();
    });
    <?php if ($openModalOnLoad): ?>
      document.body.style.overflow = 'hidden';
    <?php endif; ?>
  </script>
</body>
</html>
