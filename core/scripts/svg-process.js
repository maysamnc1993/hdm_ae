import fs from 'fs';               // 👈 برای existsSync
import fsPromises from 'fs/promises'; // 👈 برای async ops
import path from 'path';
import { fileURLToPath } from 'url';
import { optimize } from 'svgo';
import SVGSpriter from 'svg-sprite';

// ==============================
// Resolve paths
// ==============================
const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);
const rootDir = path.resolve(__dirname, '../../');

// Directories
const svgIconsDir = path.join(rootDir, 'src/images/svg/icons');
const spriteOutputPath = path.join(rootDir, 'src/images/sprite.svg');
const assetsImagesDir = path.join(rootDir, 'assets/images');
const templatePath = path.join(__dirname, 'sprite-template.svg');

// ==============================
// Guard: skip if no icons folder
// ==============================
if (!fs.existsSync(svgIconsDir)) {
  console.log('⚠️ SVG icons folder not found, skipping svg process');
  process.exit(0);
}

// ==============================
// Ensure directories
// ==============================
await fsPromises.mkdir(assetsImagesDir, { recursive: true });
await fsPromises.mkdir(path.dirname(spriteOutputPath), { recursive: true });

// ==============================
// Sprite template
// ==============================
const spriteTemplateContent = `
<svg xmlns="http://www.w3.org/2000/svg" style="display:none">
  <% sprites.forEach(function(sprite){ %>
    <%= sprite.contents %>
  <% }); %>
</svg>
`;

await fsPromises.writeFile(templatePath, spriteTemplateContent);

// ==============================
// Sprite config
// ==============================
const spriter = new SVGSpriter({
  dest: assetsImagesDir,
  mode: {
    symbol: {
      sprite: 'sprite.svg',
      example: false,
      prefix: 'icon-%s',
      render: {
        svg: { template: templatePath },
      },
    },
  },
});

// ==============================
// Logger
// ==============================
const log = (msg) =>
  console.log(`[${new Date().toLocaleTimeString()}] ${msg}`);

// ==============================
// SVGO config
// ==============================
const svgoConfig = {
  plugins: [
    { name: 'removeViewBox', active: false },
    { name: 'removeComments', active: true },
    {
      name: 'removeAttrs',
      params: { attrs: ['fill', 'style', 'width', 'height'] },
    },
  ],
};

// ==============================
// Generate sprite
// ==============================
async function generateSprite() {
  try {
    log('Processing SVG icons...');

    const files = (await fsPromises.readdir(svgIconsDir)).filter(f =>
      f.endsWith('.svg')
    );

    if (!files.length) {
      log('No SVG icons found, skipping');
      return;
    }

    for (const file of files) {
      const filePath = path.join(svgIconsDir, file);
      const raw = await fsPromises.readFile(filePath, 'utf8');

      const { data } = optimize(raw, { path: filePath, ...svgoConfig });
      spriter.add(filePath, file, data);
      log(`Optimized: ${file}`);
    }

    await new Promise((resolve, reject) => {
      spriter.compile((err, result) => {
        if (err) return reject(err);

        fsPromises.writeFile(
          path.join(assetsImagesDir, 'sprite.svg'),
          result.symbol.sprite.contents
        ).then(resolve).catch(reject);
      });
    });

    await fsPromises.copyFile(
      path.join(assetsImagesDir, 'sprite.svg'),
      spriteOutputPath
    );

    await fsPromises.unlink(templatePath).catch(() => {});
    log('SVG sprite generated successfully ✅');
  } catch (e) {
    console.error('❌ SVG process failed:', e);
    process.exit(1);
  }
}

generateSprite();
