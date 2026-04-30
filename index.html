<?php
/**
 * GÜZEY GRUP - Premium Tek Sayfa Web Sitesi
 * Dosya adı: index.php
 * Kullanım: Mevcut hosting ana dizinine index.php olarak yükleyin.
 *
 * Not:
 * - Bu dosya tek başına çalışır.
 * - SMTP için PHPMailer kuruluysa vendor/autoload.php üzerinden kullanır.
 * - PHPMailer yoksa hosting mail() fonksiyonuna düşer.
 * - Veritabanı kaydı opsiyoneldir. Aşağıdaki DB ayarlarını doldurup DB_ENABLED = true yapabilirsiniz.
 */

declare(strict_types=1);
session_start();
date_default_timezone_set('Europe/Istanbul');

const COMPANY_NAME = 'Güzey Grup';
const ADMIN_EMAIL  = 'info@gzygrup.com';
const SITE_URL     = 'https://www.gzygrup.com';
const WHATSAPP_NO  = '905074725877';

// SMTP AYARLARI - PHPMailer kuruluysa kullanılır.
// cPanel/hosting bilgileriniz farklıysa burayı güncelleyin.
const SMTP_ENABLED = false;
const SMTP_HOST    = 'mail.gzygrup.com';
const SMTP_USER    = 'info@gzygrup.com';
const SMTP_PASS    = 'BURAYA_MAIL_SIFRESI';
const SMTP_PORT    = 587;
const SMTP_SECURE  = 'tls';

// VERİTABANI OPSİYONEL
const DB_ENABLED = false;
const DB_HOST    = 'localhost';
const DB_NAME    = 'gzygrup_db';
const DB_USER    = 'gzygrup_user';
const DB_PASS    = 'BURAYA_DB_SIFRESI';

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
if (empty($_SESSION['form_started_at'])) {
    $_SESSION['form_started_at'] = time();
}

function clean_input(string $value, int $max = 500): string
{
    $value = trim($value);
    $value = preg_replace('/\s+/u', ' ', $value) ?? $value;
    return mb_substr($value, 0, $max, 'UTF-8');
}

function json_response(bool $ok, string $message): void
{
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(['ok' => $ok, 'message' => $message], JSON_UNESCAPED_UNICODE);
    exit;
}

function save_to_database(array $data): void
{
    if (!DB_ENABLED) {
        return;
    }

    $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4';
    $pdo = new PDO($dsn, DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);

    $sql = "CREATE TABLE IF NOT EXISTS quote_requests (
        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        full_name VARCHAR(160) NOT NULL,
        phone VARCHAR(60) NOT NULL,
        email VARCHAR(160) NULL,
        site_name VARCHAR(200) NOT NULL,
        district VARCHAR(120) NULL,
        service_type VARCHAR(160) NOT NULL,
        independent_count VARCHAR(60) NULL,
        message TEXT NULL,
        ip_address VARCHAR(80) NULL,
        user_agent VARCHAR(255) NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";

    $pdo->exec($sql);

    $stmt = $pdo->prepare("INSERT INTO quote_requests
        (full_name, phone, email, site_name, district, service_type, independent_count, message, ip_address, user_agent)
        VALUES
        (:full_name, :phone, :email, :site_name, :district, :service_type, :independent_count, :message, :ip_address, :user_agent)");

    $stmt->execute([
        ':full_name' => $data['full_name'],
        ':phone' => $data['phone'],
        ':email' => $data['email'] ?: null,
        ':site_name' => $data['site_name'],
        ':district' => $data['district'] ?: null,
        ':service_type' => $data['service_type'],
        ':independent_count' => $data['independent_count'] ?: null,
        ':message' => $data['message'] ?: null,
        ':ip_address' => $data['ip_address'],
        ':user_agent' => $data['user_agent'],
    ]);
}

function send_quote_mail(array $data): bool
{
    $subject = 'Yeni Teklif Talebi | ' . $data['site_name'] . ' | ' . $data['service_type'];

    $html = '
    <div style="font-family:Arial,sans-serif;max-width:720px;margin:auto;border:1px solid #e5e7eb;border-radius:16px;overflow:hidden">
        <div style="background:#071a33;color:#fff;padding:22px 26px">
            <h2 style="margin:0;color:#d6b15f">Yeni Teklif Talebi</h2>
            <p style="margin:6px 0 0">Güzey Grup web sitesi üzerinden yeni bir başvuru geldi.</p>
        </div>
        <div style="padding:24px 26px;color:#111827">
            <p><strong>Ad Soyad:</strong> ' . htmlspecialchars($data['full_name'], ENT_QUOTES, 'UTF-8') . '</p>
            <p><strong>Telefon:</strong> ' . htmlspecialchars($data['phone'], ENT_QUOTES, 'UTF-8') . '</p>
            <p><strong>E-posta:</strong> ' . htmlspecialchars($data['email'], ENT_QUOTES, 'UTF-8') . '</p>
            <p><strong>Apartman / Site:</strong> ' . htmlspecialchars($data['site_name'], ENT_QUOTES, 'UTF-8') . '</p>
            <p><strong>İlçe:</strong> ' . htmlspecialchars($data['district'], ENT_QUOTES, 'UTF-8') . '</p>
            <p><strong>Hizmet:</strong> ' . htmlspecialchars($data['service_type'], ENT_QUOTES, 'UTF-8') . '</p>
            <p><strong>Bağımsız Bölüm:</strong> ' . htmlspecialchars($data['independent_count'], ENT_QUOTES, 'UTF-8') . '</p>
            <p><strong>Mesaj:</strong><br>' . nl2br(htmlspecialchars($data['message'], ENT_QUOTES, 'UTF-8')) . '</p>
            <hr>
            <p style="font-size:12px;color:#6b7280">IP: ' . htmlspecialchars($data['ip_address'], ENT_QUOTES, 'UTF-8') . '<br>User Agent: ' . htmlspecialchars($data['user_agent'], ENT_QUOTES, 'UTF-8') . '</p>
        </div>
    </div>';

    $plain = "Yeni Teklif Talebi\n\n"
        . "Ad Soyad: {$data['full_name']}\n"
        . "Telefon: {$data['phone']}\n"
        . "E-posta: {$data['email']}\n"
        . "Apartman/Site: {$data['site_name']}\n"
        . "İlçe: {$data['district']}\n"
        . "Hizmet: {$data['service_type']}\n"
        . "Bağımsız Bölüm: {$data['independent_count']}\n"
        . "Mesaj: {$data['message']}\n";

    $autoload = __DIR__ . '/vendor/autoload.php';

    if (SMTP_ENABLED && file_exists($autoload)) {
        require_once $autoload;

        $mail = new PHPMailer\PHPMailer\PHPMailer(true);
        try {
            $mail->CharSet = 'UTF-8';
            $mail->isSMTP();
            $mail->Host = SMTP_HOST;
            $mail->SMTPAuth = true;
            $mail->Username = SMTP_USER;
            $mail->Password = SMTP_PASS;
            $mail->SMTPSecure = SMTP_SECURE;
            $mail->Port = SMTP_PORT;
            $mail->setFrom(SMTP_USER, COMPANY_NAME);
            $mail->addAddress(ADMIN_EMAIL, COMPANY_NAME);
            if (!empty($data['email']) && filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $mail->addReplyTo($data['email'], $data['full_name']);
            }
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $html;
            $mail->AltBody = $plain;
            return $mail->send();
        } catch (Throwable $e) {
            return false;
        }
    }

    $headers = [
        'MIME-Version: 1.0',
        'Content-Type: text/html; charset=UTF-8',
        'From: ' . COMPANY_NAME . ' <' . ADMIN_EMAIL . '>',
        'Reply-To: ' . (!empty($data['email']) ? $data['email'] : ADMIN_EMAIL),
    ];

    return mail(ADMIN_EMAIL, '=?UTF-8?B?' . base64_encode($subject) . '?=', $html, implode("\r\n", $headers));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['form_type'] ?? '') === 'quote') {
    try {
        $csrf = $_POST['csrf_token'] ?? '';
        if (!hash_equals($_SESSION['csrf_token'], (string)$csrf)) {
            json_response(false, 'Güvenlik doğrulaması başarısız oldu. Lütfen sayfayı yenileyip tekrar deneyin.');
        }

        if (!empty($_POST['website'] ?? '')) {
            json_response(false, 'Form gönderimi engellendi.');
        }

        if ((time() - (int)($_SESSION['form_started_at'] ?? time())) < 3) {
            json_response(false, 'Form çok hızlı gönderildi. Lütfen birkaç saniye sonra tekrar deneyin.');
        }

        $_SESSION['quote_attempts'] = $_SESSION['quote_attempts'] ?? [];
        $_SESSION['quote_attempts'] = array_filter($_SESSION['quote_attempts'], function($t) { return $t > time() - 60; });
        if (count($_SESSION['quote_attempts']) >= 4) {
            json_response(false, 'Kısa süre içinde çok fazla deneme yapıldı. Lütfen biraz sonra tekrar deneyin.');
        }
        $_SESSION['quote_attempts'][] = time();

        $data = [
            'full_name' => clean_input((string)($_POST['full_name'] ?? ''), 160),
            'phone' => clean_input((string)($_POST['phone'] ?? ''), 60),
            'email' => clean_input((string)($_POST['email'] ?? ''), 160),
            'site_name' => clean_input((string)($_POST['site_name'] ?? ''), 200),
            'district' => clean_input((string)($_POST['district'] ?? ''), 120),
            'service_type' => clean_input((string)($_POST['service_type'] ?? ''), 160),
            'independent_count' => clean_input((string)($_POST['independent_count'] ?? ''), 60),
            'message' => clean_input((string)($_POST['message'] ?? ''), 1500),
            'ip_address' => $_SERVER['REMOTE_ADDR'] ?? '',
            'user_agent' => substr($_SERVER['HTTP_USER_AGENT'] ?? '', 0, 255),
        ];

        if ($data['full_name'] === '' || $data['phone'] === '' || $data['site_name'] === '' || $data['service_type'] === '') {
            json_response(false, 'Lütfen zorunlu alanları doldurun.');
        }

        if ($data['email'] !== '' && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            json_response(false, 'Lütfen geçerli bir e-posta adresi yazın.');
        }

        save_to_database($data);
        $mailOk = send_quote_mail($data);

        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        $_SESSION['form_started_at'] = time();

        if (!$mailOk && !DB_ENABLED) {
            json_response(false, 'Talep alınamadı. Lütfen WhatsApp hattından iletişime geçin.');
        }

        json_response(true, 'Talebiniz alındı. En kısa sürede sizinle iletişime geçeceğiz.');
    } catch (Throwable $e) {
        json_response(false, 'Beklenmeyen bir hata oluştu. Lütfen WhatsApp hattından iletişime geçin.');
    }
}

