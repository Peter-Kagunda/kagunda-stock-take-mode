=== Stock Take Mode for WooCommerce ===
Contributors: kagunda
Tags: woocommerce, stock, inventory, maintenance, waitlist
Requires at least: 6.0
Tested up to: 7.1
Requires PHP: 7.4
Requires Plugins: woocommerce
Stable tag: 1.0.1
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Pause purchasing on your WooCommerce store during stock counts, with a countdown banner, waitlist capture, and automatic re-open notifications.

== Description ==

Stock Take Mode for WooCommerce lets store owners temporarily pause purchasing across the whole store, or on specific products, while they run an inventory count, perform maintenance, or run a seasonal stock-take.

Customers see a clear banner explaining what is happening, can leave their email to be told when you re-open, and staff can keep working as normal.

= Features =

* **One-click start and stop:** A status card at the top of the settings screen shows whether Stock Take Mode is active, scheduled or off, with "Start now" and "Stop now" buttons. You can also turn it off from the admin toolbar.
* **Schedule or manual:** Set a start and end time in your store's timezone, or leave them blank and switch it on and off yourself. Quick "ends in 1 hour / 4 hours / 1 day / 3 days" buttons make short counts easy.
* **Product & category exceptions:** Keep specific products, or entire categories, purchasable while everything else is paused.
* **Role bypass:** Let administrators, shop managers, or any other role keep shopping normally.
* **Preview as customer:** See exactly what shoppers see without logging out.
* **Countdown banner:** A banner with a live countdown to your re-open time. Choose a color preset or your own colors, place it at the top (sticky or not) or bottom of the screen, and show it on every page or only on shop pages. A live preview updates as you type.
* **Waitlist capture:** Visitors can leave their email to be notified when the store re-opens. Includes spam protection and a privacy note.
* **Waitlist management:** Search, remove individual subscribers, export to CSV, or email everyone on demand.
* **Automatic re-open broadcast:** Optionally email every subscriber as soon as stock-take mode ends. Emails are sent in small background batches, so large lists never slow down your store.
* **Works with block and classic checkout:** Purchasing is blocked for classic add-to-cart, AJAX add-to-cart, the Cart and Checkout blocks and the Store API.
* **Admin bar indicator and dashboard widget:** See the current status and blocked-attempt count at a glance.
* **Settings import/export:** Download your configuration as JSON to back it up or copy it to another store.
* **WooCommerce log integration:** Key events are recorded under WooCommerce > Status > Logs for troubleshooting.
* **Privacy tools:** Waitlist emails are included in WordPress's personal data export and erase tools.
* **Accessible:** The banner and waitlist form use proper labels and live regions, and respect reduced-motion preferences.

= Developer hooks =

* `kagstm_is_window_active` (filter): override whether the window is considered open.
* `kagstm_message` (filter): change the customer-facing message.
* `kagstm_show_banner` (filter): control where the banner is shown.
* `kagstm_capability` (filter): change the capability required to manage the plugin (default `manage_options`).
* `kagstm_broadcast_batch_size`, `kagstm_waitlist_max`, `kagstm_waitlist_rate_limit` (filters): tune the waitlist and broadcast.
* `kagstm_started`, `kagstm_ended`, `kagstm_waitlist_subscribed` (actions).

== Installation ==

1. Make sure WooCommerce is installed and active.
2. Install the plugin from the WordPress.org plugin directory, or upload the plugin ZIP file under Plugins > Add New > Upload Plugin.
3. Activate the plugin.
4. Go to WooCommerce > Stock Take Mode to configure it.

== Configuration ==

* **Rules:** Turn the system on/off, set a start/end window, choose bypass roles, and set product/category exceptions.
* **Design & Engagement:** Customize the banner colors, position and message, the add-to-cart button behavior, the waitlist form and your re-open email.
* **Waitlist:** View, search, remove and export subscriber emails, or email them on demand.
* **Import / Export:** Download or upload your configuration as a JSON file.

== Frequently Asked Questions ==

= Does this require WooCommerce? =

Yes. WooCommerce must be installed and active.

= I am an administrator and I don't see the banner. Is it broken? =

No. Administrators and shop managers bypass restrictions by default so you can keep working. Use the "Preview as customer" button on the settings screen, open the site in a private window, or remove your role from the Bypass Roles list.

