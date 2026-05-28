<?php

declare(strict_types=1);

use WordpressMemberJourneyConsentKit\Services\MemberJourneyConsentKitService;

require __DIR__ . '/../src/Services/MemberJourneyConsentKitService.php';
require __DIR__ . '/../src/Views/render.php';

$service = new MemberJourneyConsentKitService();
$path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';

if (str_starts_with($path, '/api/')) {
    header('Content-Type: application/json; charset=utf-8');

    $payload = match ($path) {
        '/api/dashboard/summary' => $service->summary(),
        '/api/member-lane' => $service->memberLanes(),
        '/api/consent-evidence' => $service->consentEvidence(),
        '/api/verification' => $service->verificationGates(),
        '/api/sample' => $service->payload(),
        default => ['error' => 'Not found'],
    };

    if ($payload === ['error' => 'Not found']) {
        http_response_code(404);
    }

    echo json_encode($payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    return;
}

$html = match ($path) {
    '/' => WordpressMemberJourneyConsentKit\Views\render_overview(),
    '/member-lane' => WordpressMemberJourneyConsentKit\Views\render_member_lane(),
    '/consent-evidence' => WordpressMemberJourneyConsentKit\Views\render_consent_evidence(),
    '/verification' => WordpressMemberJourneyConsentKit\Views\render_verification(),
    '/docs' => WordpressMemberJourneyConsentKit\Views\render_docs(),
    default => null,
};

if ($html === null) {
    http_response_code(404);
    echo 'Not found';
    return;
}

header('Content-Type: text/html; charset=utf-8');
echo $html;
