<?php

declare(strict_types=1);

return [
    'summary' => [
        'entity' => 'Kinetic Gain LLC',
        'operatorPosture' => 'Consent-safe lifecycle operation',
        'leadRecommendation' => 'Pause the renewal-reminder export until the preference-center wording, CRM suppression sync, and webinar fallback segment are back in the same approved journey packet.',
    ],
    'memberLanes' => [
        [
            'journey' => 'Premium renewal reminder',
            'channel' => 'WordPress form -> CRM -> lifecycle email',
            'owner' => 'Lifecycle marketing',
            'package' => 'Renewal reminder packet',
            'proof' => 'Renewal language was reviewed, but the latest preference-center copy never reached the CRM suppression export.',
            'risk' => 'Members can receive reminder messaging after changing renewal preferences.',
            'nextAction' => 'Sync suppression export mapping and republish the approved preference-center fragment.',
            'status' => 'blocked',
        ],
        [
            'journey' => 'Editorial member digest',
            'channel' => 'WordPress digest signup -> ESP list',
            'owner' => 'Audience operations',
            'package' => 'Digest opt-in fragment',
            'proof' => 'Digest signup language matches the approved fragment, but taxonomy-based audience routing is still missing one locale fallback.',
            'risk' => 'Digest sends can over-target members in a locale-specific branch.',
            'nextAction' => 'Add locale fallback review and rerun the ESP export evidence check.',
            'status' => 'watch',
        ],
        [
            'journey' => 'Trial onboarding sequence',
            'channel' => 'WordPress pricing page -> onboarding webhook',
            'owner' => 'Growth engineering',
            'package' => 'Onboarding promise packet',
            'proof' => 'Consent anchor, webhook audit, and onboarding copy are all aligned.',
            'risk' => 'Low. Current flow is review-safe.',
            'nextAction' => 'Monitor only.',
            'status' => 'healthy',
        ],
        [
            'journey' => 'Webinar follow-up nurture',
            'channel' => 'Event registration form -> community audience',
            'owner' => 'Community marketing',
            'package' => 'Event follow-up packet',
            'proof' => 'Registration copy is approved, but the replay follow-up segment still includes legacy attendees with older consent terms.',
            'risk' => 'Replay campaign can mix current and historical consent scopes.',
            'nextAction' => 'Split replay cohort by consent version and regenerate the export packet.',
            'status' => 'watch',
        ],
        [
            'journey' => 'Winback preference reset',
            'channel' => 'WordPress preference center -> re-engagement list',
            'owner' => 'RevOps',
            'package' => 'Winback suppression packet',
            'proof' => 'Preference reset form and audience export are aligned to the same reviewed suppression rule.',
            'risk' => 'Low. Suppression-safe.',
            'nextAction' => 'Monitor only.',
            'status' => 'healthy',
        ],
    ],
    'consentEvidence' => [
        [
            'artifact' => 'Preference-center copy fragment',
            'purpose' => 'Canonical language for member consent changes, frequency preferences, and lifecycle eligibility.',
            'owner' => 'Compliance + lifecycle',
            'anchor' => '/docs/member-consent-language-v4',
            'status' => 'approved',
        ],
        [
            'artifact' => 'CRM suppression export audit',
            'purpose' => 'Proof that WordPress preference changes are reflected in audience exports before send time.',
            'owner' => 'RevOps',
            'anchor' => '/evidence/suppression-export-audit',
            'status' => 'needs-refresh',
        ],
        [
            'artifact' => 'Webinar replay cohort review',
            'purpose' => 'Shows which attendees are eligible for replay nurture under the current consent model.',
            'owner' => 'Community ops',
            'anchor' => '/evidence/webinar-replay-cohort',
            'status' => 'watch',
        ],
        [
            'artifact' => 'Lifecycle approval pack',
            'purpose' => 'Review packet tying audience promise language, ESP routing, and member-facing copy into one release path.',
            'owner' => 'Lifecycle marketing',
            'anchor' => '/evidence/lifecycle-approval-pack',
            'status' => 'approved',
        ],
    ],
    'verificationGates' => [
        [
            'gate' => 'WordPress opt-in fragment matches the reviewed source',
            'detail' => 'Block release if the live form copy drifts from the approved member-consent fragment.',
            'status' => 'approved',
        ],
        [
            'gate' => 'CRM suppression export reflects the latest preference state',
            'detail' => 'Block sends when suppression mappings lag behind the preference-center source.',
            'status' => 'blocked',
        ],
        [
            'gate' => 'ESP cohort segmentation matches the approved consent scope',
            'detail' => 'Keep event, renewal, and winback cohorts from mixing historical and current consent terms.',
            'status' => 'watch',
        ],
        [
            'gate' => 'Support and community macros match lifecycle promises',
            'detail' => 'Ensure support-facing member guidance does not contradict the public consent and frequency model.',
            'status' => 'approved',
        ],
    ],
];
