<?php

declare(strict_types=1);

require __DIR__ . '/../src/Services/MemberJourneyConsentKitService.php';

$service = new WordpressMemberJourneyConsentKit\Services\MemberJourneyConsentKitService();
$summary = $service->summary();

echo "Product: WordPress Member Journey Consent Kit\n";
echo "Tracked journeys: {$summary['journeyCount']}\n";
echo "Healthy journeys: {$summary['healthyCount']}\n";
echo "Watch journeys: {$summary['watchCount']}\n";
echo "Blocked journeys: {$summary['blockedCount']}\n";
echo "Lead recommendation: {$summary['leadRecommendation']}\n";
