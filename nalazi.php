<?php
declare(strict_types=1);

require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/layout.php';

$user = require_login();

$uploadMessage = '';
$uploadMessageType = '';
$reportsDir = __DIR__ . '/nalazi';
$reportsUrl = 'nalazi';

if (!is_dir($reportsDir)) {
    mkdir($reportsDir, 0777, true);
}

function safe_report_prefix(string $username): string
{
    $prefix = preg_replace('/[^a-zA-Z0-9_-]/', '_', strtolower($username));
    return trim($prefix ?: 'user', '_');
}

function format_file_size(int $bytes): string
{
    if ($bytes >= 1048576) {
        return number_format($bytes / 1048576, 2) . ' MB';
    }

    return number_format($bytes / 1024, 1) . ' KB';
}
