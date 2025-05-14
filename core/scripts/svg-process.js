import fs from 'fs/promises';
import path from 'path';
import { fileURLToPath } from 'url';
import { optimize } from 'svgo';
import SVGSpriter from 'svg-sprite';

// Get current directory
const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);
const rootDir = path.resolve(__dirname, '../../');

// Directories
const svgIconsDir = path.join(rootDir, 'src/images/svg/icons');
const spriteOutputPath = path.join(rootDir, 'src/images/sprite.svg');
const assetsImagesDir = path.join(rootDir, 'assets/images');
const templatePath = path.join(__dirname, 'sprite-template.svg');

// Create directories if they don’t exist
await fs.mkdir(assetsImagesDir, { recursive: true });
await fs.mkdir(path.dirname(spriteOutputPath), { recursive: true });

// Write sprite template to file
const spriteTemplateContent = `
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="display: none;">
  <% sprites.forEach(function(sprite) { %>
    <%= sprite.contents %>
  <% }); %>
</svg>
`;
await fs.writeFile(templatePath, spriteTemplateContent);

// SVG Sprite configuration
const spriter = new SVGSpriter({
  dest: assetsImagesDir,
  mode: {
    symbol: {
      sprite: 'sprite.svg',
      example: false,
      inline: false,
      prefix: 'icon-%s', // IDs as 'icon-[name]'
      render: {
        svg: {
          template: templatePath,
        },
      },
    },
  },
});

// Log function
const log = (message) => {
  const timestamp = new Date().toLocaleTimeString();
  console.log(`[${timestamp}] ${message}`);
};

// SVGO configuration
const svgoConfig = {
  plugins: [
    { name: 'removeViewBox', active: false },
    { name: 'removeUnusedNS', active: true },
    { name: 'cleanupAttrs', active: true },
    { name: 'removeComments', active: true },
    {
      name: 'removeAttrs',
      params: {
        attrs: ['fill', 'style', 'width', 'height', 'stroke'], // Remove stroke
      },
    },
    {
      name: 'addAttributesToSVGElement', // Add stroke="currentColor" to paths
      params: {
        attributes: [
          {
            stroke: 'currentColor',
          },
        ],
        element: 'path', // Apply to <path> elements
      },
    },
  ],
};

// Optimize and generate sprite
const generateSprite = async () => {
  try {
    log('Processing SVG icons...');

    // Read SVG files
    const files = (await fs.readdir(svgIconsDir)).filter((file) => file.endsWith('.svg'));

    if (files.length === 0) {
      log('No SVG files found in src/images/svg/icons');
      return;
    }

    // Optimize each SVG and add to spriter
    for (const file of files) {
      const filePath = path.join(svgIconsDir, file);
      const fileName = path.basename(file, '.svg');
      const svgContent = await fs.readFile(filePath, 'utf-8');

      // Optimize SVG
      const { data: optimizedSvg } = optimize(svgContent, {
        path: filePath,
        ...svgoConfig,
      });
      log(`Optimized: ${file}`);

      // Add to sprite
      spriter.add(filePath, file, optimizedSvg);
    }

    // Compile sprite
    log('Generating SVG sprite...');
    await new Promise((resolve, reject) => {
      spriter.compile((error, result) => {
        if (error) {
          log(`Error generating sprite: ${error.message}`);
          reject(error);
          return;
        }

        // Write sprite to assets/images
        const spriteContent = result.symbol.sprite.contents.toString();
        fs.writeFile(path.join(assetsImagesDir, 'sprite.svg'), spriteContent)
          .then(() => {
            log('Sprite generated: assets/images/sprite.svg');
            resolve();
          })
          .catch(reject);
      });
    });

    // Copy to src/images for development
    await fs.copyFile(path.join(assetsImagesDir, 'sprite.svg'), spriteOutputPath);
    log('Sprite copied to src/images/sprite.svg');

    // Clean up template file
    await fs.unlink(templatePath).catch(() => log('Template file already removed'));

    log('SVG processing completed successfully! ✨');
  } catch (error) {
    log(`Error: ${error.message}`);
    process.exit(1);
  }
};

// Run
generateSprite();