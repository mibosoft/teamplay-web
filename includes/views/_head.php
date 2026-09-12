<!DOCTYPE html>
<html lang="<?php echo htmlspecialchars($GLOBALS['lang'] ?? 'en', ENT_QUOTES, 'UTF-8'); ?>">

<head>
  <title><?php echo formatTitle($title) ?></title>

  <base href="<?php $requestHost = parse_url('http://' . ($_SERVER['HTTP_HOST'] ?? ''), PHP_URL_HOST); echo (DEBUG || in_array($requestHost, array('localhost', '127.0.0.1', '0.0.0.0'), true)) ? '' : 'https://teamplay.nu/cup/' ?>" />

  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="Tournament information and results" />
  <meta http-equiv="Content-Security-Policy" content="script-src 'self' 'unsafe-eval' 'unsafe-inline' https://teamplay.nu https://teamplaycup.se https://cdn.datatables.net https://maps.googleapis.com https://maps.gstatic.com https://*.googleapis.com https://apis.google.com https://www.googletagmanager.com https://ajax.googleapis.com https://cdn.jsdelivr.net https://code.jquery.com https://www.gstatic.com https://*.gstatic.com https://cdn.tailwindcss.com https://unpkg.com">

  <link rel="shortcut icon" href="assets/images/favicon.ico" type="image/x-icon">
  <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">

  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          boxShadow: {
            soft: '0 12px 30px rgba(15, 23, 42, 0.12)'
          }
        }
      }
    };
  </script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.10/dist/cdn.min.js"></script>

  <?php echo $settings[0]->memo3 ?>

  <style>
    :root {
      --color-bg-primary: <?php echo htmlspecialchars((!empty($settings[0]->string26) ? $settings[0]->string26 : '#0f172a'), ENT_QUOTES, 'UTF-8'); ?>;
      --color-text-main: <?php echo htmlspecialchars((!empty($settings[0]->string12) ? $settings[0]->string12 : '#1f2937'), ENT_QUOTES, 'UTF-8'); ?>;
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
      color: var(--color-text-main);
      background: linear-gradient(180deg, rgba(255,255,255,0.74), rgba(241,245,249,0.9));
    }

    body.cup-with-wallpaper {
      isolation: isolate;
      position: relative;
    }

    body.cup-with-wallpaper::before {
      background: url("<?php echo htmlspecialchars($GLOBALS['baseUrl'] . ($_GET['home'] ?? '') . '/' . $settings[0]->pic_name_16, ENT_QUOTES, 'UTF-8') ?>") no-repeat center center;
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
      background: rgba(255,255,255,0.75);
      backdrop-filter: blur(10px);
      -webkit-backdrop-filter: blur(10px);
      border: 1px solid rgba(148,163,184,0.22);
      box-shadow: var(--shadow-soft);
    }

    .tp-nav {
      position: sticky;
      top: 0;
      z-index: 1000;
      background: rgba(255,255,255,0.85);
      border-bottom: 1px solid var(--color-divider);
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
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
      background: rgba(255,255,255,0.9);
      border: 1px solid rgba(148,163,184,0.18);
      border-radius: 1rem;
      box-shadow: var(--shadow-soft);
    }

    .tp-footer {
      background: var(--color-bg-primary);
      color: rgba(255,255,255,0.92);
      border-top: 1px solid rgba(255,255,255,0.12);
    }

    .tp-footer a {
      color: rgba(255,255,255,0.9);
    }

    .tp-btn {
      border-radius: 9999px;
      font-weight: 600;
      transition: all 0.2s ease;
    }

    .tp-btn:hover {
      transform: translateY(-1px);
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
      background: #0f172a;
      border: 0;
      border-radius: 9999px;
      color: #fff;
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

