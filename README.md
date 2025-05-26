# JTheme WordPress Theme

A modern WordPress theme built with Vite, TailwindCSS, SCSS, and TypeScript.

## Features

- 🚀 Modern development workflow with Vite
- 🎨 TailwindCSS for utility-first styling
- 📦 SCSS support for custom styling
- 🔥 TypeScript for type-safe JavaScript
- 🔄 Hot Module Replacement (HMR) in development
- 📱 Responsive design out of the box
- 🎯 WordPress Customizer integration
- 🌐 Internationalization ready

## Requirements

- WordPress 6.0 or higher
- PHP 7.4 or higher
- Node.js 16 or higher
- npm or yarn

## Installation

1. Clone this repository to your WordPress themes directory:
   ```bash
   cd wp-content/themes/
   git clone https://github.com/yourusername/jthem.git
   ```

2. Install dependencies:
   ```bash
   cd jthem
   npm install
   ```

3. Activate the theme in WordPress admin panel.

## Development

1. Add this to your `wp-config.php`:
   ```php
   define('WP_ENV', 'development');
   ```

2. Start the development server:
   ```bash
   npm run dev
   ```

3. Start developing! The development server will handle hot reloading of your assets.

## Building for Production

1. Build the assets:
   ```bash
   npm run build
   ```

2. Remove the `WP_ENV` constant from `wp-config.php` or set it to 'production'.

## Customization

### Theme Options

The theme includes several customization options available in the WordPress Customizer:

1. Primary Color
2. Footer Text
3. Social Media Links
   - Facebook
   - Twitter
   - Instagram
   - LinkedIn

### Templates

The theme includes the following templates:

- `index.php` - Main template file
- `header.php` - Header template
- `footer.php` - Footer template
- `template-parts/content.php` - Content template part
- And more...

### Styles

- Main styles are in `src/scss/style.scss`
- TailwindCSS utility classes are available
- Custom components can be added in the `@layer components` section

### Scripts

- Main TypeScript file is `src/ts/main.ts`
- Modular architecture for easy expansion
- Type-safe development with TypeScript

## Contributing

1. Fork the repository
2. Create your feature branch
3. Commit your changes
4. Push to the branch
5. Create a new Pull Request

## License

This theme is licensed under the GPL v2 or later.

## Credits

- Built with [Vite](https://vitejs.dev/)
- Styled with [TailwindCSS](https://tailwindcss.com/)
- TypeScript support 