# PostHog for WP - PostHog.com Integration

A simple, lightweight WordPress plugin for integrating PostHog analytics into your WordPress website.

## Description

PostHog is an open-source product analytics platform that helps you understand user behavior. This plugin makes it easy to add PostHog tracking to your WordPress site without editing theme files.

**Features:**
- ✅ Easy setup - just paste your PostHog snippet code
- ✅ Enable/disable tracking with one click
- ✅ Lightweight and fast
- ✅ Compatible with WordPress 6.7+
- ✅ No coding required

## Installation

### From WordPress.org (Recommended)

1. Go to your WordPress admin panel
2. Navigate to **Plugins** → **Add New**
3. Search for "PostHog for WP"
4. Click **Install Now**, then **Activate**
5. Go to **Settings** → **PostHog Settings**
6. Paste your PostHog snippet code and enable tracking

### From GitHub (Direct Download)

1. Download the latest release or clone this repository
2. Upload the entire folder to `/wp-content/plugins/`
3. Activate the plugin through the WordPress admin panel
4. Go to **Settings** → **PostHog Settings**
5. Enter your PostHog snippet code

## Configuration

1. Sign in to [PostHog](https://app.posthog.com/)
2. Go to **Project** → **Settings** → **Web** or visit the [settings page](https://app.posthog.com/ingestion/web)
3. Copy your snippet code
4. Paste it into the plugin settings
5. Enable tracking and save

## Development

This plugin is maintained on GitHub and distributed through WordPress.org.

### Project Structure

```
PostHog-for-WP-PostHog.com-Integration/
├── posthog-com-integration.php   # Main plugin file
├── README.txt                     # WordPress plugin readme
├── README.md                      # GitHub readme (this file)
├── LICENSE.txt                    # GPL v2 license
├── uninstall.php                  # Uninstall script
└── assets/                        # Plugin assets (icons, banners, screenshots)
```

## Requirements

- **WordPress:** 5.0 or higher
- **PHP:** 7.4 or higher
- **PostHog Account:** Free account at [posthog.com](https://posthog.com)

## Frequently Asked Questions

**Is this the official PostHog plugin?**
No, this is a community-maintained plugin that integrates with PostHog.com.

**Does this work with WooCommerce?**
Yes, the PostHog snippet will track all pages including WooCommerce pages. WooCommerce-specific event tracking will be added in a future update.

**Is it compatible with caching plugins?**
Yes, the snippet is added to the HTML output and works with most caching solutions.

## Changelog

### 1.4.0 (2025-12-05)
- ✅ Updated: WordPress 6.9 compatibility
- ✅ Updated: PHP 7.4 minimum requirement
- ✅ Improved: Security with proper input sanitization and validation
- ✅ Improved: Settings API with proper sanitize callbacks
- ✅ Improved: Code quality following WordPress coding standards
- ✅ Improved: Accessibility with ARIA labels and proper form structure
- ✅ Fixed: Deprecated functions replaced with modern equivalents
- ✅ Fixed: Capability checks now use `manage_options` instead of administrator role
- ✅ Fixed: Used WordPress helper functions (`checked()`, `esc_textarea()`, etc.)
- ✅ Added: Comprehensive PHPDoc comments
- ✅ Added: Input validation for PostHog snippet
- ✅ Added: Better error messages and user guidance
- ✅ Added: SVN deployment workflow for maintainers

### 1.3.0
- Previous stable release

### 1.0.0
- Initial public release

## License

This plugin is licensed under GPL v2 or later.

## Support

- **Issues:** [GitHub Issues](https://github.com/saad-malik-codes/PostHog-for-WP-PostHog.com-Integration/issues)
- **WordPress.org:** [Plugin Support Forum](https://wordpress.org/support/plugin/connect-wp-posthog-com-integration/)

## Author

Created and maintained by [Saad Malik](https://saad.codes/)
