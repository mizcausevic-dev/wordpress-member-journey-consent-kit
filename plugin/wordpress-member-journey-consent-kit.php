<?php
/**
 * Plugin Name: WordPress Member Journey Consent Kit
 * Plugin URI: https://members.kineticgain.com/
 * Description: Publishes member journey consent snapshots, preference evidence, and machine-readable lifecycle-governance payloads for WordPress sites.
 * Version: 0.1.0
 * Author: Kinetic Gain
 * License: AGPL-3.0-or-later
 * License URI: https://www.gnu.org/licenses/agpl-3.0.html
 */

declare(strict_types=1);

if (! defined('ABSPATH')) {
    exit;
}

if (! function_exists('kg_member_consent_snapshot_payload')) {
    /**
     * @return array<string, mixed>
     */
    function kg_member_consent_snapshot_payload(): array
    {
        return [
            'entity' => 'Kinetic Gain LLC',
            'kit' => 'WordPress Member Journey Consent Kit',
            'version' => '0.1.0',
            'updatedAt' => gmdate('c'),
            'journeys' => [
                'trial-onboarding',
                'premium-renewal-series',
                'editorial-member-digest',
                'webinar-follow-up',
                're-engagement-winback',
            ],
            'operatorNote' => 'Synthetic demonstration payload only. Review consent language, suppressions, and lifecycle policy before production use.',
        ];
    }
}

if (! function_exists('kg_render_member_consent_snapshot')) {
    function kg_render_member_consent_snapshot(): string
    {
        $payload = kg_member_consent_snapshot_payload();

        return '<pre class="kg-member-consent-snapshot">' . esc_html(wp_json_encode($payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)) . '</pre>';
    }
}

add_shortcode('kg_member_consent_snapshot', 'kg_render_member_consent_snapshot');

add_action('rest_api_init', static function (): void {
    register_rest_route(
        'kg-membership/v1',
        '/consent-snapshot',
        [
            'methods' => 'GET',
            'permission_callback' => '__return_true',
            'callback' => static function () {
                return rest_ensure_response(kg_member_consent_snapshot_payload());
            },
        ]
    );
});