$csrfToken = htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8');
$waText = rawurlencode('Merhaba, apartman/site yönetimi için teklif almak istiyorum.');
$waLink = 'https://wa.me/' . WHATSAPP_NO . '?text=' . $waText;
?><!doctype html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Güzey Grup | İzmir Profesyonel Apartman ve Site Yönetimi</title>
    <meta name="description" content="Güzey Grup; İzmir'de apartman, site ve toplu yaşam alanları için profesyonel yönetim, aidat takibi, hukuki süreç, temizlik, teknik bakım ve şeffaf mali yönetim hizmetleri sunar.">
    <meta name="keywords" content="İzmir apartman yönetimi, İzmir site yönetimi, profesyonel apartman yönetimi, bina yönetimi, aidat takibi, site yönetim firması, Güzey Grup">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="<?= SITE_URL ?>">
    <meta name="theme-color" content="#071a33">

    <meta property="og:title" content="Güzey Grup | Profesyonel Apartman ve Site Yönetimi">
    <meta property="og:description" content="İzmir merkezli profesyonel bina, apartman ve site yönetimi. Şeffaf mali takip, hukuki süreç ve düzenli operasyon.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= SITE_URL ?>">
    <meta property="og:locale" content="tr_TR">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@600;700&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "LocalBusiness",
      "name": "Güzey Grup",
      "url": "https://www.gzygrup.com",
      "email": "info@gzygrup.com",
      "telephone": ["+90 507 472 58 77", "+90 552 662 01 58", "+90 232 484 73 32"],
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "Manas Bulvarı No:39 Folkart Towers B Kule Kat:33 Daire:3306",
        "addressLocality": "Bayraklı",
        "addressRegion": "İzmir",
        "addressCountry": "TR"
      },
      "areaServed": ["İzmir", "Ege Bölgesi"],
      "description": "Profesyonel apartman, site ve bina yönetimi hizmetleri."
    }
    </script>

    <style>
        :root{
            --navy:#071a33;
            --navy-2:#0e2b4f;
            --gold:#c8a45d;
            --gold-2:#e1c681;
            --ink:#172033;
            --muted:#657083;
            --line:#e7ebf1;
            --soft:#f6f8fb;
            --white:#fff;
            --danger:#b42318;
            --success:#087443;
            --shadow:0 24px 70px rgba(7,26,51,.12);
            --radius:26px;
        }
        *{box-sizing:border-box}
        html{scroll-behavior:smooth}
        body{
            margin:0;
            font-family:Inter,system-ui,-apple-system,BlinkMacSystemFont,"Segoe UI",sans-serif;
            color:var(--ink);
            background:var(--white);
            line-height:1.6;
            overflow-x:hidden;
        }
        a{color:inherit;text-decoration:none}
        img{max-width:100%;display:block}
        .container{width:min(1180px,calc(100% - 40px));margin-inline:auto}
        .topbar{
            background:var(--navy);
            color:rgba(255,255,255,.86);
            font-size:13px;
        }
        .topbar-inner{
            display:flex;
            justify-content:space-between;
            align-items:center;
            gap:16px;
            padding:9px 0;
            flex-wrap:wrap;
        }
        .topbar a{color:#fff;font-weight:600}
        .navbar{
            position:sticky;
            top:0;
            z-index:50;
            background:rgba(255,255,255,.92);
            backdrop-filter:blur(16px);
            border-bottom:1px solid rgba(231,235,241,.85);
        }
        .nav-inner{
            display:flex;
            align-items:center;
            justify-content:space-between;
            min-height:78px;
            gap:22px;
        }
        .brand{
            display:flex;
            align-items:center;
            gap:13px;
            min-width:220px;
        }
        .brand-mark{
            width:52px;height:52px;border-radius:18px;
            background:linear-gradient(145deg,var(--navy),var(--navy-2));
            display:grid;place-items:center;
            color:var(--gold-2);
            font-family:"Cormorant Garamond",serif;
            font-weight:700;
            font-size:25px;
            border:1px solid rgba(200,164,93,.45);
            box-shadow:0 12px 30px rgba(7,26,51,.18);
        }
        .brand img{
            width:52px;height:52px;object-fit:contain;border-radius:14px;
        }
        .brand-title{
            display:flex;
            flex-direction:column;
            line-height:1.08;
        }
        .brand-title strong{
            font-family:"Cormorant Garamond",serif;
            font-size:25px;
            letter-spacing:.6px;
            color:var(--navy);
        }
        .brand-title span{
            color:var(--muted);
            font-size:12px;
            font-weight:700;
            letter-spacing:.28px;
            text-transform:uppercase;
        }
        .nav-links{
            display:flex;
            align-items:center;
            gap:25px;
            color:#24324a;
            font-size:14px;
            font-weight:700;
        }
        .nav-links a{position:relative}
        .nav-links a:after{
            content:"";
            position:absolute;left:0;right:0;bottom:-7px;
            height:2px;background:var(--gold);
            transform:scaleX(0);
            transform-origin:left;
            transition:.2s ease;
        }
        .nav-links a:hover:after{transform:scaleX(1)}
        .nav-actions{display:flex;gap:10px;align-items:center}
        .btn{
            display:inline-flex;
            align-items:center;
            justify-content:center;
            gap:9px;
            min-height:46px;
            padding:13px 19px;
            border-radius:999px;
            font-weight:800;
            font-size:14px;
            border:1px solid transparent;
            cursor:pointer;
            transition:.2s ease;
            white-space:nowrap;
        }
        .btn-primary{
            background:linear-gradient(135deg,var(--gold),#b98f3c);
            color:#fff;
            box-shadow:0 16px 36px rgba(200,164,93,.28);
        }
        .btn-primary:hover{transform:translateY(-2px);box-shadow:0 20px 44px rgba(200,164,93,.35)}
        .btn-dark{
            background:var(--navy);
            color:#fff;
            box-shadow:0 18px 44px rgba(7,26,51,.22);
        }
        .btn-dark:hover{transform:translateY(-2px)}
        .btn-ghost{
            background:#fff;
            color:var(--navy);
            border-color:var(--line);
        }
        .btn-ghost:hover{border-color:var(--gold);transform:translateY(-2px)}
        .mobile-toggle{
            display:none;
            border:0;background:var(--navy);color:#fff;
            width:44px;height:44px;border-radius:14px;
            font-size:23px;cursor:pointer;
        }
        .hero{
            position:relative;
            background:
                radial-gradient(circle at 85% 10%, rgba(200,164,93,.18), transparent 32%),
                linear-gradient(180deg,#fbfcfe 0%,#fff 62%,#f6f8fb 100%);
            padding:86px 0 46px;
            overflow:hidden;
        }
        .hero:before{
            content:"";
            position:absolute;
            inset:0;
            background-image:
                linear-gradient(rgba(7,26,51,.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(7,26,51,.04) 1px, transparent 1px);
            background-size:42px 42px;
            mask-image:linear-gradient(to bottom, rgba(0,0,0,.9), transparent 82%);
            pointer-events:none;
        }
        .hero-grid{
            position:relative;
            display:grid;
            grid-template-columns:1.05fr .95fr;
            gap:50px;
            align-items:center;
        }
        .eyebrow{
            display:inline-flex;
            align-items:center;
            gap:9px;
            padding:8px 12px;
            border-radius:999px;
            background:rgba(200,164,93,.13);
            color:#8b6824;
            font-size:13px;
            font-weight:800;
            border:1px solid rgba(200,164,93,.28);
            margin-bottom:18px;
        }
        .eyebrow:before{
            content:"";
            width:8px;height:8px;border-radius:999px;background:var(--gold);
            box-shadow:0 0 0 5px rgba(200,164,93,.18);
        }
        h1,h2,h3{margin:0;color:var(--navy);line-height:1.08}
        h1{
            font-family:"Cormorant Garamond",serif;
            font-size:clamp(46px,6vw,78px);
            letter-spacing:-1.3px;
        }
        .hero p.lead{
            margin:22px 0 0;
            max-width:670px;
            color:#445168;
            font-size:18px;
            line-height:1.75;
        }
        .hero-actions{
            display:flex;
            gap:14px;
            flex-wrap:wrap;
            margin-top:30px;
        }
        .hero-bullets{
            display:flex;
            gap:12px;
            flex-wrap:wrap;
            margin-top:28px;
        }
        .pill{
            display:inline-flex;
            align-items:center;
            gap:8px;
            padding:10px 13px;
            background:#fff;
            border:1px solid var(--line);
            border-radius:999px;
            font-weight:800;
            font-size:13px;
            color:#26344d;
            box-shadow:0 8px 22px rgba(7,26,51,.06);
        }
        .pill svg{color:var(--gold)}
        .hero-card{
            position:relative;
            background:linear-gradient(160deg,var(--navy),#0c315f 70%,#123b6c);
            border-radius:34px;
            padding:28px;
            color:#fff;
            min-height:560px;
            box-shadow:var(--shadow);
            overflow:hidden;
        }
        .hero-card:before{
            content:"";
            position:absolute;right:-80px;top:-80px;
            width:260px;height:260px;border-radius:999px;
            background:rgba(200,164,93,.24);
            filter:blur(2px);
        }
        .hero-card:after{
            content:"";
            position:absolute;left:-90px;bottom:-90px;
            width:230px;height:230px;border-radius:999px;
            background:rgba(255,255,255,.08);
        }
        .card-content{position:relative;z-index:2}
        .mini-label{
            display:inline-flex;gap:8px;align-items:center;
            padding:8px 12px;border-radius:999px;
            background:rgba(255,255,255,.11);
            border:1px solid rgba(255,255,255,.16);
            color:rgba(255,255,255,.86);
            font-weight:800;font-size:13px;
            margin-bottom:26px;
        }
        .hero-card h2{
            color:#fff;
            font-family:"Cormorant Garamond",serif;
            font-size:39px;
            max-width:440px;
            margin-bottom:16px;
        }
        .hero-card p{color:rgba(255,255,255,.78);font-size:15px;margin:0}
        .dashboard{
            margin-top:30px;
            display:grid;
            gap:14px;
        }
        .dash-row{
            display:flex;
            justify-content:space-between;
            gap:18px;
            align-items:center;
            padding:17px 18px;
            border-radius:20px;
            background:rgba(255,255,255,.09);
            border:1px solid rgba(255,255,255,.14);
        }
        .dash-row strong{display:block;color:#fff;font-size:15px}
        .dash-row span{display:block;color:rgba(255,255,255,.68);font-size:12px;margin-top:3px}
        .dash-badge{
            width:42px;height:42px;border-radius:16px;
            display:grid;place-items:center;
            background:rgba(200,164,93,.18);
            color:var(--gold-2);
            flex:0 0 auto;
        }
        .floating-note{
            position:absolute;
            right:24px;
            bottom:24px;
            left:24px;
            z-index:3;
            background:rgba(255,255,255,.96);
            border-radius:22px;
            color:var(--ink);
            padding:18px;
            display:flex;
            gap:14px;
            align-items:flex-start;
            box-shadow:0 18px 44px rgba(0,0,0,.18);
        }
        .floating-note b{display:block;color:var(--navy)}
        .floating-note span{display:block;color:var(--muted);font-size:13px;margin-top:2px}
        .icon-box{
            width:44px;height:44px;border-radius:15px;
            display:grid;place-items:center;
            background:linear-gradient(145deg,rgba(200,164,93,.2),rgba(200,164,93,.08));
            color:#9a7226;
            flex:0 0 auto;
        }
        .stats{
            transform:translateY(36px);
            position:relative;
            z-index:4;
        }
        .stats-grid{
            background:#fff;
            border:1px solid var(--line);
            border-radius:28px;
            padding:19px;
            display:grid;
            grid-template-columns:repeat(4,1fr);
            gap:14px;
            box-shadow:0 20px 60px rgba(7,26,51,.08);
        }
        .stat{
            padding:20px;
            border-radius:21px;
            background:linear-gradient(180deg,#fff,#f8fafc);
            border:1px solid #edf0f5;
        }
        .stat strong{display:block;color:var(--navy);font-size:29px;letter-spacing:-.5px}
        .stat span{display:block;color:var(--muted);font-weight:700;font-size:13px;margin-top:4px}
        section{padding:96px 0}
        .section-head{
            max-width:760px;
            margin:0 auto 42px;
            text-align:center;
        }
        .section-head .eyebrow{margin-bottom:14px}
        .section-head h2{
            font-family:"Cormorant Garamond",serif;
            font-size:clamp(36px,4.2vw,56px);
            letter-spacing:-.6px;
        }
        .section-head p{
            color:var(--muted);
            margin:16px auto 0;
            font-size:17px;
            max-width:680px;
        }
        .about-grid{
            display:grid;
            grid-template-columns:.9fr 1.1fr;
            gap:36px;
            align-items:stretch;
        }
        .about-panel{
            background:var(--navy);
            color:#fff;
            border-radius:var(--radius);
            padding:32px;
            position:relative;
            overflow:hidden;
        }
        .about-panel:after{
            content:"";
            position:absolute;right:-80px;bottom:-80px;
            width:240px;height:240px;border-radius:999px;
            background:rgba(200,164,93,.15);
        }
        .about-panel h3{
            position:relative;
            color:#fff;
            font-family:"Cormorant Garamond",serif;
            font-size:38px;
            margin-bottom:12px;
            z-index:1;
        }
        .about-panel p{position:relative;color:rgba(255,255,255,.77);z-index:1}
        .about-list{
            position:relative;
            z-index:1;
            margin-top:24px;
            display:grid;
            gap:13px;
        }
        .about-list div{
            display:flex;gap:12px;align-items:flex-start;
            padding:14px;
            border-radius:18px;
            background:rgba(255,255,255,.08);
            border:1px solid rgba(255,255,255,.12);
        }
        .about-list b{display:block;color:#fff}
        .about-list span{display:block;color:rgba(255,255,255,.68);font-size:13px}
        .cards-grid{
            display:grid;
            grid-template-columns:repeat(2,1fr);
            gap:18px;
        }
        .info-card,.service-card,.process-card,.faq-item{
            background:#fff;
            border:1px solid var(--line);
            border-radius:var(--radius);
            padding:26px;
            box-shadow:0 14px 36px rgba(7,26,51,.05);
            transition:.22s ease;
        }
        .info-card:hover,.service-card:hover,.process-card:hover{
            transform:translateY(-4px);
            box-shadow:0 24px 55px rgba(7,26,51,.1);
            border-color:rgba(200,164,93,.38);
        }
        .info-card h3,.service-card h3,.process-card h3{
            font-size:20px;
            margin-top:16px;
            margin-bottom:8px;
        }
        .info-card p,.service-card p,.process-card p,.faq-item p{
            margin:0;
            color:var(--muted);
        }
        .services{background:var(--soft)}
        .services-grid{
            display:grid;
            grid-template-columns:repeat(4,1fr);
            gap:18px;
        }
        .service-card{
            min-height:255px;
            display:flex;
            flex-direction:column;
            justify-content:flex-start;
        }
        .service-card .icon-box{background:#f8f3e7}
        .service-card ul{
            margin:16px 0 0;
            padding:0;
            list-style:none;
            display:grid;
            gap:8px;
            color:#536174;
            font-size:13px;
            font-weight:600;
        }
        .service-card li{
            display:flex;gap:7px;align-items:flex-start;
        }
        .service-card li:before{
            content:"";
            width:6px;height:6px;border-radius:999px;
            background:var(--gold);
            flex:0 0 auto;
            margin-top:8px;
        }
        .process-grid{
            display:grid;
            grid-template-columns:repeat(5,1fr);
            gap:16px;
            counter-reset:step;
        }
        .process-card{
            position:relative;
            padding-top:32px;
        }
        .process-card:before{
            counter-increment:step;
            content:"0" counter(step);
            position:absolute;
            top:14px;right:18px;
            font-size:38px;
            line-height:1;
            font-weight:900;
            color:rgba(200,164,93,.19);
        }
        .split{
            display:grid;
            grid-template-columns:1fr 1fr;
            gap:28px;
            align-items:center;
        }
        .dark-section{
            background:linear-gradient(135deg,var(--navy),#0d315f);
            color:#fff;
            position:relative;
            overflow:hidden;
        }
        .dark-section:before{
            content:"";
            position:absolute;inset:0;
            background:radial-gradient(circle at 80% 20%,rgba(200,164,93,.22),transparent 32%);
        }
        .dark-section .container{position:relative;z-index:1}
        .dark-section h2,.dark-section h3{color:#fff}
        .dark-section p{color:rgba(255,255,255,.75)}
        .check-grid{
            display:grid;
            gap:13px;
            margin-top:22px;
        }
        .check-item{
            display:flex;
            gap:12px;
            align-items:flex-start;
            padding:15px;
            border-radius:18px;
            background:rgba(255,255,255,.09);
            border:1px solid rgba(255,255,255,.13);
        }
        .check-item b{color:#fff}
        .check-item span{display:block;color:rgba(255,255,255,.68);font-size:13px}
        .quote-card{
            background:#fff;
            color:var(--ink);
            border-radius:32px;
            padding:30px;
            box-shadow:0 28px 80px rgba(0,0,0,.18);
        }
        .quote-card h3{
            font-family:"Cormorant Garamond",serif;
            font-size:34px;
            margin-bottom:8px;
        }
        .form-grid{
            display:grid;
            grid-template-columns:1fr 1fr;
            gap:14px;
            margin-top:20px;
        }
        .field{display:flex;flex-direction:column;gap:7px}
        .field.full{grid-column:1/-1}
        label{
            font-size:12px;
            font-weight:900;
            letter-spacing:.25px;
            color:#36435a;
            text-transform:uppercase;
        }
        input,select,textarea{
            width:100%;
            border:1px solid #dde3ec;
            border-radius:16px;
            padding:14px 14px;
            font:inherit;
            color:var(--ink);
            outline:none;
            background:#fff;
            transition:.18s ease;
        }
        textarea{min-height:110px;resize:vertical}
        input:focus,select:focus,textarea:focus{
            border-color:var(--gold);
            box-shadow:0 0 0 4px rgba(200,164,93,.14);
        }
        .hidden-field{display:none!important}
        .form-result{
            display:none;
            margin-top:14px;
            padding:13px 14px;
            border-radius:16px;
            font-weight:800;
            font-size:14px;
        }
        .form-result.success{display:block;background:#ecfdf3;color:var(--success);border:1px solid #b8f1d0}
        .form-result.error{display:block;background:#fff1f0;color:var(--danger);border:1px solid #ffd1cc}
        .faq-grid{
            display:grid;
            grid-template-columns:1fr 1fr;
            gap:17px;
        }
        .faq-item h3{
            font-size:18px;
            margin-bottom:8px;
        }
        .contact{
            background:#fff;
        }
        .contact-grid{
            display:grid;
            grid-template-columns:.95fr 1.05fr;
            gap:24px;
            align-items:stretch;
        }
        .contact-card{
            border-radius:30px;
            padding:30px;
            border:1px solid var(--line);
            background:linear-gradient(180deg,#fff,#f8fafc);
            box-shadow:0 18px 48px rgba(7,26,51,.06);
        }
        .contact-card h2{
            font-family:"Cormorant Garamond",serif;
            font-size:42px;
            margin-bottom:13px;
        }
        .contact-list{
            display:grid;
            gap:13px;
            margin-top:25px;
        }
        .contact-row{
            display:flex;
            gap:13px;
            align-items:flex-start;
            padding:15px;
            border-radius:18px;
            background:#fff;
            border:1px solid var(--line);
        }
        .contact-row b{display:block;color:var(--navy)}
        .contact-row span,.contact-row a{display:block;color:var(--muted);font-size:14px}
        .map-box{
            min-height:420px;
            border-radius:30px;
            overflow:hidden;
            border:1px solid var(--line);
            background:
              linear-gradient(rgba(7,26,51,.2),rgba(7,26,51,.2)),
              url('https://images.unsplash.com/photo-1559030623-0226b1241edd?q=80&w=1600&auto=format&fit=crop') center/cover;
            position:relative;
            box-shadow:0 18px 48px rgba(7,26,51,.09);
        }
        .map-overlay{
            position:absolute;
            left:24px;right:24px;bottom:24px;
            background:rgba(255,255,255,.94);
            border-radius:22px;
            padding:19px;
            box-shadow:0 18px 44px rgba(0,0,0,.14);
        }
        .map-overlay b{color:var(--navy)}
        .footer{
            background:var(--navy);
            color:rgba(255,255,255,.72);
            padding:38px 0;
        }
        .footer-inner{
            display:flex;
            justify-content:space-between;
            align-items:center;
            gap:20px;
            flex-wrap:wrap;
        }
        .footer strong{color:#fff}
        .footer a{color:#fff;font-weight:800}
        .whatsapp-float{
            position:fixed;
            right:20px;
            bottom:20px;
            z-index:60;
            background:#25d366;
            color:#fff;
            width:60px;
            height:60px;
            border-radius:22px;
            display:grid;
            place-items:center;
            box-shadow:0 18px 44px rgba(37,211,102,.38);
            transition:.2s ease;
        }
        .whatsapp-float:hover{transform:translateY(-3px) scale(1.03)}
        .mobile-cta{
            display:none;
            position:fixed;
            left:12px;
            right:12px;
            bottom:12px;
            z-index:65;
            gap:10px;
            background:rgba(255,255,255,.95);
            border:1px solid var(--line);
            border-radius:22px;
            padding:9px;
            box-shadow:0 16px 50px rgba(7,26,51,.18);
            backdrop-filter:blur(12px);
        }
        .mobile-cta .btn{flex:1;min-height:44px;padding:10px;font-size:13px}
        svg{width:21px;height:21px}
        @media (max-width:1020px){
            .nav-links,.nav-actions{display:none}
            .mobile-toggle{display:grid;place-items:center}
            .nav-links.open{
                display:flex;
                position:absolute;
                top:78px;
                left:20px;
                right:20px;
                flex-direction:column;
                align-items:flex-start;
                background:#fff;
                border:1px solid var(--line);
                border-radius:24px;
                padding:22px;
                box-shadow:0 22px 55px rgba(7,26,51,.15);
            }
            .hero-grid,.about-grid,.split,.contact-grid{grid-template-columns:1fr}
            .hero{padding-top:60px}
            .hero-card{min-height:500px}
            .stats-grid{grid-template-columns:repeat(2,1fr)}
            .services-grid{grid-template-columns:repeat(2,1fr)}
            .process-grid{grid-template-columns:repeat(2,1fr)}
        }
        @media (max-width:680px){
            .container{width:min(100% - 24px,1180px)}
            .topbar-inner{justify-content:center;text-align:center}
            .brand-title strong{font-size:21px}
            .brand-title span{font-size:10px}
            .brand-mark{width:47px;height:47px}
            .hero{padding:42px 0 30px}
            h1{font-size:43px}
            .hero p.lead{font-size:16px}
            .hero-actions .btn{width:100%}
            .hero-card{min-height:auto;padding:22px 22px 130px}
            .floating-note{left:16px;right:16px;bottom:16px}
            .stats{transform:none;margin-top:18px}
            .stats-grid,.cards-grid,.services-grid,.process-grid,.faq-grid,.form-grid{grid-template-columns:1fr}
            .field.full{grid-column:auto}
            section{padding:68px 0}
            .section-head{text-align:left}
            .section-head h2{font-size:38px}
            .quote-card{padding:22px;border-radius:24px}
            .map-box{min-height:360px}
            .whatsapp-float{display:none}
            .mobile-cta{display:flex}
            body{padding-bottom:78px}
        }
    </style>
</head>
<body>
    <div class="topbar">
        <div class="container topbar-inner">
            <span>İzmir merkezli profesyonel apartman, site ve bina yönetimi</span>
            <span>
                <a href="tel:+905074725877">0507 472 58 77</a> ·
                <a href="mailto:info@gzygrup.com">info@gzygrup.com</a>
            </span>
        </div>
    </div>

    <header class="navbar">
        <div class="container nav-inner">
            <a class="brand" href="#anasayfa" aria-label="Güzey Grup Ana Sayfa">
                <div class="brand-mark">GG</div>
                <div class="brand-title">
                    <strong>Güzey Grup</strong>
                    <span>Profesyonel Yönetim</span>
                </div>
            </a>

            <nav class="nav-links" id="navLinks" aria-label="Ana Menü">
                <a href="#hakkimizda">Hakkımızda</a>
                <a href="#hizmetler">Hizmetler</a>
                <a href="#surec">Süreç</a>
                <a href="#teklif">Teklif Al</a>
                <a href="#iletisim">İletişim</a>
            </nav>

            <div class="nav-actions">
                <a class="btn btn-ghost" href="mailto:info@gzygrup.com">E-Posta</a>
                <a class="btn btn-primary" href="#teklif">Teklif İste</a>
            </div>

            <button class="mobile-toggle" id="mobileToggle" aria-label="Menüyü Aç">☰</button>
        </div>
    </header>

    <main id="anasayfa">
        <section class="hero">
            <div class="container hero-grid">
                <div>
                    <span class="eyebrow">Kurumsal Yönetimde Güven, Şeffaflık ve Düzen</span>
                    <h1>İzmir’de profesyonel apartman ve site yönetimi.</h1>
                    <p class="lead">
                        Aidat takibi, hukuki süreç, temizlik, teknik bakım, ortak alan kontrolü ve mali raporlama süreçlerini tek merkezden, düzenli ve şeffaf şekilde yürütüyoruz.
                    </p>

                    <div class="hero-actions">
                        <a class="btn btn-primary" href="#teklif">Yönetim Teklifi Al</a>
                        <a class="btn btn-dark" href="<?= $waLink ?>" target="_blank" rel="noopener">WhatsApp’tan Yaz</a>
                    </div>

                    <div class="hero-bullets">
                        <span class="pill"><?= icon('check') ?> 2005’ten gelen tecrübe</span>
                        <span class="pill"><?= icon('check') ?> Şeffaf mali takip</span>
                        <span class="pill"><?= icon('check') ?> Mevzuata uygun süreç</span>
                    </div>
                </div>

                <div class="hero-card">
                    <div class="card-content">
                        <span class="mini-label"><?= icon('shield') ?> Yönetimi devralır, düzeni kurarız</span>
                        <h2>Yaşam alanlarına değer katan kontrollü yönetim sistemi.</h2>
                        <p>
                            Apartman ve site yönetiminde yalnızca günlük işleri değil; karar, kayıt, takip, tahsilat ve iletişim süreçlerini de profesyonel bir sisteme bağlıyoruz.
                        </p>

                        <div class="dashboard">
                            <div class="dash-row">
                                <div>
                                    <strong>Aidat ve tahsilat takibi</strong>
                                    <span>Düzenli ödeme kontrolü ve raporlama</span>
                                </div>
                                <div class="dash-badge"><?= icon('wallet') ?></div>
                            </div>
                            <div class="dash-row">
                                <div>
                                    <strong>Hukuki ve idari süreç</strong>
                                    <span>Toplantı, karar, defter ve icra takibi</span>
                                </div>
                                <div class="dash-badge"><?= icon('scale') ?></div>
                            </div>
                            <div class="dash-row">
                                <div>
                                    <strong>Ortak alan operasyonu</strong>
                                    <span>Temizlik, bakım, peyzaj ve teknik kontrol</span>
                                </div>
                                <div class="dash-badge"><?= icon('building') ?></div>
                            </div>
                        </div>
                    </div>

                    <div class="floating-note">
                        <div class="icon-box"><?= icon('spark') ?></div>
                        <div>
                            <b>Şeffaf ve raporlanabilir yönetim</b>
                            <span>Gelir-gider, karar, bakım ve hizmet süreçlerinde düzenli bilgilendirme.</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container stats">
                <div class="stats-grid">
                    <div class="stat"><strong>2005</strong><span>İzmir’de başlayan tecrübe</span></div>
                    <div class="stat"><strong>360°</strong><span>Yönetim, bakım ve takip</span></div>
                    <div class="stat"><strong>Ege</strong><span>Bölgesel hizmet yaklaşımı</span></div>
                    <div class="stat"><strong>7/24</strong><span>Hızlı iletişim disiplini</span></div>
                </div>
            </div>
        </section>

        <section id="hakkimizda">
            <div class="container">
                <div class="section-head">
                    <span class="eyebrow">Hakkımızda</span>
                    <h2>Kurumsal yaklaşım, sürdürülebilir yönetim.</h2>
                    <p>Yönetim süreçlerini yalnızca takip etmiyor; kayıt altına alıyor, düzenli hale getiriyor ve kat maliklerinin güven duyacağı profesyonel bir yapıya dönüştürüyoruz.</p>
                </div>

                <div class="about-grid">
                    <div class="about-panel">
                        <h3>Güzey Grup</h3>
                        <p>
                            2005 yılında İzmir’de başlayan yönetim tecrübemiz, Güzey Grup kimliğiyle apartman, site ve toplu yaşam alanlarında entegre hizmet yapısına dönüşmüştür.
                        </p>

                        <div class="about-list">
                            <div>
                                <div class="icon-box"><?= icon('check') ?></div>
                                <p><b>Şeffaf yönetim</b><span>Gelir-gider, karar ve operasyon süreçlerinde düzenli bilgi akışı.</span></p>
                            </div>
                            <div>
                                <div class="icon-box"><?= icon('check') ?></div>
                                <p><b>Mevzuata uygun süreçler</b><span>Kat Mülkiyeti Kanunu çerçevesinde idari ve mali takip disiplini.</span></p>
                            </div>
                            <div>
                                <div class="icon-box"><?= icon('check') ?></div>
                                <p><b>Tek noktadan çözüm</b><span>Yönetim, hukuk, mali takip, temizlik, güvenlik, peyzaj ve teknik destek.</span></p>
                            </div>
                        </div>
                    </div>

                    <div class="cards-grid">
                        <article class="info-card">
                            <div class="icon-box"><?= icon('shield') ?></div>
                            <h3>Güven veren sistem</h3>
                            <p>Belge, kayıt, karar ve mali hareketlerin düzenli takip edildiği, hesap verilebilir bir yönetim modeli oluştururuz.</p>
                        </article>
                        <article class="info-card">
                            <div class="icon-box"><?= icon('scale') ?></div>
                            <h3>Hukuki zemin</h3>
                            <p>Karar defteri, genel kurul, işletme projesi, aidat tahsilatı ve icra süreçlerinde kontrollü ilerleriz.</p>
                        </article>
                        <article class="info-card">
                            <div class="icon-box"><?= icon('clipboard') ?></div>
                            <h3>Düzenli denetim</h3>
                            <p>Ortak alan, asansör, aydınlatma, temizlik ve teknik bakım konularında periyodik kontrol disiplini kurarız.</p>
                        </article>
                        <article class="info-card">
                            <div class="icon-box"><?= icon('wallet') ?></div>
                            <h3>Mali şeffaflık</h3>
                            <p>Gelir-gider, tahsilat, ödeme ve hizmet alımlarında düzenli, izlenebilir ve raporlanabilir yapı sunarız.</p>
                        </article>
                    </div>
                </div>
            </div>
        </section>

        <section class="services" id="hizmetler">
            <div class="container">
                <div class="section-head">
                    <span class="eyebrow">Hizmetlerimiz</span>
                    <h2>Yaşam alanları için uçtan uca hizmet yapısı.</h2>
                    <p>Apartman, site ve toplu yapıların idari, mali, hukuki ve operasyonel ihtiyaçlarını tek çatı altında topluyoruz.</p>
                </div>

                <div class="services-grid">
                    <article class="service-card">
                        <div class="icon-box"><?= icon('building') ?></div>
                        <h3>Bina ve Site Yönetimi</h3>
                        <p>Apartman ve sitelerin mevzuata uygun profesyonel yönetimi.</p>
                        <ul><li>Genel kurul takibi</li><li>İşletme projesi</li><li>Karar ve defter düzeni</li></ul>
                    </article>
                    <article class="service-card">
                        <div class="icon-box"><?= icon('wallet') ?></div>
                        <h3>Muhasebe ve Aidat Takibi</h3>
                        <p>Gelir-gider ve tahsilat süreçlerinde şeffaf takip.</p>
                        <ul><li>Aidat tahakkuku</li><li>Gider kontrolü</li><li>Raporlama</li></ul>
                    </article>
                    <article class="service-card">
                        <div class="icon-box"><?= icon('scale') ?></div>
                        <h3>Hukuki Süreç Takibi</h3>
                        <p>Yönetime ilişkin hukuki ve idari süreçlerde destek.</p>
                        <ul><li>Aidat icra süreçleri</li><li>Toplantı kararları</li><li>Uyuşmazlık takibi</li></ul>
                    </article>
                    <article class="service-card">
                        <div class="icon-box"><?= icon('spark') ?></div>
                        <h3>Profesyonel Temizlik</h3>
                        <p>Ortak alanlarda düzenli ve planlı temizlik organizasyonu.</p>
                        <ul><li>Merdiven ve giriş</li><li>Asansör ve koridor</li><li>Periyodik kontrol</li></ul>
                    </article>
                    <article class="service-card">
                        <div class="icon-box"><?= icon('tool') ?></div>
                        <h3>Teknik Bakım Takibi</h3>
                        <p>Arıza, bakım ve yenileme süreçlerinin planlı yürütülmesi.</p>
                        <ul><li>Aydınlatma</li><li>Kapı ve hidrofor</li><li>Asansör takibi</li></ul>
                    </article>
                    <article class="service-card">
                        <div class="icon-box"><?= icon('leaf') ?></div>
                        <h3>Peyzaj ve Çevre</h3>
                        <p>Bahçe, peyzaj ve çevre düzeninin korunması.</p>
                        <ul><li>Budama</li><li>Sulama takibi</li><li>Çevre düzeni</li></ul>
                    </article>
                    <article class="service-card">
                        <div class="icon-box"><?= icon('shield') ?></div>
                        <h3>Güvenlik Hizmetleri</h3>
                        <p>Giriş-çıkış ve güvenlik organizasyonunun takibi.</p>
                        <ul><li>Personel temini</li><li>Devriye planı</li><li>Kontrol disiplini</li></ul>
                    </article>
                    <article class="service-card">
                        <div class="icon-box"><?= icon('home') ?></div>
                        <h3>Emlak Danışmanlığı</h3>
                        <p>Kiralama ve satış süreçlerinde profesyonel destek.</p>
                        <ul><li>Kiracı takibi</li><li>Pazarlama</li><li>Değerleme yaklaşımı</li></ul>
                    </article>
                </div>
            </div>
        </section>

        <section id="surec">
            <div class="container">
                <div class="section-head">
                    <span class="eyebrow">Yönetim Sürecimiz</span>
                    <h2>Devirden raporlamaya kadar kontrollü akış.</h2>
                    <p>Yeni bir apartman veya sitede ilk hedefimiz, mevcut dağınıklığı tespit edip kısa sürede ölçülebilir bir düzen kurmaktır.</p>
                </div>

                <div class="process-grid">
                    <article class="process-card">
                        <div class="icon-box"><?= icon('clipboard') ?></div>
                        <h3>Ön analiz</h3>
                        <p>Mevcut karar, borç, bakım ve ortak alan durumunu inceleriz.</p>
                    </article>
                    <article class="process-card">
                        <div class="icon-box"><?= icon('scale') ?></div>
                        <h3>Yasal düzen</h3>
                        <p>Defter, karar, toplantı ve işletme projesi sürecini kontrol ederiz.</p>
                    </article>
                    <article class="process-card">
                        <div class="icon-box"><?= icon('wallet') ?></div>
                        <h3>Mali sistem</h3>
                        <p>Aidat, tahsilat, ödeme ve raporlama sistemini kurarız.</p>
                    </article>
                    <article class="process-card">
                        <div class="icon-box"><?= icon('tool') ?></div>
                        <h3>Operasyon</h3>
                        <p>Temizlik, teknik bakım, peyzaj ve tedarik süreçlerini yönetiriz.</p>
                    </article>
                    <article class="process-card">
                        <div class="icon-box"><?= icon('message') ?></div>
                        <h3>Bilgilendirme</h3>
                        <p>Kat maliklerine düzenli, sade ve kayıtlı bilgilendirme yaparız.</p>
                    </article>
                </div>
            </div>
        </section>

        <section class="dark-section" id="teklif">
            <div class="container split">
                <div>
                    <span class="eyebrow">Teklif Talebi</span>
                    <h2 style="font-family:'Cormorant Garamond',serif;font-size:clamp(38px,4.5vw,58px);letter-spacing:-.5px">
                        Apartmanınız veya siteniz için profesyonel yönetim teklifi alın.
                    </h2>
                    <p style="font-size:17px;margin-top:17px">
                        Formu doldurun; apartman/site yapısı, bağımsız bölüm sayısı ve ihtiyaçlarınıza göre size en uygun yönetim modelini değerlendirelim.
                    </p>

                    <div class="check-grid">
                        <div class="check-item">
                            <div class="icon-box"><?= icon('check') ?></div>
                            <p><b>Hızlı ön değerlendirme</b><span>Mevcut ihtiyaç, bağımsız bölüm sayısı ve hizmet kapsamına göre değerlendirme.</span></p>
                        </div>
                        <div class="check-item">
                            <div class="icon-box"><?= icon('check') ?></div>
                            <p><b>Şeffaf hizmet kapsamı</b><span>Yönetim, mali takip, temizlik, bakım ve hukuki süreçler netleştirilir.</span></p>
                        </div>
                        <div class="check-item">
                            <div class="icon-box"><?= icon('check') ?></div>
                            <p><b>WhatsApp ile hızlı dönüş</b><span>Talebiniz sonrası doğrudan iletişim kurulabilir.</span></p>
                        </div>
                    </div>
                </div>

                <div class="quote-card">
                    <h3>Yönetim Teklifi İste</h3>
                    <p>Zorunlu alanları doldurun. Talebiniz Güzey Grup’a iletilecektir.</p>

                    <form id="quoteForm" method="post" autocomplete="on">
                        <input type="hidden" name="form_type" value="quote">
                        <input type="hidden" name="csrf_token" value="<?= $csrfToken ?>">
                        <input class="hidden-field" type="text" name="website" tabindex="-1" autocomplete="off">

                        <div class="form-grid">
                            <div class="field">
                                <label for="full_name">Ad Soyad *</label>
                                <input id="full_name" name="full_name" type="text" required placeholder="Adınız Soyadınız">
                            </div>
                            <div class="field">
                                <label for="phone">Telefon *</label>
                                <input id="phone" name="phone" type="tel" required placeholder="05xx xxx xx xx">
                            </div>
                            <div class="field">
                                <label for="email">E-posta</label>
                                <input id="email" name="email" type="email" placeholder="ornek@mail.com">
                            </div>
                            <div class="field">
                                <label for="district">İlçe</label>
                                <input id="district" name="district" type="text" placeholder="Bayraklı, Bornova...">
                            </div>
                            <div class="field">
                                <label for="site_name">Apartman / Site Adı *</label>
                                <input id="site_name" name="site_name" type="text" required placeholder="Örn. Papatya Apartmanı">
                            </div>
                            <div class="field">
                                <label for="independent_count">Bağımsız Bölüm</label>
                                <input id="independent_count" name="independent_count" type="text" placeholder="Örn. 24 daire">
                            </div>
                            <div class="field full">
                                <label for="service_type">Talep Edilen Hizmet *</label>
                                <select id="service_type" name="service_type" required>
                                    <option value="">Seçiniz</option>
                                    <option>Profesyonel Apartman Yönetimi</option>
                                    <option>Profesyonel Site Yönetimi</option>
                                    <option>Aidat ve Mali Takip</option>
                                    <option>Temizlik ve Ortak Alan Hizmeti</option>
                                    <option>Teknik Bakım Takibi</option>
                                    <option>Hukuki Süreç ve İcra Takibi</option>
                                    <option>Diğer</option>
                                </select>
                            </div>
                            <div class="field full">
                                <label for="message">Mesajınız</label>
                                <textarea id="message" name="message" placeholder="Mevcut durum, ihtiyaçlar veya özel notlar..."></textarea>
                            </div>
                        </div>

                        <button class="btn btn-primary" type="submit" style="width:100%;margin-top:16px">Talebi Gönder</button>
                        <div id="formResult" class="form-result"></div>
                    </form>
                </div>
            </div>
        </section>

        <section>
            <div class="container">
                <div class="section-head">
                    <span class="eyebrow">Sıkça Sorulan Sorular</span>
                    <h2>Karar vermeden önce bilinmesi gerekenler.</h2>
                </div>

                <div class="faq-grid">
                    <article class="faq-item">
                        <h3>Profesyonel yönetim devri nasıl yapılır?</h3>
                        <p>Mevcut yönetim kayıtları, karar defteri, borç-alacak durumu ve ortak alan ihtiyaçları incelenerek kontrollü bir geçiş planı oluşturulur.</p>
                    </article>
                    <article class="faq-item">
                        <h3>Aidat takibi nasıl yürütülür?</h3>
                        <p>Tahakkuk, ödeme, gecikme ve borç listeleri düzenli takip edilir; gerekli durumlarda hukuki süreç planlı şekilde başlatılır.</p>
                    </article>
                    <article class="faq-item">
                        <h3>Temizlik ve teknik işler ayrıca takip edilir mi?</h3>
                        <p>Evet. Ortak alan temizliği, aydınlatma, asansör, kapı, hidrofor, peyzaj ve diğer teknik konular periyodik olarak kontrol edilir.</p>
                    </article>
                    <article class="faq-item">
                        <h3>Kat maliklerine bilgilendirme yapılır mı?</h3>
                        <p>Gelir-gider, karar, bakım, teklif ve ödeme süreçleri hakkında kat maliklerine açık ve anlaşılır bilgilendirme yapılır.</p>
                    </article>
                </div>
            </div>
        </section>

        <section class="contact" id="iletisim">
            <div class="container contact-grid">
                <div class="contact-card">
                    <span class="eyebrow">İletişim</span>
                    <h2>Bizimle iletişime geçin.</h2>
                    <p>Apartman, site veya toplu yaşam alanınız için profesyonel yönetim hizmeti almak üzere bize ulaşabilirsiniz.</p>

                    <div class="contact-list">
                        <div class="contact-row">
                            <div class="icon-box"><?= icon('phone') ?></div>
                            <div>
                                <b>Telefon</b>
                                <a href="tel:+905074725877">0507 472 58 77</a>
                                <a href="tel:+905526620158">0552 662 01 58</a>
                                <a href="tel:+902324847332">0232 484 73 32</a>
                            </div>
                        </div>
                        <div class="contact-row">
                            <div class="icon-box"><?= icon('mail') ?></div>
                            <div>
                                <b>E-posta</b>
                                <a href="mailto:info@gzygrup.com">info@gzygrup.com</a>
                            </div>
                        </div>
                        <div class="contact-row">
                            <div class="icon-box"><?= icon('pin') ?></div>
                            <div>
                                <b>Adres</b>
                                <span>Adalet Mah. Manas Bulvarı Folkart Towers B Kule No:39 Daire:3306 Bayraklı / İzmir</span>
                            </div>
                        </div>
                    </div>

                    <div class="hero-actions">
                        <a class="btn btn-primary" href="<?= $waLink ?>" target="_blank" rel="noopener">WhatsApp’tan Ulaşın</a>
                        <a class="btn btn-ghost" href="mailto:info@gzygrup.com">E-Posta Gönderin</a>
                    </div>
                </div>

                <div class="map-box" role="img" aria-label="İzmir Bayraklı Folkart Towers">
                    <div class="map-overlay">
                        <b>Güzey Grup Yönetim</b>
                        <p style="margin:6px 0 0;color:var(--muted)">İzmir merkezli profesyonel apartman, site ve bina yönetimi hizmetleri.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="footer">
        <div class="container footer-inner">
            <div>
                <strong>Güzey Grup</strong>
                <div>© <?= date('Y') ?> Tüm hakları saklıdır.</div>
            </div>
            <div>
                <a href="#hakkimizda">Hakkımızda</a> ·
                <a href="#hizmetler">Hizmetler</a> ·
                <a href="#teklif">Teklif Al</a> ·
                <a href="#iletisim">İletişim</a>
            </div>
        </div>
    </footer>

    <a class="whatsapp-float" href="<?= $waLink ?>" target="_blank" rel="noopener" aria-label="WhatsApp">
        <?= icon('message') ?>
    </a>

    <div class="mobile-cta">
        <a class="btn btn-dark" href="tel:+905074725877">Ara</a>
        <a class="btn btn-primary" href="<?= $waLink ?>" target="_blank" rel="noopener">WhatsApp</a>
    </div>

    <script>
        const mobileToggle = document.getElementById('mobileToggle');
        const navLinks = document.getElementById('navLinks');
        mobileToggle?.addEventListener('click', () => navLinks.classList.toggle('open'));
        navLinks?.querySelectorAll('a').forEach(a => a.addEventListener('click', () => navLinks.classList.remove('open')));

        const quoteForm = document.getElementById('quoteForm');
        const resultBox = document.getElementById('formResult');

        quoteForm?.addEventListener('submit', async (e) => {
            e.preventDefault();
            resultBox.className = 'form-result';
            resultBox.textContent = '';

            const submitButton = quoteForm.querySelector('button[type="submit"]');
            const oldText = submitButton.textContent;
            submitButton.disabled = true;
            submitButton.textContent = 'Gönderiliyor...';

            try {
                const response = await fetch(window.location.href, {
                    method: 'POST',
                    body: new FormData(quoteForm),
                    headers: {'X-Requested-With': 'XMLHttpRequest'}
                });

                const data = await response.json();
                resultBox.textContent = data.message || 'İşlem tamamlandı.';
                resultBox.className = 'form-result ' + (data.ok ? 'success' : 'error');

                if (data.ok) {
                    quoteForm.reset();
                }
            } catch (error) {
                resultBox.textContent = 'Gönderim sırasında hata oluştu. Lütfen WhatsApp hattından iletişime geçin.';
                resultBox.className = 'form-result error';
            } finally {
                submitButton.disabled = false;
                submitButton.textContent = oldText;
            }
        });
    </script>
</body>
</html>
<?php
function icon(string $name): string
{
    $icons = [
        'check' => '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M20 6L9 17l-5-5" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        'shield' => '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M12 3l7 3v5c0 5-3.4 8.8-7 10-3.6-1.2-7-5-7-10V6l7-3z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/><path d="M9 12l2 2 4-5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        'wallet' => '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4 7h14a2 2 0 012 2v9a2 2 0 01-2 2H4a2 2 0 01-2-2V7a2 2 0 012-2z" stroke="currentColor" stroke-width="2"/><path d="M18 10h4v5h-4a2.5 2.5 0 010-5zM4 5l11-2 3 2" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>',
        'scale' => '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M12 3v18M5 21h14M7 6h10M6 6l-3 7h6L6 6zm12 0l-3 7h6l-3-7z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        'building' => '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4 21V5a2 2 0 012-2h9a2 2 0 012 2v16M2 21h20M8 7h2M8 11h2M8 15h2M14 7h2M14 11h2M14 15h2" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>',
        'spark' => '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M12 2l1.7 6.1L20 10l-6.3 1.9L12 18l-1.7-6.1L4 10l6.3-1.9L12 2zM19 16l.8 2.2L22 19l-2.2.8L19 22l-.8-2.2L16 19l2.2-.8L19 16z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/></svg>',
        'clipboard' => '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M9 4h6l1 2h3v15H5V6h3l1-2z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/><path d="M9 11h6M9 15h6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>',
        'tool' => '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M14.7 6.3a4 4 0 005 5L11 20l-4-4 8.7-8.7z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/><path d="M7 16l-3 3" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>',
        'leaf' => '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M20 4C10 4 5 9 5 17c8 0 13-5 15-13z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/><path d="M5 17c3-4 6-6 10-8" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>',
        'home' => '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M3 11l9-8 9 8v10h-6v-6H9v6H3V11z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/></svg>',
        'message' => '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M21 11.5a8.5 8.5 0 01-12.6 7.4L3 21l2.1-5.1A8.5 8.5 0 1121 11.5z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/></svg>',
        'phone' => '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M22 16.9v3a2 2 0 01-2.2 2 19.7 19.7 0 01-8.6-3.1 19.3 19.3 0 01-6-6A19.7 19.7 0 012.1 4.2 2 2 0 014.1 2h3a2 2 0 012 1.7l.4 2.8a2 2 0 01-.6 1.8L7.7 9.5a16 16 0 006.8 6.8l1.2-1.2a2 2 0 011.8-.6l2.8.4A2 2 0 0122 16.9z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        'mail' => '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4 5h16v14H4V5z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/><path d="M4 7l8 6 8-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        'pin' => '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M12 22s7-6 7-13a7 7 0 10-14 0c0 7 7 13 7 13z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/><path d="M12 11a2 2 0 100-4 2 2 0 000 4z" stroke="currentColor" stroke-width="2"/></svg>',
    ];

    return $icons[$name] ?? $icons['check'];
}
?>
