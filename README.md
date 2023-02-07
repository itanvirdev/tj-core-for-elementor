# === TJ Core for Elementor ===

**Contributors:** [ThemeJunction](https://themejunction.net/), [SecureSofts](https://securesofts.com/), [akibslab](https://github.com/akibslab/), [itanvirdev](https://github.com/itanvirdev/)

**Tags:** elementor, elements, addons, elementor addons, elementor widget, elementor form, woocommerce elementor, page builder, builder, visual editor, wordpress page builder

**Requires at least:** 5.0

**Tested up to:** 6.1

**Requires PHP:** 7.0

**Stable tag:** 5.5.3

**License:** GPLv3

**License URI:** https://opensource.org/licenses/GPL-3.0

The [TJ Core](https://themejunction.net/) plugin you install after Elementor! Packed with 40+ stunning free elements including Advanced Data Table, Event Calendar, Filterable Gallery, WooCommerce, and many more.

Enhance your [Elementor](https://wordpress.org/plugins/elementor/) page building experience with 90+ creative elements and extensions. Add powers to your page builder using our easy-to-use elements those were designed to make your next WordPress page and posts design easier and prettier than ever before.

### Plugin Structure:

```
assets/
      /css
      /img
      /js

controls/

include/
      /elementor
      /icons
      /template
      /widgets

languages/

page-settings/

index.php
plugin.php
tj-core.php
```

- `assets` directory - holds plugin JavaScript and CSS assets
  - `/css` directory - Holds plugin CSS Files
  - `/img` directory - Holds plugin images
  - `/js` directory - Holds plugin Javascript Files
- `controls` directory - Holds Plugin custom controls
- `include` directory - Holds Plugin custom widgets and function files
- `languages` directory - Holds Plugin language files
  - `/elementor` directory - Holds plugin custom elementor widgets
  - `/icons` directory - Holds plugin custom icon fonts
  - `/template` directory - Holds single cpts template
  - `/widgets` directory - Holds plugin custom widgets
    - `/allow-svg.php` - Holds svg support function
    - `/common-functions.php` - Holds plugin common functions
- `page-settings` directory - Holds Plugin page settings
- `index.php` - Prevent direct access to directories
- `plugin.php` - The actual Plugin file/Class.
- `tj-core.php` - Main plugin file, used as a loader if plugin minimum requirements are met.

For more documentation please see [Elementor Developers Resource](https://developers.elementor.com/creating-an-extension-for-elementor/).
