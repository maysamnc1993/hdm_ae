 /**
 * Process SVGs into solid versions
 */
import fs from 'fs';
import path from 'path';
import { fileURLToPath } from 'url';

// Get current directory
const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);
const rootDir = path.resolve(__dirname, '../../');

// Directories
const svgDir = path.join(rootDir, 'src/images/svg');
const optimizedDir = path.join(svgDir, 'optimized');
const solidDir = path.join(svgDir, 'icons');

// Ensure directory exists
if (!fs.existsSync(solidDir)) {
  fs.mkdirSync(solidDir, { recursive: true });
}

// Process all SVGs in the optimized directory
const svgFiles = fs.readdirSync(optimizedDir)
  .filter(file => file.endsWith('.svg'));

console.log(`Processing ${svgFiles.length} SVG files for solid version...`);

// Process each file
svgFiles.forEach(filename => {
  const srcPath = path.join(optimizedDir, filename);
  const destPath = path.join(solidDir, filename);
  
  let svgContent = fs.readFileSync(srcPath, 'utf8');
  
  // Make it a solid version
  // 1. Add namespace if missing
  if (!svgContent.includes('xmlns=')) {
    svgContent = svgContent.replace('<svg', '<svg xmlns="http://www.w3.org/2000/svg"');
  }
  
  // 2. Set fill to currentColor
  if (svgContent.includes('fill="none"')) {
    svgContent = svgContent.replace('fill="none"', 'fill="currentColor"');
  } else if (!svgContent.includes('fill=')) {
    svgContent = svgContent.replace(/<svg([^>]*)>/i, '<svg$1 fill="currentColor">');
  }
  
  // 3. Replace all none fills with currentColor
  svgContent = svgContent.replace(/fill="none"/gi, 'fill="currentColor"');
  
  // 4. Remove stroke attributes for solid icons
  svgContent = svgContent.replace(/stroke="[^"]*"/gi, '');
  svgContent = svgContent.replace(/stroke-width="[^"]*"/gi, '');
  svgContent = svgContent.replace(/stroke-linecap="[^"]*"/gi, '');
  svgContent = svgContent.replace(/stroke-linejoin="[^"]*"/gi, '');
  
  // Write the output file
  fs.writeFileSync(destPath, svgContent);
  console.log(`Created solid version: ${filename}`);
});

console.log('Solid processing completed!');