{{-- resources/views/partials/navbar.blade.php --}}

@php
  $isActive = fn($route) => request()->routeIs($route) ? true : false;
  $isPath   = fn($path)  => request()->is($path)       ? true : false;
@endphp

<style>
  :root {
    --emerald: #2563eb;
    --emerald-dark: #1d4ed8;
    --cream: #0f172a;
    --nav-bg-scrolled: rgba(255, 255, 255, 0.94);
  }

  /* ── Base ── */
  .tv-nav {
    position: fixed;
    top: 0; left: 0; right: 0;
    z-index: 100;
    height: 72px;
    transition: background 0.35s ease, box-shadow 0.35s ease, height 0.35s ease;
    font-family: 'DM Sans', sans-serif;
  }
  .tv-nav--top      { background: rgba(255,255,255,0.72); backdrop-filter: blur(14px); }
  .tv-nav--scrolled {
    background: var(--nav-bg-scrolled);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    box-shadow: 0 1px 0 rgba(15,23,42,0.08), 0 8px 24px rgba(15,23,42,0.08);
    height: 64px;
  }

  .tv-nav__inner {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 32px;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 24px;
  }

  /* ── Logo ── */
  .tv-logo {
    display: flex;
    align-items: center;
    gap: 10px;
    text-decoration: none;
    flex-shrink: 0;
  }
  .tv-logo__icon {
    width: 34px; height: 34px;
    background: linear-gradient(135deg, var(--emerald-dark), var(--emerald));
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    box-shadow: 0 0 16px rgba(37,99,235,0.35);
  }
  .tv-logo__icon svg { color: #fff; display: block; }
  .tv-logo__name {
    font-family: 'Playfair Display', serif;
    font-size: 20px;
    font-weight: 700;
    color: var(--cream);
    letter-spacing: -0.01em;
  }
  .tv-logo__name span { color: var(--emerald); }

  /* ── Desktop links ── */
  .tv-links {
    display: flex;
    align-items: center;
    gap: 2px;
    list-style: none;
  }
  .tv-link {
    position: relative;
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
    color: rgba(15,23,42,0.72);
    padding: 8px 13px;
    border-radius: 8px;
    transition: color 0.2s, background 0.2s;
    white-space: nowrap;
  }
  .tv-link:hover { color: #1d4ed8; background: rgba(37,99,235,0.08); }
  .tv-link--active {
    color: var(--emerald);
    font-weight: 600;
  }
  .tv-link--active::after {
    content: '';
    position: absolute;
    bottom: 3px; left: 50%;
    transform: translateX(-50%);
    width: 14px; height: 2px;
    border-radius: 2px;
    background: var(--emerald);
  }

  /* ── Actions ── */
  .tv-actions {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-shrink: 0;
  }

  .tv-btn {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    font-family: 'DM Sans', sans-serif;
    font-size: 13px;
    font-weight: 600;
    padding: 9px 20px;
    border-radius: 100px;
    text-decoration: none;
    transition: all 0.22s ease;
    cursor: pointer;
    border: none;
    white-space: nowrap;
  }
  .tv-btn--book {
    background: var(--emerald);
    color: #071410;
    box-shadow: 0 0 18px rgba(37,99,235,0.28);
  }
  .tv-btn--book:hover {
    background: #60a5fa;
    box-shadow: 0 0 30px rgba(37,99,235,0.45);
    transform: translateY(-1px);
  }
  .tv-btn--outline {
    background: transparent;
    color: rgba(15,23,42,0.82);
    border: 1px solid rgba(37,99,235,0.22);
  }
  .tv-btn--outline:hover {
    background: rgba(37,99,235,0.08);
    border-color: rgba(37,99,235,0.38);
    color: var(--cream);
    transform: translateY(-1px);
  }

  /* ── User dropdown ── */
  .tv-dropdown { position: relative; }
  .tv-dropdown__trigger {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 6px 14px 6px 7px;
    border-radius: 100px;
    background: rgba(37,99,235,0.08);
    border: 1px solid rgba(37,99,235,0.18);
    cursor: pointer;
    transition: background 0.2s, border-color 0.2s;
    font-family: 'DM Sans', sans-serif;
    font-size: 13px;
    font-weight: 500;
    color: var(--cream);
  }
  .tv-dropdown__trigger:hover {
    background: rgba(37,99,235,0.13);
    border-color: rgba(37,99,235,0.25);
  }
  .tv-dropdown__avatar {
    width: 28px; height: 28px;
    background: linear-gradient(135deg, var(--emerald-dark), var(--emerald));
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 12px; font-weight: 700; color: #fff;
    flex-shrink: 0;
    text-transform: uppercase;
  }
  .tv-dropdown__chevron {
    width: 14px; height: 14px;
    color: rgba(30,58,138,0.45);
    transition: transform 0.2s;
    flex-shrink: 0;
  }
  .tv-dropdown__chevron--open { transform: rotate(180deg); }

  .tv-dropdown__menu {
    position: absolute;
    top: calc(100% + 10px);
    right: 0;
    width: 220px;
    background: rgba(255, 255, 255, 0.98);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(15,23,42,0.08);
    border-radius: 16px;
    padding: 6px;
    box-shadow: 0 24px 64px rgba(15,23,42,0.14);
    opacity: 0;
    transform: translateY(8px) scale(0.97);
    pointer-events: none;
    transition: opacity 0.18s ease, transform 0.18s ease;
  }
  .tv-dropdown__menu--open {
    opacity: 1;
    transform: translateY(0) scale(1);
    pointer-events: all;
  }
  .tv-dropdown__head {
    padding: 10px 14px 12px;
    border-bottom: 1px solid rgba(255,255,255,0.07);
    margin-bottom: 4px;
  }
  .tv-dropdown__dname { font-size: 13px; font-weight: 600; color: var(--cream); }
  .tv-dropdown__email {
    font-size: 11px;
    color: rgba(15,23,42,0.45);
    margin-top: 2px;
    overflow: hidden; text-overflow: ellipsis; white-space: nowrap;
  }
  .tv-dropdown__item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 9px 14px;
    border-radius: 10px;
    font-size: 13px; font-weight: 500;
    color: rgba(15,23,42,0.78);
    text-decoration: none;
    transition: background 0.15s, color 0.15s;
    cursor: pointer;
    width: 100%;
    background: transparent;
    border: none;
    font-family: 'DM Sans', sans-serif;
    text-align: left;
  }
  .tv-dropdown__item:hover { background: rgba(37,99,235,0.08); color: #1e3a8a; }
  .tv-dropdown__item--danger { color: rgba(252,165,165,0.85); }
  .tv-dropdown__item--danger:hover { background: rgba(239,68,68,0.1); color: #fca5a5; }
  .tv-dropdown__sep { height: 1px; background: rgba(255,255,255,0.07); margin: 4px 8px; }

  /* ── Hamburger ── */
  .tv-burger {
    display: none;
    flex-direction: column;
    gap: 5px;
    cursor: pointer;
    padding: 8px;
    border-radius: 8px;
    background: transparent;
    border: none;
    transition: background 0.2s;
  }
  .tv-burger:hover { background: rgba(37,99,235,0.08); }
  .tv-burger span {
    display: block;
    height: 2px;
    background: var(--cream);
    border-radius: 2px;
    transition: all 0.3s ease;
  }
  .tv-burger span:nth-child(1) { width: 22px; }
  .tv-burger span:nth-child(2) { width: 16px; }
  .tv-burger span:nth-child(3) { width: 22px; }
  .tv-burger--open span:nth-child(1) { transform: translateY(7px) rotate(45deg); width: 22px; }
  .tv-burger--open span:nth-child(2) { opacity: 0; transform: scaleX(0); }
  .tv-burger--open span:nth-child(3) { transform: translateY(-7px) rotate(-45deg); width: 22px; }

  /* ── Mobile menu ── */
  .tv-mobile {
    position: fixed;
    top: 0; left: 0; right: 0;
    z-index: 99;
    background: rgba(255, 255, 255, 0.98);
    backdrop-filter: blur(24px);
    padding-top: 72px;
    transform: translateY(-110%);
    transition: transform 0.38s cubic-bezier(0.22,1,0.36,1);
    border-bottom: 1px solid rgba(15,23,42,0.08);
  }
  .tv-mobile--open { transform: translateY(0); }
  .tv-mobile__inner {
    max-width: 1200px;
    margin: 0 auto;
    padding: 24px 24px 32px;
  }
  .tv-mobile-links {
    list-style: none;
    margin-bottom: 24px;
  }
  .tv-mobile-link {
    display: flex;
    align-items: center;
    justify-content: space-between;
    text-decoration: none;
    font-size: 24px;
    font-family: 'Playfair Display', serif;
    font-weight: 700;
    color: rgba(15,23,42,0.62);
    padding: 11px 4px;
    border-bottom: 1px solid rgba(255,255,255,0.05);
    transition: color 0.2s;
  }
  .tv-mobile-link:last-child { border-bottom: none; }
  .tv-mobile-link:hover, .tv-mobile-link--active { color: #1e3a8a; }
  .tv-mobile-link--active { color: var(--emerald); }
  .tv-mobile-link__arr {
    font-family: 'DM Sans', sans-serif;
    font-size: 16px;
    opacity: 0;
    transition: opacity 0.2s, transform 0.2s;
  }
  .tv-mobile-link:hover .tv-mobile-link__arr { opacity: 1; transform: translateX(4px); }

  .tv-mobile-foot {
    padding-top: 20px;
    border-top: 1px solid rgba(255,255,255,0.07);
    display: flex;
    flex-direction: column;
    gap: 10px;
  }
  .tv-mobile-user {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 14px 16px;
    background: rgba(37,99,235,0.06);
    border: 1px solid rgba(37,99,235,0.12);
    border-radius: 12px;
  }
  .tv-mobile-user__av {
    width: 40px; height: 40px;
    background: linear-gradient(135deg, var(--emerald-dark), var(--emerald));
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 16px; font-weight: 700; color: #fff;
    flex-shrink: 0; text-transform: uppercase;
  }
  .tv-mobile-user__name { font-size: 14px; font-weight: 600; color: var(--cream); }
  .tv-mobile-user__email { font-size: 12px; color: rgba(15,23,42,0.5); }
  .tv-btn--full { width: 100%; justify-content: center; padding: 13px; border-radius: 12px; font-size: 14px; }
  .tv-btn--danger {
    background: transparent;
    border: 1px solid rgba(239,68,68,0.3);
    color: rgba(252,165,165,0.85);
  }
  .tv-btn--danger:hover { background: rgba(239,68,68,0.1); color: #fca5a5; transform: none; }

  @media (max-width: 768px) {
    .tv-links, .tv-actions { display: none; }
    .tv-burger { display: flex; }
    .tv-nav__inner { padding: 0 20px; }
  }
</style>

{{-- ─── NAVBAR ─── --}}
<nav class="tv-nav tv-nav--top" id="tv-navbar">
  <div class="tv-nav__inner">

    {{-- Logo --}}
    <a href="/" class="tv-logo">
      <div class="tv-logo__icon">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
          <path d="m8 3 4 8 5-5 5 13H2L8 3z"/>
        </svg>
      </div>
      <span class="tv-logo__name">Himal<span>Yatra</span></span>
    </a>

    {{-- Desktop links --}}
    <ul class="tv-links">
      <li><a href="/" class="tv-link {{ $isPath('/') ? 'tv-link--active' : '' }}">Home</a></li>
      <li><a href="{{ route('treks.index') }}" class="tv-link {{ $isActive('treks.index') ? 'tv-link--active' : '' }}">Treks</a></li>
      <li><a href="{{ route('front.destinations') }}" class="tv-link {{ $isActive('front.destinations') ? 'tv-link--active' : '' }}">Destinations</a></li>
      <li><a href="{{ route('about') }}" class="tv-link {{ $isActive('about') ? 'tv-link--active' : '' }}">About</a></li>
      <li><a href="/contact" class="tv-link {{ $isPath('contact') ? 'tv-link--active' : '' }}">Contact</a></li>
    </ul>

    {{-- Desktop actions --}}
    <div class="tv-actions">
      <a href="{{ route('booking.form') }}" class="tv-btn tv-btn--book">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
        Book Yatra
      </a>

      @auth
        <div class="tv-dropdown" id="tv-dropdown">
          <button class="tv-dropdown__trigger" id="tv-dd-trigger">
            <div class="tv-dropdown__avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
            <span>{{ Auth::user()->name }}</span>
            <svg class="tv-dropdown__chevron" id="tv-dd-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M6 9l6 6 6-6"/></svg>
          </button>

          <div class="tv-dropdown__menu" id="tv-dd-menu">
            <div class="tv-dropdown__head">
              <div class="tv-dropdown__dname">{{ Auth::user()->name }}</div>
              <div class="tv-dropdown__email">{{ Auth::user()->email }}</div>
            </div>

            <a href="{{ route('user.bookings', Auth::user()->name) }}" class="tv-dropdown__item">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
              Dashboard
            </a>

            <div class="tv-dropdown__sep"></div>

            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="tv-dropdown__item tv-dropdown__item--danger">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                Log Out
              </button>
            </form>
          </div>
        </div>
      @else
        <a href="{{ route('register') }}" class="tv-btn tv-btn--outline">Join Yatra</a>
      @endauth
    </div>

    {{-- Hamburger --}}
    <button class="tv-burger" id="tv-burger" aria-label="Toggle menu">
      <span></span><span></span><span></span>
    </button>

  </div>
</nav>

{{-- ─── MOBILE MENU ─── --}}
<div class="tv-mobile" id="tv-mobile">
  <div class="tv-mobile__inner">

    <ul class="tv-mobile-links">
      <li><a href="/" class="tv-mobile-link {{ $isPath('/') ? 'tv-mobile-link--active' : '' }}">Home <span class="tv-mobile-link__arr">→</span></a></li>
      <li><a href="{{ route('treks.index') }}" class="tv-mobile-link {{ $isActive('treks.index') ? 'tv-mobile-link--active' : '' }}">Treks <span class="tv-mobile-link__arr">→</span></a></li>
      <li><a href="{{ route('front.destinations') }}" class="tv-mobile-link {{ $isActive('front.destinations') ? 'tv-mobile-link--active' : '' }}">Destinations <span class="tv-mobile-link__arr">→</span></a></li>
      <li><a href="{{ route('about') }}" class="tv-mobile-link {{ $isActive('about') ? 'tv-mobile-link--active' : '' }}">About <span class="tv-mobile-link__arr">→</span></a></li>
      <li><a href="/contact" class="tv-mobile-link {{ $isPath('contact') ? 'tv-mobile-link--active' : '' }}">Contact <span class="tv-mobile-link__arr">→</span></a></li>
    </ul>

    <div class="tv-mobile-foot">
      @auth
        <div class="tv-mobile-user">
          <div class="tv-mobile-user__av">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
          <div>
            <div class="tv-mobile-user__name">{{ Auth::user()->name }}</div>
            <div class="tv-mobile-user__email">{{ Auth::user()->email }}</div>
          </div>
        </div>
        <a href="{{ route('user.bookings', Auth::user()->name) }}" class="tv-btn tv-btn--outline tv-btn--full">Dashboard</a>
        <a href="{{ route('booking.form') }}" class="tv-btn tv-btn--book tv-btn--full">Book Yatra</a>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="tv-btn tv-btn--full tv-btn--danger">Log Out</button>
        </form>
      @else
        <a href="{{ route('login') }}" class="tv-btn tv-btn--outline tv-btn--full">Sign In</a>
        <a href="{{ route('booking.form') }}" class="tv-btn tv-btn--book tv-btn--full">Book Yatra</a>
      @endauth
    </div>

  </div>
</div>

<script>
  // Scroll: transparent ↔ dark glass
  const tvNav = document.getElementById('tv-navbar');
  window.addEventListener('scroll', () => {
    tvNav.classList.toggle('tv-nav--scrolled', window.scrollY > 20);
    tvNav.classList.toggle('tv-nav--top', window.scrollY <= 20);
  }, { passive: true });

  // Dropdown
  const ddTrigger = document.getElementById('tv-dd-trigger');
  const ddMenu    = document.getElementById('tv-dd-menu');
  const ddChevron = document.getElementById('tv-dd-chevron');
  if (ddTrigger) {
    let open = false;
    ddTrigger.addEventListener('click', e => {
      e.stopPropagation();
      open = !open;
      ddMenu.classList.toggle('tv-dropdown__menu--open', open);
      ddChevron.classList.toggle('tv-dropdown__chevron--open', open);
    });
    document.addEventListener('click', () => {
      open = false;
      ddMenu?.classList.remove('tv-dropdown__menu--open');
      ddChevron?.classList.remove('tv-dropdown__chevron--open');
    });
  }

  // Mobile menu
  const burger     = document.getElementById('tv-burger');
  const mobileMenu = document.getElementById('tv-mobile');
  let menuOpen = false;
  burger.addEventListener('click', () => {
    menuOpen = !menuOpen;
    burger.classList.toggle('tv-burger--open', menuOpen);
    mobileMenu.classList.toggle('tv-mobile--open', menuOpen);
    document.body.style.overflow = menuOpen ? 'hidden' : '';
  });
</script>
