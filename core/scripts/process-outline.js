 /**
 * Process SVGs into outline versions
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
const outlineDir = path.join(svgDir, 'outline');

// Ensure directory exists
if (!fs.existsSync(outlineDir)) {
  fs.mkdirSync(outlineDir, { recursive: true });
}

// Process all SVGs in the optimized directory
const svgFiles = fs.readdirSync(optimizedDir)
  .filter(file => file.endsWith('.svg'));

console.log(`Processing ${svgFiles.length} SVG files for outline version...`);

// Process each file
svgFiles.forEach(filename => {
  const srcPath = path.join(optimizedDir, filename);
  const destPath = path.join(outlineDir, filename);
  
  let svgContent = fs.readFileSync(srcPath, 'utf8');
  
  // Make it an outline version
  // 1. Add namespace if missing
  if (!svgContent.includes('xmlns=')) {
    svgContent = svgContent.replace('<svg', '<svg xmlns="http://www.w3.org/2000/svg"');
  }
  
  // 2. Set fill to none
  if (!svgContent.includes('fill="none"')) {
    svgContent = svgContent.replace(/<svg([^>]*)>/i, '<svg$1 fill="none">');
  }
  
  // 3. Add stroke attribute
  if (!svgContent.includes('stroke=')) {
    svgContent = svgContent.replace(/<svg([^>]*)>/i, '<svg$1 stroke="currentColor">');
  }
  
  // 4. Add stroke-width
  if (!svgContent.includes('stroke-width=')) {
    svgContent = svgContent.replace(/<svg([^>]*)>/i, '<svg$1 stroke-width="2">');
  }
  
  // 5. Remove fills from paths
  svgContent = svgContent.replace(/fill="(?!none)[^"]*"/gi, 'fill="none"');
  
  // Write the output file
  fs.writeFileSync(destPath, svgContent);
  console.log(`Created outline version: ${filename}`);
});

console.log('Outline processing completed!');