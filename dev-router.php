<?php
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ($path !== '/' && $path !== '/index.php' && preg_match('#^/([^/]+)/([^/]+)/?$#', $path, $matches)) {
    header('Location: /index.php?home=' . rawurlencode($matches[1] . '/' . $matches[2]) . '&layout=1', true, 302);
    exit;
}

if ($path === '/' || $path === '/index.php') {
    require __DIR__ . '/index.php';
    return true;
}

return false;
