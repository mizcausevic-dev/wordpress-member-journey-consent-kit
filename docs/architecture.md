# Architecture

The WordPress Member Journey Consent Kit has two layers:

1. **WordPress plugin primitive**
   - shortcode for a consent snapshot
   - REST endpoint for machine-readable lifecycle consent state

2. **Static operator surface**
   - prerendered HTML routes for overview, member-lane, consent evidence, verification, and docs
   - generated API JSON snapshots for summary, journey lanes, evidence, and verification gates

## Purpose

The plugin demonstrates how reviewed member-journey consent state can be exposed from WordPress. The static bundle demonstrates how that same state can be shaped into a buyer-readable operator surface for public portfolio proof.
