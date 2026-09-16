<!DOCTYPE html>
<html lang="<?php echo htmlspecialchars($GLOBALS['lang'] ?? 'en', ENT_QUOTES, 'UTF-8'); ?>">

<head>
  <title><?php echo formatTitle($title) ?></title>

  <base href="<?php
    $applicationPath = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '/')), '/');
    echo htmlspecialchars(($applicationPath === '' ? '/' : $applicationPath . '/'), ENT_QUOTES, 'UTF-8');
  ?>" />

  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="Tournament information and results" />
  <meta http-equiv="Content-Security-Policy" content="script-src 'self' 'unsafe-eval' 'unsafe-inline' https://teamplay.nu https://teamplaycup.se https://cdn.datatables.net https://maps.googleapis.com https://maps.gstatic.com https://*.googleapis.com https://apis.google.com https://www.googletagmanager.com https://ajax.googleapis.com https://cdn.jsdelivr.net https://code.jquery.com https://www.gstatic.com https://*.gstatic.com https://unpkg.com; style-src 'self' 'unsafe-inline' https://cdn.jsdelivr.net https://code.jquery.com https://fonts.googleapis.com https://fonts.gstatic.com https://www.gstatic.com https://*.gstatic.com">

  <link rel="shortcut icon" href="assets/images/favicon.ico" type="image/x-icon">
  <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="assets/css/tailwind.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x/dist/cdn.min.js"></script>
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.10/dist/cdn.min.js"></script>

  <?php echo $settings[0]->memo3 ?>

  <?php
    $containerColor = trim((string)($settings[0]->string26 ?? ''));
    if (preg_match('/^[0-9a-fA-F]{6}([0-9a-fA-F]{2})?$/', $containerColor)) {
      $containerColor = '#' . $containerColor;
    }
    $cardColor = trim((string)($settings[0]->string24 ?? ''));
    if (preg_match('/^[0-9a-fA-F]{6}([0-9a-fA-F]{2})?$/', $cardColor)) {
      $cardColor = '#' . $cardColor;
    }
    $transparentContainers = filter_var($settings[0]->bool12 ?? false, FILTER_VALIDATE_BOOLEAN);
    $containerBackground = $transparentContainers ? 'transparent' : ($containerColor !== '' ? $containerColor : '#ffffff');
    $cardBackground = $cardColor !== '' ? $cardColor : '#ffffff';
    $footerBackground = $containerColor !== '' ? $containerColor : '#ffffff';
    $buttonBackground = $containerColor !== '' ? $containerColor : '#0f172a';
    $getContrastTextColor = static function ($background, $fallback = '#1f2937') {
      if (!preg_match('/^#?([0-9a-fA-F]{6})/', $background, $colorMatch)) {
        return $fallback;
      }
      $hex = $colorMatch[1];
      $red = hexdec(substr($hex, 0, 2));
      $green = hexdec(substr($hex, 2, 2));
      $blue = hexdec(substr($hex, 4, 2));
      return (299 * $red + 587 * $green + 114 * $blue) >= 150000 ? '#0f172a' : '#ffffff';
    };
    $containerTextColor = $transparentContainers ? '#1f2937' : $getContrastTextColor($containerBackground);
    $cardTextColor = $getContrastTextColor($cardBackground);
    $footerTextColor = $getContrastTextColor($footerBackground);
    $buttonTextColor = $getContrastTextColor($buttonBackground, '#ffffff');
  ?>

  <style>
    :root {
      --color-container: <?php echo htmlspecialchars($containerBackground, ENT_QUOTES, 'UTF-8'); ?>;
      --color-card: <?php echo htmlspecialchars($cardBackground, ENT_QUOTES, 'UTF-8'); ?>;
      --color-footer: <?php echo htmlspecialchars($footerBackground, ENT_QUOTES, 'UTF-8'); ?>;
      --color-table: #fff;
      --color-accent: <?php echo htmlspecialchars($buttonBackground, ENT_QUOTES, 'UTF-8'); ?>;
      --color-accent-text: <?php echo $buttonTextColor; ?>;
      --color-container-text: <?php echo $containerTextColor; ?>;
      --color-card-text: <?php echo $cardTextColor; ?>;
      --color-footer-text: <?php echo $footerTextColor; ?>;
      --color-text-default: #1f2937;
      --font-family-base: <?php echo htmlspecialchars((!empty($settings[0]->string18) ? $settings[0]->string18 : 'Inter, "Segoe UI", sans-serif'), ENT_QUOTES, 'UTF-8'); ?>;
      --color-surface: rgba(255,255,255,0.88);
      --color-surface-strong: rgba(255,255,255,0.96);
      --color-divider: rgba(148,163,184,0.24);
      --shadow-soft: 0 20px 45px rgba(15, 23, 42, 0.12);
    }

    html {
      scroll-behavior: smooth;
    }

    body {
      font-family: var(--font-family-base);
      color: var(--color-text-default);
      background: linear-gradient(180deg, rgba(255,255,255,0.74), rgba(241,245,249,0.9));
    }

    a {
      transition: opacity 0.18s ease, filter 0.18s ease;
    }

    a,
    a:visited {
      color: var(--color-text-default) !important;
    }

    a:not(.btn):not(.tp-btn):hover {
      opacity: 0.84;
    }

    .homewide .homewide-text-section,
    .homewide .homewide-text-section p,
    .homewide .homewide-text-section h1,
    .homewide .homewide-text-section h2,
    .homewide .homewide-text-section h3,
    .homewide .homewide-text-section h4 {
      color: var(--color-text-default) !important;
    }

    .homewide .jumbotron .container p {
      color: inherit !important;
    }

    body.cup-with-wallpaper {
      isolation: isolate;
      position: relative;
    }

    body.cup-with-wallpaper::before {
      <?php $wallpaperUrl = safeAssetUrl($GLOBALS['baseUrl'], $_GET['home'] ?? '', $settings[0]->pic_name_16 ?? ''); ?>
      background: <?php echo $wallpaperUrl !== '' ? 'url("' . htmlspecialchars($wallpaperUrl, ENT_QUOTES, 'UTF-8') . '")' : 'none'; ?> no-repeat center center;
      background-size: cover;
      content: "";
      filter: blur(2px);
      inset: -10px;
      opacity: 0.16;
      pointer-events: none;
      position: fixed;
      transform: scale(1.04);
      z-index: -1;
    }

    .tp-shell {
      background: var(--color-container);
      backdrop-filter: blur(10px);
      -webkit-backdrop-filter: blur(10px);
      border: 1px solid rgba(148,163,184,0.22);
      box-shadow: var(--shadow-soft);
    }

    .tp-nav {
      position: sticky;
      top: 0;
      z-index: 1000;
      background: rgba(255,255,255,0.85) !important;
      border-bottom: 1px solid var(--color-divider);
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
    }

    .tp-nav a,
    .tp-nav button {
      color: #334155 !important;
    }

    .tp-nav a:hover,
    .tp-nav button:hover {
      background-color: #f1f5f9 !important;
      color: #0f172a !important;
    }

    .tp-nav .dropdown-menu,
    .tp-mobile-nav .dropdown-menu {
      background-color: #fff !important;
      background-image: none !important;
      color: #334155 !important;
    }

    .tp-nav .dropdown-menu a,
    .tp-mobile-nav .dropdown-menu a {
      color: #334155 !important;
    }

    .tp-nav .dropdown-menu a:hover,
    .tp-mobile-nav .dropdown-menu a:hover {
      background-color: #f1f5f9 !important;
      color: #0f172a !important;
    }

    .tp-nav a,
    .tp-footer a {
      transition: opacity 0.2s ease, transform 0.2s ease;
    }

    .tp-nav a:hover,
    .tp-footer a:hover {
      opacity: 0.82;
      transform: translateY(-1px);
    }

    .tp-card {
      background: var(--color-card);
      color: var(--color-card-text);
      border: 1px solid rgba(148,163,184,0.18);
      border-radius: 1rem;
      box-shadow: var(--shadow-soft);
    }

    .tp-shell,
    .content {
      color: var(--color-container-text);
    }

    .tp-shell a,
    .tp-shell a:visited,
    .content a,
    .content a:visited {
      color: var(--color-container-text) !important;
    }

    .tp-shell a:hover,
    .content a:hover {
      color: var(--color-container-text) !important;
      filter: brightness(0.75);
    }

    .tp-shell :where(p, h1, h2, h3, h4, h5, h6, li, label),
    .content :where(p, h1, h2, h3, h4, h5, h6, li, label) {
      color: var(--color-container-text) !important;
    }

    .tp-card :where(p, h1, h2, h3, h4, h5, h6, li, label) {
      color: var(--color-card-text) !important;
    }

    .tp-card a,
    .tp-card a:visited {
      color: var(--color-card-text) !important;
    }

    .tp-card a:hover {
      color: var(--color-card-text) !important;
      filter: brightness(0.75);
    }

    .content .nav.nav-pills > li > a,
    .content .nav.nav-pills > li.active > a,
    .tp-simple-nav > li > a,
    .tp-simple-nav > li.active > a {
      color: #1f2937 !important;
    }

    .content .nav.nav-pills > li > a:hover,
    .content .nav.nav-pills > li.active > a:hover,
    .tp-simple-nav > li > a:hover,
    .tp-simple-nav > li.active > a:hover {
      color: #1f2937 !important;
      background-color: #fff !important;
      box-shadow: 0 4px 12px rgba(15,23,42,.1);
      filter: none;
      opacity: 1;
      transform: translateY(-1px);
    }

    .content .nav.nav-pills > li.active > a,
    .tp-simple-nav > li.active > a {
      background-color: #fff !important;
      box-shadow: 0 4px 12px rgba(15,23,42,.1);
      opacity: 1;
    }

    .content > h2 {
      text-align: left;
    }

    .content h3 {
      margin-top: 2rem;
    }

    table.table.table-condensed.table-striped th {
      text-align: left;
    }

    table.table {
      background-color: var(--color-table) !important;
    }

    table.table > thead > tr > th,
    table.table > tbody > tr > td {
      color: #1f2937 !important;
    }

    table.table > tbody > tr > td a,
    table.table > tbody > tr > td a:visited {
      color: #1f2937 !important;
    }

    table.table > tbody > tr > td a:hover {
      color: #1f2937 !important;
      filter: none;
      opacity: 0.62;
      text-decoration: underline;
    }

    table.table > tbody > tr,
    table.table-striped > tbody > tr:nth-child(odd),
    table.zebra > tbody > tr:nth-child(even),
    table.table > tbody > tr.selectedTableRow {
      background-color: var(--color-table) !important;
    }

    table.table > tbody > tr:hover,
    table.table-striped > tbody > tr:hover,
    table.zebra > tbody > tr:hover {
      background-color: #ccff66 !important;
    }

    @media (hover: none) and (pointer: coarse) {
      table.table > tbody > tr:hover,
      table.table-striped > tbody > tr:hover,
      table.zebra > tbody > tr:hover,
      table.table > tbody > tr:active,
      table.table-striped > tbody > tr:active,
      table.zebra > tbody > tr:active {
        background-color: var(--color-table) !important;
      }

      a:not(.btn):not(.tp-btn):not([role="button"]):not(.nav-pills a):active,
      a:not(.btn):not(.tp-btn):not([role="button"]):not(.nav-pills a):focus {
        color: #0369a1 !important;
        opacity: 1;
        text-decoration: underline;
        text-decoration-thickness: 2px;
        text-underline-offset: 3px;
      }
    }

    .tp-footer {
      background: var(--color-footer);
      color: var(--color-footer-text);
      border-top: 1px solid rgba(255,255,255,0.12);
    }

    .tp-footer a {
      color: var(--color-footer-text) !important;
    }

    .tp-status-pending,
    .tp-status-completed,
    .tp-status-not-started {
      color: #1f2937 !important;
    }

    .tp-btn {
      border-radius: 9999px;
      font-weight: 600;
      transition: all 0.2s ease;
    }

    .tp-btn[class*="bg-slate-900"],
    .btn-info,
    .btn-primary,
    .btn-success,
    .btn-danger,
    .btn-default {
      background-color: var(--color-accent) !important;
      border-color: var(--color-accent) !important;
      color: var(--color-accent-text) !important;
    }

    .tp-btn[class*="bg-slate-900"]:hover,
    .btn-info:hover,
    .btn-primary:hover,
    .btn-success:hover,
    .btn-danger:hover,
    .btn-default:hover {
      filter: brightness(0.9);
    }

    .tp-btn:hover {
      transform: translateY(-1px);
    }

    .tp-nav a.cupdir-view-link {
      align-items: center;
      background: #ffffff;
      border: 1px solid #cbd5e1;
      border-radius: 9999px;
      color: #1e293b !important;
      display: inline-flex;
      font-weight: 700;
      justify-content: center;
      padding: 0.7rem 1.1rem;
      text-decoration: none !important;
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .tp-nav a.cupdir-view-link:hover {
      background: #f1f5f9;
      border-color: #94a3b8;
      color: #0f172a !important;
      box-shadow: 0 10px 20px rgba(15, 23, 42, 0.14);
      transform: translateY(-1px);
    }

    .tp-nav a.cupdir-view-link.is-active {
      background: #0f172a;
      border-color: #0f172a;
      color: #ffffff !important;
    }

    .tp-nav a.cupdir-view-link.is-active:hover {
      background: #0f172a;
      border-color: #0f172a;
      color: #ffffff !important;
    }

    .cupdir-view-link-mobile {
      display: inline-flex;
    }

    .homewide .jumbotron .btn,
    .homewide .jumbotron .btn:visited {
      background-color: var(--color-accent) !important;
      border-color: var(--color-accent) !important;
      color: var(--color-accent-text) !important;
    }

    .tp-status {
      display: inline-flex;
      align-items: center;
      min-height: 1.75rem;
      padding: .3rem .7rem;
      border: 1px solid transparent;
      border-radius: 9999px;
      font-size: .78rem;
      font-weight: 700;
      line-height: 1;
      white-space: nowrap;
      vertical-align: middle;
    }

    .tp-status-pending {
      border-color: #fed7aa;
      background: #fff7ed;
      color: #c2410c;
    }

    .tp-status-completed {
      border-color: #bbf7d0;
      background: #f0fdf4;
      color: #15803d;
    }

    .tp-status-not-started {
      border-color: #cbd5e1;
      background: #f8fafc;
      color: #475569;
    }

    .row {
      display: flex;
      flex-wrap: wrap;
      margin-left: -0.75rem;
      margin-right: -0.75rem;
    }

    [class^="col-"],
    [class*=" col-"] {
      min-height: 1px;
      padding-left: 0.75rem;
      padding-right: 0.75rem;
      position: relative;
      width: 100%;
    }

    .col-xs-6 { width: 50%; }
    .col-md-2 { width: 16.666667%; }
    .col-md-4 { width: 33.333333%; }
    .col-md-8 { width: 66.666667%; }
    .col-md-10 { width: 83.333333%; }
    .col-md-12,
    .col-sm-12 { width: 100%; }

    .nav {
      list-style: none;
      margin-bottom: 0;
      padding-left: 0;
    }

    .nav > li {
      display: block;
      position: relative;
    }

    .nav > li > a {
      display: block;
      padding: 0.65rem 0.9rem;
      text-decoration: none;
    }

    .tab-pane { display: none; }
    .tab-pane.active { display: block; }

    .dropdown-menu {
      display: none !important;
      list-style: none;
      margin: 0.5rem 0 0;
      min-width: 13rem;
      padding: 0.5rem;
      position: absolute;
      z-index: 60;
    }

    .dropdown-menu.is-open,
    .open > .dropdown-menu { display: block !important; }

    .dropdown-menu > li > a {
      display: block;
      padding: 0.6rem 0.8rem;
      text-decoration: none;
    }

    .btn {
      background: var(--color-accent);
      border: 0;
      border-radius: 9999px;
      color: var(--color-accent-text);
      cursor: pointer;
      display: inline-block;
      font-weight: 600;
      padding: 0.65rem 1rem;
      text-align: center;
      text-decoration: none;
    }

    .btn:hover { color: #fff; }

    @media (max-width: 767px) {
      .col-md-2,
      .col-md-4,
      .col-md-8,
      .col-md-10,
      .col-md-12,
      .col-sm-12 { width: 100%; }

      .col-xs-6 { width: 50%; }
    }

    @media (max-width: 767px) {
      body {
        padding-top: 0 !important;
      }
    }
  </style>

  <link href="assets/css/<?php echo $GLOBALS['layout'] >= 2 ? "simplecup" : "fullcup" ?>.css" rel="stylesheet">

  <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.0/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.14.0/jquery-ui.js"></script>
  <script defer src="assets/js/tp-ui.js"></script>

