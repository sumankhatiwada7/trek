<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Nepali Trails - Preview</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;0,900;1,700&family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }
    body { background: #ffffff; font-family: 'DM Sans', sans-serif; }

    .treks-section {
      background: #ffffff;
      padding: 100px 0 120px;
      position: relative;
      overflow: hidden;
    }
    .treks-section::before {
      content: '';
      position: absolute;
      top: -200px; left: 50%;
      transform: translateX(-50%);
      width: 800px; height: 600px;
      background: radial-gradient(ellipse, rgba(59,130,246,0.08) 0%, transparent 70%);
      pointer-events: none;
    }
    .treks-container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 32px;
      position: relative;
      z-index: 1;
    }

    /* Header */
    .treks-header {
      display: flex;
      align-items: flex-end;
      justify-content: space-between;
      gap: 32px;
      margin-bottom: 56px;
      flex-wrap: wrap;
    }
    .treks-header__left { max-width: 560px; }
    .treks-eyebrow {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      margin-bottom: 18px;
    }
    .treks-eyebrow__line { width: 28px; height: 1px; background: #2563eb; }
    .treks-eyebrow__text {
      font-size: 11px; font-weight: 500;
      letter-spacing: 0.28em; text-transform: uppercase; color: #2563eb;
    }
    .treks-title {
      font-family: 'Playfair Display', serif;
      font-size: clamp(36px, 4.5vw, 58px);
      font-weight: 900;
      line-height: 1.0;
      color: #0f172a;
      margin-bottom: 16px;
    }
    .treks-title em { font-style: italic; font-weight: 700; color: #2563eb; }
    .treks-subtitle { font-size: 16px; font-weight: 300; color: #475569; line-height: 1.7; }
    .treks-header__cta {
      display: inline-flex; align-items: center; gap: 8px;
      font-size: 13px; font-weight: 600;
      color: #1d4ed8;
      text-decoration: none;
      padding: 11px 22px;
      border: 1px solid rgba(245,240,232,0.15);
      border-radius: 100px;
      transition: all 0.22s ease;
      white-space: nowrap; flex-shrink: 0;
    }
    .treks-header__cta:hover {
      color: #1e3a8a; border-color: #93c5fd; background: #eff6ff;
    }
    .treks-header__cta svg { transition: transform 0.2s; }
    .treks-header__cta:hover svg { transform: translateX(3px); }

    /* Grid */
    .treks-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 24px;
    }

    /* Card */
    .trek-card {
      background: #ffffff;
      border: 1px solid #e2e8f0;
      border-radius: 20px;
      overflow: hidden;
      transition: transform 0.35s cubic-bezier(0.22,1,0.36,1), border-color 0.3s ease, box-shadow 0.35s ease;
      text-decoration: none;
      display: flex; flex-direction: column;
      box-shadow: 0 10px 28px rgba(15, 23, 42, 0.12);
    }
    .trek-card:hover {
      transform: translateY(-6px);
      border-color: #bfdbfe;
      box-shadow: 0 18px 40px rgba(15, 23, 42, 0.16);
    }

    .trek-card__img-wrap {
      position: relative; height: 220px;
      overflow: hidden; background: #1a2530;
    }
    .trek-card__img {
      width: 100%; height: 100%; object-fit: cover;
      transition: transform 0.7s cubic-bezier(0.22,1,0.36,1);
      filter: brightness(0.88);
    }
    .trek-card:hover .trek-card__img { transform: scale(1.07); filter: brightness(0.95); }
    .trek-card__img-overlay {
      position: absolute; inset: 0;
      background: linear-gradient(to top, rgba(7,11,16,0.7) 0%, transparent 50%);
    }

    .trek-card__badge {
      position: absolute; top: 14px; left: 14px;
      display: inline-flex; align-items: center; gap: 5px;
      padding: 5px 12px; border-radius: 100px;
      font-size: 11px; font-weight: 600; letter-spacing: 0.04em;
      backdrop-filter: blur(8px);
    }
    .trek-card__badge--easy     { background: rgba(59,130,246,0.16); color: #1d4ed8; border: 1px solid rgba(59,130,246,0.26); }
    .trek-card__badge--moderate { background: rgba(14,165,233,0.16); color: #0369a1; border: 1px solid rgba(14,165,233,0.26); }
    .trek-card__badge--hard     { background: rgba(99,102,241,0.16); color: #4338ca; border: 1px solid rgba(99,102,241,0.26); }

    .trek-card__region {
      position: absolute; bottom: 14px; left: 14px;
      display: flex; align-items: center; gap: 5px;
      font-size: 12px; font-weight: 500;
      color: rgba(245,240,232,0.85);
    }
    .trek-card__region svg { color: #2563eb; flex-shrink: 0; }

    .trek-card__body {
      padding: 22px 22px 20px;
      display: flex; flex-direction: column; flex: 1;
    }
    .trek-card__name {
      font-family: 'Playfair Display', serif;
      font-size: 19px; font-weight: 700;
      color: #0f172a; margin-bottom: 16px;
      line-height: 1.25; transition: color 0.2s;
    }
    .trek-card:hover .trek-card__name { color: #1d4ed8; }

    .trek-card__meta {
      display: flex; align-items: center;
      gap: 18px; margin-bottom: 20px;
    }
    .trek-card__meta-item {
      display: flex; align-items: center; gap: 6px;
      font-size: 13px; color: #475569;
    }
    .trek-card__meta-item svg { color: #2563eb; flex-shrink: 0; }

    .trek-card__footer {
      display: flex; align-items: center;
      justify-content: space-between;
      padding-top: 16px;
      border-top: 1px solid #e2e8f0;
      margin-top: auto;
    }
    .trek-card__price-label {
      font-size: 11px; font-weight: 400;
      letter-spacing: 0.05em; text-transform: uppercase;
      color: #64748b; display: block; margin-bottom: 2px;
    }
    .trek-card__price {
      font-family: 'Playfair Display', serif;
      font-size: 24px; font-weight: 700;
      color: #2563eb; line-height: 1;
    }
    .trek-card__price sup {
      font-size: 14px; font-family: 'DM Sans', sans-serif;
      font-weight: 600; vertical-align: super;
    }

    .trek-card__btn {
      display: inline-flex; align-items: center; gap: 6px;
      padding: 10px 18px;
      background: #eff6ff;
      border: 1px solid #bfdbfe;
      border-radius: 100px;
      font-size: 13px; font-weight: 600;
      color: #2563eb; text-decoration: none;
      transition: all 0.22s ease;
    }
    .trek-card__btn:hover { background: #2563eb; color: #eff6ff; border-color: #2563eb; }
    .trek-card__btn svg { transition: transform 0.2s; }
    .trek-card:hover .trek-card__btn svg { transform: translateX(2px); }

    /* Footer CTA */
    .treks-footer { text-align: center; margin-top: 56px; }
    .treks-footer__btn {
      display: inline-flex; align-items: center; gap: 10px;
      padding: 15px 36px;
      background: #2563eb; color: #eff6ff;
      border-radius: 100px;
      font-size: 14px; font-weight: 700;
      text-decoration: none;
      box-shadow: 0 0 28px rgba(37,99,235,0.3);
      transition: all 0.25s ease;
      font-family: 'DM Sans', sans-serif;
    }
    .treks-footer__btn:hover {
      background: #60a5fa;
      box-shadow: 0 0 44px rgba(37,99,235,0.48);
      transform: translateY(-2px);
    }
    .treks-footer__sub {
      margin-top: 14px; font-size: 13px;
      color: #64748b;
    }

    @media (max-width: 1024px) { .treks-grid { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 640px) {
      .treks-section { padding: 72px 0 96px; }
      .treks-container { padding: 0 20px; }
      .treks-grid { grid-template-columns: 1fr; gap: 18px; }
      .treks-header { flex-direction: column; align-items: flex-start; }
      .treks-header__cta { display: none; }
      .treks-title { font-size: 36px; }
    }
  </style>
</head>
<body>

<section class="treks-section">
  <div class="treks-container">

    <div class="treks-header">
      <div class="treks-header__left">
        <div class="treks-eyebrow">
          <span class="treks-eyebrow__line"></span>
          <span class="treks-eyebrow__text">Nepali Trails</span>
        </div>
        <h2 class="treks-title">Explore <em>Nepal's</em><br>Sacred Paths</h2>
        <p class="treks-subtitle">Curated Himalayan journeys shaped by mountain culture, prayer routes, and village hospitality.</p>
      </div>
      <a href="{{ route('treks.index') }}" class="treks-header__cta">
        View all yatras
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
      </a>
    </div>

    @php
      $treks = \App\Models\trek::with('trekImages')->latest()->get();
    @endphp

    <div class="treks-grid">
      @forelse ($treks as $trek)
        @php
          $img = $trek->trekImages->sortBy('id')->first();
          $photoPath = $img?->photo ?? $img?->image_path;
          $imageUrl = $photoPath ? \Illuminate\Support\Facades\Storage::url($photoPath) : asset('image/alpine.png');
          $difficulty = strtolower((string) $trek->difficultylevel);
          $badgeClass = str_contains($difficulty, 'easy')
              ? 'trek-card__badge--easy'
              : (str_contains($difficulty, 'moderate')
                  ? 'trek-card__badge--moderate'
                  : 'trek-card__badge--hard');
        @endphp

        <article class="trek-card">
          <div class="trek-card__img-wrap">
            <img src="{{ $imageUrl }}" class="trek-card__img" alt="{{ $trek->trekname }}"/>
            <div class="trek-card__img-overlay"></div>
            <span class="trek-card__badge {{ $badgeClass }}">
              <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="m8 3 4 8 5-5 5 13H2L8 3z"/></svg>
              {{ $trek->difficultylevel ?? 'N/A' }}
            </span>
            <div class="trek-card__region">
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 21s-6-5.33-6-10a6 6 0 0 1 12 0c0 4.67-6 10-6 10z"/><circle cx="12" cy="11" r="2"/></svg>
              {{ $trek->region ?? 'Unknown Region' }}
            </div>
          </div>
          <div class="trek-card__body">
            <h3 class="trek-card__name">{{ $trek->trekname }}</h3>
            <div class="trek-card__meta">
              <div class="trek-card__meta-item">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 3"/></svg>
                {{ $trek->duration ?? 'N/A' }}
              </div>
              <div class="trek-card__meta-item">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                {{ $trek->group_size ?? 'N/A' }} people
              </div>
            </div>
            <div class="trek-card__footer">
              <div>
                <span class="trek-card__price-label">From</span>
                <span class="trek-card__price"><sup>Rs.</sup>{{ number_format((float) ($trek->price ?? 0)) }}</span>
              </div>
              <a href="{{ route('treks.show', $trek->id) }}" class="trek-card__btn">
                Details
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
              </a>
            </div>
          </div>
        </article>
      @empty
        <article class="trek-card">
          <div class="trek-card__body">
            <h3 class="trek-card__name">No Treks Available</h3>
            <p class="treks-subtitle">There are no trek records in the database yet.</p>
          </div>
        </article>
      @endforelse
    </div>

    <div class="treks-footer">
      <a href="{{ route('booking.form') }}" class="treks-footer__btn">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="9"/><path d="M12 8l4 4-4 4M8 12h8"/></svg>
        Plan Your Nepal Yatra
      </a>
      <p class="treks-footer__sub">Traditional routes across Everest, Annapurna, Mustang, and Langtang</p>
    </div>

  </div>
</section>

</body>
</html>


