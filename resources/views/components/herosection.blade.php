<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Trek It – Hero Section</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;0,900;1,700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
  <style>
    *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

    :root {
      --emerald: #2563eb;
      --emerald-dark: #1d4ed8;
      --emerald-glow: rgba(37, 99, 235, 0.22);
      --cream: #0f172a;
      --sand: #e8ddc8;
      --charcoal: #ffffff;
      --text-dim: #334155;
    }

    html, body { height: 100%; font-family: 'DM Sans', sans-serif; background: var(--charcoal); }

    /* ─── HERO SECTION ─── */
    .hero {
      position: relative;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      justify-content: center;
      overflow: hidden;
      background: #ffffff;
    }

    /* Background image */
    .hero__bg {
      position: absolute;
      inset: 0;
      z-index: 0;
    }
    .hero__bg img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transform: scale(1);
      filter: none;
      transition: transform 8s ease;
    }
    .hero:hover .hero__bg img { transform: scale(1.01); }

    /* Layered overlays */
    .hero__overlay-bottom {
      position: absolute;
      inset: 0;
      background: linear-gradient(
        to bottom,
        rgba(255,255,255,0.52) 0%,
        rgba(255,255,255,0.35) 45%,
        rgba(255,255,255,0.62) 80%,
        rgba(255,255,255,0.78) 100%
      );
      z-index: 1;
    }
    .hero__overlay-left {
      position: absolute;
      inset: 0;
      background: linear-gradient(
        to right,
        rgba(255,255,255,0.58) 0%,
        rgba(255,255,255,0.15) 60%
      );
      z-index: 1;
    }

    /* Decorative glows */
    .glow {
      position: absolute;
      border-radius: 50%;
      pointer-events: none;
      z-index: 2;
    }
    .glow--tl {
      top: -120px; left: -80px;
      width: 500px; height: 500px;
      background: radial-gradient(circle, rgba(37,99,235,0.16) 0%, transparent 70%);
      animation: pulse-glow 5s ease-in-out infinite alternate;
    }
    .glow--br {
      bottom: -100px; right: -60px;
      width: 460px; height: 460px;
      background: radial-gradient(circle, rgba(56,189,248,0.14) 0%, transparent 70%);
      animation: pulse-glow 6s ease-in-out 1s infinite alternate;
    }
    @keyframes pulse-glow {
      from { opacity: 0.6; transform: scale(1); }
      to   { opacity: 1;   transform: scale(1.08); }
    }

    /* Noise grain overlay */
    .hero::after {
      content: '';
      position: absolute;
      inset: 0;
      z-index: 3;
      opacity: 0.025;
      background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E");
      pointer-events: none;
    }

    /* ─── CONTENT ─── */
    .hero__content {
      position: relative;
      z-index: 10;
      width: 100%;
      max-width: 1200px;
      margin: 0 auto;
      padding: 80px 32px 48px;
    }

    /* Eyebrow */
    .hero__eyebrow {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 28px;
      opacity: 0;
      animation: rise 0.8s cubic-bezier(0.22,1,0.36,1) 0.1s forwards;
    }
    .eyebrow__line {
      width: 32px;
      height: 1px;
      background: var(--emerald);
    }
    .eyebrow__text {
      font-family: 'DM Sans', sans-serif;
      font-size: 11px;
      font-weight: 500;
      letter-spacing: 0.28em;
      text-transform: uppercase;
      color: var(--emerald);
    }

    /* Headline */
    .hero__headline {
      font-family: 'Playfair Display', serif;
      font-size: clamp(52px, 7.5vw, 108px);
      font-weight: 900;
      line-height: 0.95;
      color: #1e3a8a;
      margin-bottom: 32px;
      opacity: 0;
      animation: rise 0.9s cubic-bezier(0.22,1,0.36,1) 0.22s forwards;
    }
    .hero__headline em {
      font-style: italic;
      font-weight: 700;
      color: var(--emerald);
      display: block;
    }

    /* Subheadline */
    .hero__sub {
      font-size: clamp(15px, 1.5vw, 18px);
      font-weight: 300;
      color: var(--text-dim);
      max-width: 520px;
      line-height: 1.75;
      margin-bottom: 44px;
      opacity: 0;
      animation: rise 0.9s cubic-bezier(0.22,1,0.36,1) 0.34s forwards;
    }

    /* CTA Row */
    .hero__ctas {
      display: flex;
      flex-wrap: wrap;
      gap: 14px;
      margin-bottom: 56px;
      align-items: center;
      opacity: 0;
      animation: rise 0.9s cubic-bezier(0.22,1,0.36,1) 0.44s forwards;
    }

    .btn {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      font-family: 'DM Sans', sans-serif;
      font-size: 14px;
      font-weight: 600;
      padding: 15px 30px;
      border-radius: 100px;
      text-decoration: none;
      transition: all 0.25s ease;
      cursor: pointer;
      border: none;
    }
    .btn--primary {
      background: var(--emerald);
      color: #071410;
      box-shadow: 0 0 30px rgba(37,99,235,0.35);
    }
    .btn--primary:hover {
      background: #60a5fa;
      box-shadow: 0 0 44px rgba(37,99,235,0.55);
      transform: translateY(-2px);
    }
    .btn--primary .btn__arrow {
      width: 18px; height: 18px;
      background: rgba(7,20,16,0.2);
      border-radius: 50%;
      display: flex; align-items: center; justify-content: center;
      transition: transform 0.25s ease;
    }
    .btn--primary:hover .btn__arrow { transform: translateX(3px); }

    .btn--ghost {
      background: transparent;
      color: var(--cream);
      border: 1px solid rgba(37,99,235,0.25);
      backdrop-filter: blur(12px);
    }
    .btn--ghost:hover {
      background: rgba(37,99,235,0.08);
      border-color: rgba(37,99,235,0.35);
      transform: translateY(-2px);
    }

    /* Stats strip */
    .hero__stats {
      display: flex;
      gap: 0;
      opacity: 0;
      animation: rise 0.9s cubic-bezier(0.22,1,0.36,1) 0.54s forwards;
    }
    .stat {
      padding-right: 36px;
      border-right: 1px solid rgba(245,240,232,0.1);
      margin-right: 36px;
    }
    .stat:last-child { border-right: none; padding-right: 0; margin-right: 0; }
    .stat__num {
      font-family: 'Playfair Display', serif;
      font-size: 32px;
      font-weight: 700;
      color: var(--cream);
      line-height: 1;
    }
    .stat__label {
      font-size: 11px;
      font-weight: 400;
      letter-spacing: 0.12em;
      text-transform: uppercase;
      color: var(--text-dim);
      margin-top: 5px;
    }

    /* ─── SEARCH BAR ─── */
    .hero__search-wrap {
      position: relative;
      z-index: 10;
      width: 100%;
      padding-bottom: 52px;
      margin-top: auto;
    }
    .hero__search {
      max-width: 900px;
      margin: 0 auto;
      padding: 0 32px;
      opacity: 0;
      animation: rise 0.9s cubic-bezier(0.22,1,0.36,1) 0.64s forwards;
    }
    .search-card {
      background: rgba(255,255,255,0.97);
      backdrop-filter: blur(20px);
      border-radius: 20px;
      padding: 8px;
      box-shadow: 0 32px 80px rgba(0,0,0,0.4), 0 0 0 1px rgba(255,255,255,0.15);
      display: flex;
      align-items: stretch;
      gap: 0;
    }
    .search-field {
      flex: 1;
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 12px 18px;
      border-radius: 14px;
      transition: background 0.18s;
      cursor: pointer;
    }
    .search-field:hover { background: #f1f5f9; }
    .search-field__icon {
      width: 36px; height: 36px;
      background: #ecfdf5;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
    }
    .search-field__icon svg { color: var(--emerald-dark); }
    .search-field__body { flex: 1; min-width: 0; }
    .search-field__label {
      font-size: 10px;
      font-weight: 600;
      letter-spacing: 0.1em;
      text-transform: uppercase;
      color: #94a3b8;
      display: block;
      margin-bottom: 2px;
    }
    .search-field select {
      width: 100%;
      background: transparent;
      border: none;
      outline: none;
      font-family: 'DM Sans', sans-serif;
      font-size: 14px;
      font-weight: 500;
      color: #0f172a;
      cursor: pointer;
    }
    .divider {
      width: 1px;
      background: #e2e8f0;
      margin: 12px 0;
      flex-shrink: 0;
    }
    .search-btn {
      display: flex;
      align-items: center;
      gap: 8px;
      padding: 14px 28px;
      background: #0f172a;
      color: white;
      border-radius: 14px;
      font-family: 'DM Sans', sans-serif;
      font-size: 14px;
      font-weight: 600;
      text-decoration: none;
      border: none;
      cursor: pointer;
      transition: all 0.2s;
      white-space: nowrap;
    }
    .search-btn:hover {
      background: var(--emerald-dark);
      transform: scale(1.02);
    }
    .search-btn svg { flex-shrink: 0; }

    /* ─── SCROLL INDICATOR ─── */
    .scroll-hint {
      position: absolute;
      bottom: 90px;
      right: 48px;
      z-index: 10;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 6px;
      opacity: 0;
      animation: rise 0.8s ease 1.1s forwards;
    }
    .scroll-hint__text {
      font-size: 10px;
      letter-spacing: 0.2em;
      text-transform: uppercase;
      color: rgba(30,58,138,0.45);
      writing-mode: vertical-rl;
    }
    .scroll-hint__bar {
      width: 1px;
      height: 52px;
      background: linear-gradient(to bottom, rgba(245,240,232,0.4), transparent);
      animation: scroll-bar 2s ease-in-out infinite;
    }
    @keyframes scroll-bar {
      0%   { transform: scaleY(1); transform-origin: top; }
      50%  { transform: scaleY(0.3); transform-origin: top; }
      51%  { transform: scaleY(0.3); transform-origin: bottom; }
      100% { transform: scaleY(1); transform-origin: bottom; }
    }

    /* ─── BADGE ─── */
    .hero__badge {
      position: absolute;
      top: 50%;
      right: 48px;
      transform: translateY(-50%);
      z-index: 10;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 12px;
      opacity: 0;
      animation: rise 0.8s ease 0.9s forwards;
    }
    .badge {
      width: 96px;
      height: 96px;
      border: 1px solid rgba(37,99,235,0.38);
      border-radius: 50%;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      background: rgba(255,255,255,0.72);
      backdrop-filter: blur(12px);
      animation: spin-slow 18s linear infinite;
    }
    .badge__num {
      font-family: 'Playfair Display', serif;
      font-size: 26px;
      font-weight: 700;
      color: var(--emerald);
      line-height: 1;
    }
    .badge__text {
      font-size: 8px;
      letter-spacing: 0.15em;
      text-transform: uppercase;
      color: var(--text-dim);
    }
    @keyframes spin-slow {
      from { border-color: rgba(37,99,235,0.3); box-shadow: 0 0 0 0 var(--emerald-glow); }
      50%  { border-color: rgba(37,99,235,0.6); box-shadow: 0 0 30px 4px var(--emerald-glow); }
      to   { border-color: rgba(37,99,235,0.3); box-shadow: 0 0 0 0 var(--emerald-glow); }
    }

    /* ─── ANIMATIONS ─── */
    @keyframes rise {
      from { opacity: 0; transform: translateY(24px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    /* ─── RESPONSIVE ─── */
    @media (max-width: 768px) {
      .hero__content { padding-top: 100px; }
      .hero__badge, .scroll-hint { display: none; }
      .hero__stats { gap: 0; }
      .stat { padding-right: 24px; margin-right: 24px; }
      .stat__num { font-size: 24px; }
      .search-card { flex-direction: column; }
      .divider { width: 100%; height: 1px; margin: 0 12px; }
      .search-btn { justify-content: center; }
      .hero__search-wrap { padding-bottom: 32px; margin-top: 32px; }
    }

    /* spacer for demo */
    .spacer { height: 100px; background: #ffffff; }
  </style>
</head>
<body>

<section class="hero">

  <!-- Background -->
  <div class="hero__bg">
    <!-- Replace with your image: {{ asset('image/front.png') }} -->
    <img src="{{ asset('image/hero-bg.jpg') }}" alt="Himalayan mountain landscape with prayer flags" />
  </div>
  <div class="hero__overlay-bottom"></div>
  <div class="hero__overlay-left"></div>

  <!-- Glows -->
  <div class="glow glow--tl"></div>
  <div class="glow glow--br"></div>

  <!-- Badge (desktop) -->
  <div class="hero__badge">
    <div class="badge">
      <span class="badge__num">Nepal</span>
      <span class="badge__text">Himal Yatra</span>
    </div>
  </div>

  <!-- Scroll hint -->
  <div class="scroll-hint">
    <span class="scroll-hint__text">Scroll</span>
    <div class="scroll-hint__bar"></div>
  </div>

  <!-- Main content -->
  <div class="hero__content">

    <div class="hero__eyebrow">
      <span class="eyebrow__line"></span>
      <span class="eyebrow__text">Namaste from the Himalayas</span>
    </div>

    <h1 class="hero__headline">
      Journey Through<br>the Soul of
      <em>Nepal</em>
    </h1>

    <p class="hero__sub">
      From Everest to Mustang, walk ancient mountain paths, monasteries, and villages with trusted local Nepali guides.
    </p>

    <div class="hero__ctas">
      <a href="{{ route('treks.index') }}" class="btn btn--primary">
        Explore Treks
        <span class="btn__arrow">
          <svg width="10" height="10" viewBox="0 0 10 10" fill="none"><path d="M2 5h6M5.5 2.5L8 5l-2.5 2.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </span>
      </a>
      <a href="{{ route('booking.form') }}" class="btn btn--ghost">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
        Book a Trek
      </a>
    </div>

   
  </div>

  <!-- Search Bar -->
  <div class="hero__search-wrap">
    <div class="hero__search">
      <div class="search-card">

        <div class="search-field">
          <div class="search-field__icon">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 21s-6-5.33-6-10a6 6 0 0 1 12 0c0 4.67-6 10-6 10z"/><circle cx="12" cy="11" r="2.5"/></svg>
          </div>
          <div class="search-field__body">
            <span class="search-field__label">Region</span>
            <select>
              <option value="">All Regions</option>
              <option>Everest</option>
              <option>Annapurna</option>
              <option>Langtang</option>
              <option>Mustang</option>
            </select>
          </div>
        </div>

        <div class="divider"></div>

        <div class="search-field">
          <div class="search-field__icon">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 3"/></svg>
          </div>
          <div class="search-field__body">
            <span class="search-field__label">Duration</span>
            <select>
              <option value="">Any Duration</option>
              <option>1–7 Days</option>
              <option>8–14 Days</option>
              <option>15+ Days</option>
            </select>
          </div>
        </div>

        <div class="divider"></div>

        <div class="search-field">
          <div class="search-field__icon">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 3v18h18"/><rect x="7" y="13" width="3" height="5"/><rect x="12" y="9" width="3" height="9"/><rect x="17" y="5" width="3" height="13"/></svg>
          </div>
          <div class="search-field__body">
            <span class="search-field__label">Difficulty</span>
            <select>
              <option value="">Any Difficulty</option>
              <option>Easy</option>
              <option>Moderate</option>
              <option>Challenging</option>
              <option>Technical</option>
            </select>
          </div>
        </div>

        <a href="#" class="search-btn">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4.3-4.3"/></svg>
          Find Treks
        </a>

      </div>
    </div>
  </div>

</section>

<!-- spacer so search bar isn't clipped at bottom -->
<div class="spacer"></div>

</body>
</html>
