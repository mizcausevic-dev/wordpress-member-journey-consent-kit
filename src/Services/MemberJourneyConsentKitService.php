<?php

declare(strict_types=1);

namespace WordpressMemberJourneyConsentKit\Services;

final class MemberJourneyConsentKitService
{
    /** @var array<string, mixed> */
    private array $payload;

    public function __construct()
    {
        /** @var array<string, mixed> $payload */
        $payload = require __DIR__ . '/../Data/sample_member_journey_consent.php';
        $this->payload = $payload;
    }

    /**
     * @return array<string, mixed>
     */
    public function summary(): array
    {
        $lanes = $this->memberLanes();
        $blocked = array_values(array_filter($lanes, static fn(array $lane): bool => $lane['status'] === 'blocked'));
        $watch = array_values(array_filter($lanes, static fn(array $lane): bool => $lane['status'] === 'watch'));
        $healthy = array_values(array_filter($lanes, static fn(array $lane): bool => $lane['status'] === 'healthy'));

        return [
            'journeyCount' => count($lanes),
            'healthyCount' => count($healthy),
            'watchCount' => count($watch),
            'blockedCount' => count($blocked),
            'evidenceCount' => count($this->consentEvidence()),
            'operatorPosture' => (string) $this->payload['summary']['operatorPosture'],
            'leadRecommendation' => (string) $this->payload['summary']['leadRecommendation'],
        ];
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    public function memberLanes(): array
    {
        /** @var array<int, array<string, mixed>> $lanes */
        $lanes = $this->payload['memberLanes'];

        return $lanes;
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    public function consentEvidence(): array
    {
        /** @var array<int, array<string, mixed>> $evidence */
        $evidence = $this->payload['consentEvidence'];

        return $evidence;
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    public function verificationGates(): array
    {
        /** @var array<int, array<string, mixed>> $gates */
        $gates = $this->payload['verificationGates'];

        return $gates;
    }

    /**
     * @return array<string, mixed>
     */
    public function payload(): array
    {
        return [
            'product' => 'WordPress Member Journey Consent Kit',
            'purpose' => 'WordPress control plane for member onboarding, preference evidence, consent-safe exports, and release-safe lifecycle posture.',
            'routes' => [
                '/',
                '/member-lane',
                '/consent-evidence',
                '/verification',
                '/docs',
            ],
            'priorities' => [
                'Keep opt-in language, member promises, and audience exports in the same reviewed lane.',
                'Expose stale consent anchors before lifecycle, support, or RevOps discover them after send time.',
                'Make preference-center evidence and ESP audience segments point at the same canonical record.',
                'Turn WordPress member consent governance into a visible operator lane instead of a hidden plugin setting.',
            ],
            'entity' => (string) $this->payload['summary']['entity'],
        ];
    }
}
