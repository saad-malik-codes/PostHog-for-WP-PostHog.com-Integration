=== PostHog for WP - PostHog.com Integration ===
Contributors: Saad Malik
Tags: PostHog, posthog.com, Post Hog, PostHog integration, PostHog WordPress integration
Requires at least: 5.0
Tested up to: 6.9
Stable tag: 1.4.0
Requires PHP: 7.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

PostHog for WP - PostHog.com Integration is a simple, lightweight solution for inserting your PostHog.com Snippet code to your WordPress website.

== Description ==

PostHog for WP - PostHog.com Integration is a simple, lightweight solution for inserting your PostHog.com Snippet code to your WordPress website.

PostHog is an open-source product analytics platform that helps you understand user behavior. This plugin makes it easy to add PostHog tracking to your WordPress site without editing theme files.

**Features:**

* Easy setup - just paste your PostHog snippet code
* Enable/disable tracking with one click
* Lightweight and fast
* Compatible with latest WordPress version
* No coding required

== Installation ==

1. Upload `posthog-for-wp-posthog-com-integration` to the `/wp-content/plugins/` directory or install directly through WordPress
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to Settings → PostHog Settings
4. Paste your PostHog snippet code from your PostHog project settings
5. Enable the tracking and save

== Frequently Asked Questions ==

= Is this the official PostHog plugin? =

No, this is a community-maintained plugin that integrates with PostHog.com.

= Where can I find out more about PostHog? =

For more info go to the official site: [PostHog](https://www.posthog.com/ "posthog.com") 

= Where can I get the code snippet from? =

Once signed in to PostHog, copy your snippet code from "Project" → "Settings" → "Web" or visit the [Settings page](https://app.posthog.com/ingestion/web "posthog.com") 

= Does this work with WooCommerce? =

Yes, the PostHog snippet will track all pages including WooCommerce pages. WooCommerce-specific event tracking will be added in a future update.

== Screenshots ==

1. PostHog Settings menu
2. Plugin Settings

== Changelog ==

= 1.4.0 =
* Updated: WordPress 6.9 compatibility
* Updated: PHP 7.4 minimum requirement
* Improved: Security with proper input sanitization and validation
* Improved: Settings API with proper sanitize callbacks
* Improved: Code quality following WordPress coding standards
* Improved: Accessibility with ARIA labels and proper form structure
* Fixed: Deprecated functions replaced with modern equivalents
* Fixed: Capability checks now use manage_options instead of administrator role
* Fixed: Used WordPress helper functions (checked(), esc_textarea(), etc.)
* Added: Comprehensive PHPDoc comments
* Added: Input validation for PostHog snippet
* Added: Better error messages and user guidance

= 1.3.0 =
* Previous stable release

= 1.0.0 =
* Initial public release
