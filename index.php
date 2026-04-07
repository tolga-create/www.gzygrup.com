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
      --panel: #ffffff;
      --line: #e7e4dc;
      --line-dark: #d9d4c8;
      --text: #1b1f23;
      --muted: #69707a;
      --shadow: 0 18px 40px rgba(17, 24, 39, 0.08);
      --shadow-soft: 0 10px 25px rgba(17, 24, 39, 0.05);
      --radius: 26px;
      --container: 1200px;
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }
    html { scroll-behavior: smooth; }
    body {
      font-family: 'Inter', Arial, sans-serif;
      background: linear-gradient(180deg, #fafaf8 0%, #f4f3ef 100%);
      color: var(--text);
      line-height: 1.6;
      overflow-x: hidden;
      letter-spacing: -0.01em;
    }

    a { text-decoration: none; color: inherit; }
    img { max-width: 100%; display: block; }

    .container {
      width: min(var(--container), calc(100% - 34px));
      margin: 0 auto;
    }

    .icon {
      width: 22px;
      height: 22px;
      stroke: currentColor;
      fill: none;
      stroke-width: 1.8;
      stroke-linecap: round;
      stroke-linejoin: round;
      flex: 0 0 auto;
    }

    header {
      position: sticky;
      top: 0;
      z-index: 1000;
      background: rgba(255,255,255,0.92);
      backdrop-filter: blur(14px);
      border-bottom: 1px solid rgba(0,0,0,0.05);
    }

    .header-inner {
      min-height: 84px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 24px;
    }

    .brand {
      display: flex;
      align-items: center;
      gap: 14px;
    }

    .brand-mark {
      width: 48px;
      height: 48px;
      display: grid;
      place-items: center;
      border-radius: 16px;
      background: linear-gradient(180deg, #fffef9 0%, #f3ecdd 100%);
      border: 1px solid var(--line-dark);
      box-shadow: var(--shadow-soft);
      color: var(--gold-dark);
      font-family: 'Cormorant Garamond', serif;
      font-size: 1.1rem;
      font-weight: 700;
      letter-spacing: 0.08em;
    }

    .brand-text strong {
      display: block;
      font-family: 'Cormorant Garamond', serif;
      font-size: 1.7rem;
      line-height: 1;
      letter-spacing: 0.03em;
    }

    .brand-text span {
      display: block;
      color: var(--muted);
      font-size: 0.86rem;
      margin-top: 3px;
    }

    nav {
      display: flex;
      align-items: center;
      gap: 28px;
    }

    nav a {
      font-weight: 600;
      color: #38414b;
      position: relative;
    }

    nav a::after {
      content: "";
      position: absolute;
      left: 0;
      bottom: -9px;
      width: 100%;
      height: 2px;
      background: var(--gold);
      transform: scaleX(0);
      transform-origin: left;
      transition: transform 0.25s ease;
    }

    nav a:hover::after,
    nav a:focus-visible::after {
      transform: scaleX(1);
    }

    .nav-actions {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      padding: 14px 22px;
      border-radius: 999px;
      border: 1px solid transparent;
      font-weight: 700;
      cursor: pointer;
      transition: 0.25s ease;
    }

    .btn-primary {
      background: var(--gold);
      color: #fff;
      box-shadow: 0 12px 26px rgba(184,145,51,0.22);
    }

    .btn-secondary {
      background: #fff;
      color: var(--text);
      border-color: var(--line);
    }

    .menu-toggle {
      display: none;
      background: transparent;
      border: 0;
      font-size: 1.7rem;
      color: var(--gold-dark);
      cursor: pointer;
    }

    .hero {
      padding: 76px 0 52px;
    }

    .hero-grid {
      display: grid;
      grid-template-columns: 1.05fr 0.95fr;
      gap: 34px;
      align-items: center;
      min-height: calc(100vh - 120px);
    }

    .hero-copy .eyebrow {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      padding: 10px 16px;
      border-radius: 999px;
      background: #fffdf6;
      border: 1px solid #eee4cb;
      color: var(--gold-dark);
      font-size: 0.9rem;
      font-weight: 700;
      margin-bottom: 18px;
    }

    .hero h1 {
      font-family: 'Cormorant Garamond', serif;
      font-size: clamp(3rem, 6vw, 5.3rem);
      line-height: 0.95;
      letter-spacing: 0.01em;
      margin-bottom: 18px;
    }

    .hero h1 span {
      color: var(--gold-dark);
      display: block;
      margin-top: 10px;
    }

    .hero p {
      color: var(--muted);
      font-size: 1.08rem;
      max-width: 680px;
      margin-bottom: 28px;
    }

    .hero-actions {
      display: flex;
      flex-wrap: wrap;
      gap: 12px;
      margin-bottom: 22px;
    }

    .hero-trust {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      margin-bottom: 34px;
    }

    .hero-trust span {
      padding: 10px 14px;
      border-radius: 999px;
      background: #fff;
      border: 1px solid var(--line);
      color: var(--muted);
      font-size: 0.9rem;
      font-weight: 600;
      box-shadow: var(--shadow-soft);
    }

    .hero-stats {
      display: grid;
      grid-template-columns: repeat(3, minmax(0, 1fr));
      gap: 14px;
      max-width: 760px;
    }

    .stat {
      background: var(--panel);
      border: 1px solid var(--line);
      border-radius: 20px;
      padding: 18px;
      box-shadow: var(--shadow-soft);
    }

    .stat strong {
      display: block;
      color: var(--gold-dark);
      font-size: 1.25rem;
      margin-bottom: 6px;
    }

    .stat span {
      color: var(--muted);
      font-size: 0.92rem;
    }

    .hero-card {
      background: linear-gradient(180deg, #ffffff 0%, #fbfaf7 100%);
      border: 1px solid var(--line);
      border-radius: 30px;
      box-shadow: var(--shadow);
      overflow: hidden;
      padding: 18px;
    }

    .hero-showcase {
      min-height: 560px;
      border-radius: 24px;
      background: linear-gradient(180deg, #ffffff 0%, #f8f6f1 100%);
      border: 1px solid var(--line);
      overflow: hidden;
    }

    .showcase-topbar {
      height: 58px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 18px;
      background: rgba(255,255,255,0.8);
      border-bottom: 1px solid var(--line);
    }

    .topbar-dots {
      display: flex;
      gap: 8px;
    }

    .topbar-dots span {
      width: 10px;
      height: 10px;
      border-radius: 50%;
      background: #d9d9d9;
    }

    .topbar-label {
      color: var(--muted);
      font-size: 0.88rem;
      font-weight: 600;
    }

    .showcase-content {
      padding: 22px;
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 18px;
    }

    .showcase-panel,
    .logo-panel {
      border-radius: 22px;
      background: #fff;
      border: 1px solid var(--line);
      box-shadow: var(--shadow-soft);
    }

    .showcase-panel {
      padding: 26px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .showcase-panel h3 {
      font-family: 'Cormorant Garamond', serif;
      font-size: 2.3rem;
      line-height: 1;
      margin-bottom: 12px;
    }

    .showcase-panel p {
      color: var(--muted);
      max-width: 300px;
    }

    .showcase-mini-cards {
      display: grid;
      gap: 12px;
      margin-top: 24px;
    }

    .showcase-mini-card {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 12px;
      padding: 14px 16px;
      border-radius: 18px;
      background: #fcfbf8;
      border: 1px solid var(--line);
    }

    .mini-status {
      width: 13px;
      height: 13px;
      border-radius: 50%;
      background: var(--gold);
      box-shadow: 0 0 0 6px rgba(184,145,51,0.12);
    }

    .logo-panel {
      padding: 26px;
      display: grid;
      place-items: center;
      position: relative;
      background: linear-gradient(180deg, #fff 0%, #fbfaf6 100%);
    }

    .logo-wrap {
      width: min(74%, 290px);
      aspect-ratio: 1 / 1;
      display: grid;
      place-items: center;
      border-radius: 26px;
      background: linear-gradient(180deg, #fffdf8 0%, #f5efdf 100%);
      border: 1px solid #eadfc5;
      box-shadow: 0 16px 30px rgba(184,145,51,0.12);
      padding: 22px;
    }

    .logo-wrap img {
      max-width: 100%;
      max-height: 100%;
      object-fit: contain;
    }

    .mini-badge {
      margin-top: 18px;
      padding: 16px 18px;
      border-radius: 18px;
      background: rgba(255,255,255,0.95);
      border: 1px solid var(--line);
      box-shadow: var(--shadow-soft);
    }

    .mini-badge strong {
      display: block;
      font-family: 'Cormorant Garamond', serif;
      font-size: 1.25rem;
      margin-bottom: 5px;
    }

    .mini-badge p {
      color: var(--muted);
      font-size: 0.9rem;
    }

    section { padding: 92px 0; }

    .section-head {
      max-width: 760px;
      margin: 0 auto 42px;
      text-align: center;
    }

    .section-head .tag {
      display: inline-block;
      margin-bottom: 12px;
      color: var(--gold-dark);
      font-size: 0.8rem;
      font-weight: 800;
      letter-spacing: 0.1em;
      text-transform: uppercase;
    }

    .section-head h2 {
      font-family: 'Cormorant Garamond', serif;
      font-size: clamp(2.4rem, 4vw, 3.5rem);
      line-height: 1;
      margin-bottom: 14px;
    }

    .section-head p {
      color: var(--muted);
      font-size: 1rem;
    }

    .about-grid,
    .contact-wrap {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 24px;
    }

    .glass-card {
      background: var(--panel);
      border: 1px solid var(--line);
      border-radius: var(--radius);
      box-shadow: var(--shadow-soft);
      padding: 30px;
    }

    .feature-list,
    .contact-list {
      display: grid;
      gap: 16px;
    }

    .feature-item,
    .contact-row {
      display: flex;
      gap: 14px;
      align-items: flex-start;
    }

    .feature-icon,
    .contact-row svg {
      color: var(--gold-dark);
    }

    .services-grid {
      display: grid;
      grid-template-columns: repeat(3, minmax(0, 1fr));
      gap: 20px;
    }

    .service-card {
      background: var(--panel);
      border: 1px solid var(--line);
      border-radius: 24px;
      padding: 26px;
      box-shadow: var(--shadow-soft);
    }

    .service-icon {
      width: 56px;
      height: 56px;
      display: grid;
      place-items: center;
      border-radius: 18px;
      margin-bottom: 18px;
      background: linear-gradient(180deg, #fffaf0 0%, #f7eed9 100%);
      border: 1px solid #ecdcae;
      color: var(--gold-dark);
    }

    .service-card h3 {
      font-family: 'Cormorant Garamond', serif;
      font-size: 1.55rem;
      margin-bottom: 8px;
    }

    .service-card p,
    .about-text p,
    .contact-card p,
    .contact-info p,
    .contact-row span,
    .contact-row a {
      color: var(--muted);
    }

    .highlight-band {
      margin-top: 32px;
      display: grid;
      grid-template-columns: repeat(4, minmax(0, 1fr));
      gap: 14px;
    }

    .highlight-item {
      background: #fff;
      border: 1px solid var(--line);
      border-radius: 20px;
      padding: 20px;
      text-align: center;
      box-shadow: var(--shadow-soft);
    }

    .contact-card h3,
    .contact-info h3 {
      font-family: 'Cormorant Garamond', serif;
      font-size: 2rem;
      margin-bottom: 12px;
    }

    .contact-row {
      padding: 16px 18px;
      background: #fcfbf8;
      border: 1px solid var(--line);
      border-radius: 18px;
    }

    .cta-box {
      margin-top: 24px;
      padding: 22px;
      border-radius: 20px;
      background: linear-gradient(180deg, #fffdf7 0%, #f7f0df 100%);
      border: 1px solid #ead9ab;
    }

    .cta-actions {
      display: flex;
      flex-wrap: wrap;
      gap: 12px;
      margin-top: 16px;
    }

    footer {
      border-top: 1px solid var(--line);
      padding: 28px 0 40px;
      color: var(--muted);
      background: rgba(255,255,255,0.6);
    }

    .footer-inner {
      display: flex;
      justify-content: space-between;
      gap: 20px;
      align-items: center;
      flex-wrap: wrap;
    }

    .footer-links {
      display: flex;
      gap: 18px;
      flex-wrap: wrap;
    }

    .whatsapp-float {
      position: fixed;
      right: 20px;
      bottom: 20px;
      z-index: 1000;
      background: #c49a3a;
      color: #fff;
      padding: 14px 18px;
      border-radius: 999px;
      font-weight: 800;
      box-shadow: 0 16px 30px rgba(184,145,51,0.24);
    }

    @media (max-width: 1100px) {
      .hero-grid, .about-grid, .contact-wrap, .showcase-content, .services-grid, .highlight-band {
        grid-template-columns: 1fr;
      }
    }

    @media (max-width: 860px) {
      .menu-toggle { display: inline-flex; }

      nav {
        position: absolute;
        top: calc(100% + 8px);
        left: 16px;
        right: 16px;
        display: none;
        flex-direction: column;
        align-items: flex-start;
        gap: 16px;
        padding: 20px;
        background: #fff;
        border: 1px solid var(--line);
        border-radius: 22px;
        box-shadow: var(--shadow);
      }

      nav.active { display: flex; }
      .nav-actions .btn-secondary { display: none; }
      .hero-grid { min-height: auto; }
    }

    @media (max-width: 560px) {
      .container { width: min(var(--container), calc(100% - 24px)); }
      .hero h1 { font-size: 2.4rem; }
      .brand-text strong { font-size: 1.45rem; }
      .whatsapp-float { right: 12px; bottom: 12px; padding: 12px 15px; font-size: 0.92rem; }
    }
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
            <a href="#services" class="btn btn-primary">Hizmetleri İncele</a>
            <a href="#contact" class="btn btn-secondary">İletişime Geç</a>
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
                  <div class="showcase-mini-card">
                    <div>
                      <strong>Operasyon Takibi</strong>
                      <span>Planlı ve kontrollü süreç yönetimi</span>
                    </div>
                    <div class="mini-status"></div>
                  </div>

                  <div class="showcase-mini-card">
                    <div>
                      <strong>Finansal Düzen</strong>
                      <span>Takip edilebilir kurumsal yaklaşım</span>
                    </div>
                    <div class="mini-status"></div>
                  </div>

                  <div class="showcase-mini-card">
                    <div>
                      <strong>Hızlı İletişim</strong>
                      <span>Destek taleplerine hızlı geri dönüş</span>
                    </div>
                    <div class="mini-status"></div>
                  </div>
                </div>
              </div>

              <div class="logo-panel">
                <div class="logo-wrap">
                  <img src="logo.png" alt="Güzey Grup logo">
                </div>
                <div class="mini-badge">
                  <strong>Profesyonel Yönetim Anlayışı</strong>
                  <p>Kurumsal görünüm, düzenli iletişim ve güven veren hizmet yaklaşımı.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="about">
      <div class="container">
        <div class="section-head">
          <span class="tag">Hakkımızda</span>
          <h2>Kurumsal yaklaşım, sürdürülebilir yönetim</h2>
          <p>Yönetim süreçlerini yalnızca takip etmiyor; düzenli hale getiriyor, kayıt altına alıyor ve profesyonel bir yapıya dönüştürüyoruz.</p>
        </div>

        <div class="about-grid">
          <div class="glass-card about-text">
            <p>2005 yılında İzmir'de kurulan Güzey Grup, bina ve site yönetimi alanında edindiği tecrübesini hukuk, temizlik, güvenlik, peyzaj ve destek hizmetleriyle birleştirerek kapsamlı bir hizmet yapısı sunmaktadır.</p>
            <p>Amacımız; yaşam alanlarında düzeni artırmak, yönetsel yükü azaltmak ve kat malikleri ile sakinler için güven veren, erişilebilir ve sistemli bir yönetim modeli oluşturmaktır.</p>
          </div>

          <div class="glass-card">
            <div class="feature-list">
              <div class="feature-item">
                <div class="feature-icon">
                  <svg class="icon" viewBox="0 0 24 24"><path d="M3 10.5 12 3l9 7.5"></path><path d="M5 9.5V21h14V9.5"></path></svg>
                </div>
                <div>
                  <strong>Şeffaf yönetim</strong>
                  <p>Gider, süreç ve operasyon takibinde net, anlaşılır ve düzenli bir yapı.</p>
                </div>
              </div>

              <div class="feature-item">
                <div class="feature-icon">
                  <svg class="icon" viewBox="0 0 24 24"><path d="M8 3h8"></path><path d="M9 3v4"></path><path d="M15 3v4"></path><path d="M5 9h14"></path><rect x="4" y="7" width="16" height="13" rx="2"></rect></svg>
                </div>
                <div>
                  <strong>Mevzuata uygun süreçler</strong>
                  <p>Kat mülkiyeti ve yönetsel işlemlerde profesyonel kontrol ve hukuki destek.</p>
                </div>
              </div>

              <div class="feature-item">
                <div class="feature-icon">
                  <svg class="icon" viewBox="0 0 24 24"><path d="M4 12h16"></path><path d="M12 4v16"></path><circle cx="12" cy="12" r="9"></circle></svg>
                </div>
                <div>
                  <strong>Tek noktadan çözüm</strong>
                  <p>Yönetimden teknik desteğe kadar bütüncül hizmet organizasyonu.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="services">
      <div class="container">
        <div class="section-head">
          <span class="tag">Hizmetlerimiz</span>
          <h2>Yaşam alanlarınız için kapsamlı hizmet yapısı</h2>
          <p>Site ve apartman yönetiminde ihtiyaç duyulan temel operasyonları tek çatı altında planlı şekilde yürütüyoruz.</p>
        </div>

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
        <div class="section-head">
          <span class="tag">İletişim</span>
          <h2>Bizimle iletişime geçin</h2>
          <p>Apartman, site ve yaşam alanı yönetimi için profesyonel hizmet talebinizi bizimle paylaşabilirsiniz.</p>
        </div>

        <div class="contact-wrap">
          <div class="glass-card contact-card">
            <h3>Hızlı iletişim</h3>
            <p>Bilgi talebi ve hizmet detayları için aşağıdaki iletişim kanallarımızdan bize ulaşabilirsiniz.</p>

            <div class="contact-list">
              <div class="contact-row"><div><svg class="icon" viewBox="0 0 24 24"><path d="M22 16.9v3a2 2 0 0 1-2.2 2A19.8 19.8 0 0 1 3.1 5.2 2 2 0 0 1 5.1 3h3a2 2 0 0 1 2 1.7l.4 2.6a2 2 0 0 1-.6 1.8l-1.4 1.4a16 16 0 0 0 5 5l1.4-1.4a2 2 0 0 1 1.8-.6l2.6.4A2 2 0 0 1 22 16.9Z"></path></svg></div><div><strong>Telefon</strong><a href="tel:+905074725877">0507 472 58 77</a><br><a href="tel:+905526620158">0552 662 01 58</a><br><a href="tel:+902324847332">0232 484 73 32</a></div></div>
              <div class="contact-row"><div><svg class="icon" viewBox="0 0 24 24"><path d="M4 6h16v12H4z"></path><path d="m4 7 8 6 8-6"></path></svg></div><div><strong>E-Posta</strong><a href="mailto:info@gzygrup.com">info@gzygrup.com</a></div></div>
              <div class="contact-row"><div><svg class="icon" viewBox="0 0 24 24"><path d="M12 21s7-4.5 7-11a7 7 0 1 0-14 0c0 6.5 7 11 7 11Z"></path><circle cx="12" cy="10" r="2.5"></circle></svg></div><div><strong>Adres</strong><span>Manas Bulvarı No: 39, Folkart Towers B Kule, Kat: 33, Daire No: 3306, Bayraklı / İzmir</span></div></div>
            </div>
          </div>

          <div class="glass-card contact-info">
            <h3>Neden Güzey Grup?</h3>
            <p>Yönetim süreçlerinde yalnızca hizmet vermeyi değil, güven inşa etmeyi hedefliyoruz. Düzenli takip, profesyonel iletişim ve planlı operasyon anlayışıyla süreci uçtan uca yönetiyoruz.</p>

            <div class="cta-box">
              <strong>Hızlı ulaşım</strong>
              <p>Sorularınız için bize doğrudan WhatsApp hattımızdan veya e-posta üzerinden ulaşabilirsiniz.</p>
              <div class="cta-actions">
                <a href="https://wa.me/905074725877" class="btn btn-primary" target="_blank" rel="noopener">WhatsApp’tan Ulaşın</a>
                <a href="mailto:info@gzygrup.com" class="btn btn-secondary">E-Posta Gönderin</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <footer>
    <div class="container footer-inner">
      <div>© 2026 Güzey Grup. Tüm hakları saklıdır.</div>
      <div class="footer-links">
        <a href="#about">Hakkımızda</a>
        <a href="#services">Hizmetler</a>
        <a href="#contact">İletişim</a>
      </div>
    </div>
  </footer>

  <a href="https://wa.me/905074725877" class="whatsapp-float" target="_blank" rel="noopener" aria-label="WhatsApp ile iletişim">WhatsApp</a>

  <script>
    const menuToggle = document.getElementById('menuToggle');
    const navMenu = document.getElementById('navMenu');

    if (menuToggle) {
      menuToggle.addEventListener('click', () => navMenu.classList.toggle('active'));
    }

    document.querySelectorAll('nav a').forEach(link => {
      link.addEventListener('click', () => navMenu.classList.remove('active'));
    });
  </script>
</body>
</html>