= Does it work with the block-based Cart and Checkout? =

Yes. Restricted products cannot be added through the Store API, and checkout is refused while restricted items are in the cart.

= My banner does not appear or disappear at the right time. =

If you use a page caching plugin or a CDN, clear the cache after you start or stop Stock Take Mode, or exclude the shop pages from caching. The restrictions themselves are always enforced on the server.

= Does this plugin collect personal data? =

Only if you enable the waitlist. Visitors who choose to join enter their email address, which is stored with the sign-up time in your own site's database. It is used only for the re-open email and deleted after that email is sent (or when you remove it). Nothing is sent to third-party services. The plugin adds suggested text for your privacy policy page and works with WordPress's personal data export and erase tools.

= Will my settings be kept if I update from an earlier build? =

Yes. Settings are kept across updates. If you previously used this plugin under an earlier working name, it performs a one-time, automatic migration of your saved settings.

= Can I add custom CSS or JavaScript? =

Not from the settings screen. To keep the plugin secure, it does not accept arbitrary CSS, JavaScript, or PHP from settings. Banner appearance is controlled through the provided colors, presets and position options. Developers can use the filters above or style the `.kagstm-top-banner-wrapper` class from their theme.

= Can shop managers use it? =

By default only users with the `manage_options` capability can change settings. Shop managers bypass restrictions and can be given access with the `kagstm_capability` filter.

== Screenshots ==

1. **Storefront banner:** A sticky banner with a live countdown and a waitlist form. Restricted products show a clear label, while excepted products stay purchasable.
2. **Rules:** A status card with one-click start and stop, plus scheduling, bypass roles and product or category exceptions.
3. **Design & Engagement:** Color presets, live banner preview, position and scope options, waitlist form and re-open email settings.
4. **Waitlist:** Search, remove, export or email everyone who asked to be notified.
5. **Import & Export:** Back up your configuration or move it to another store as a JSON file.
6. **Dashboard widget and admin bar:** See the current status and blocked attempts at a glance, and turn Stock Take Mode off from the toolbar.
7. **Mobile storefront:** The banner and waitlist form adapt to small screens.

== Changelog ==

= 1.0.1 =
* Renamed the display name to "Stock Take Mode for WooCommerce" (the plugin slug is unchanged).
* New: status card with one-click Start now / Stop now, and a "Turn off" link in the admin toolbar.
* New: "Preview as customer" button to see the restricted store without logging out.
* New: banner color presets, live preview, position (sticky top, top, bottom) and scope (all pages or shop pages only) options.
* New: quick "ends in" buttons for scheduling short stock takes.
* New: waitlist search, per-subscriber removal, clear list and "email everyone now".
* New: waitlist privacy note, and integration with WordPress personal data export/erase tools and privacy policy text.
* New: countdown uses the server clock and reloads the page shortly after it reaches zero.
* New: developer filters and actions for message, banner, capability, window state and waitlist limits.
* Improved: re-open emails are sent in small background batches instead of during a visitor's page load.
* Improved: start and end notifications now fire at the scheduled time even when nobody is browsing the store.
* Improved: purchasing is also blocked in the Cart and Checkout blocks (Store API) and on classic checkout submissions.
* Improved: banner and waitlist form accessibility (labels, live regions, keyboard focus, reduced motion).
* Improved: modern admin interface with a dashboard-style header and a responsive layout.
* Improved: bundled select2 replaced by the copy WooCommerce already ships.
* Fixed: an administrator browsing the store during a stock take could mark it as "ended" and email the whole waitlist too early.
* Fixed: the admin bar indicator and dashboard widget showed the wrong status for administrators.
* Fixed: in "hide buttons" mode, excepted products lost their add-to-cart button.
* Fixed: waitlist sign-ups are now rate limited, protected with a honeypot and capped in size, and are no longer autoloaded on every request.
* Fixed: CSV export now neutralises spreadsheet formulas.
* Fixed: imported and saved settings are validated (dates, colors, roles, choices) and imports are limited to 256 KB of JSON.
* Fixed: uninstall now also removes transients and scheduled events.

= 1.0.0 =
* Initial public release.

== Upgrade Notice ==

= 1.0.1 =
Fixes early waitlist emails triggered by staff browsing during a stock take, and adds one-click start/stop, banner presets, live preview and waitlist tools.
