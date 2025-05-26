import { defineConfig, loadEnv } from "vite";
import { resolve } from "path";
import { glob } from "glob";
import { viteStaticCopy } from "vite-plugin-static-copy";
import postcss from 'postcss';
import postcssUrl from 'postcss-url';

// Get all JavaScript files in pages directory
const pageEntries = glob
    .sync("src/js/pages/**/*.js")
    .reduce((entries, path) => {
      const name = path.replace(/^src\/js\/pages\/(.*)\.js$/, "$1");
      return { ...entries, [`pages/${name}`]: resolve(__dirname, path) };
    }, {});

// Get all SCSS files in pages directory
const styleEntries = glob
    .sync("src/scss/pages/**/*.scss")
    .reduce((entries, path) => {
      const name = path.replace(/^src\/scss\/pages\/(.*)\.scss$/, "$1");
      return { ...entries, [`styles/${name}`]: resolve(__dirname, path) };
    }, {});

export default defineConfig(({ mode }) => {
  const env = loadEnv(mode, process.cwd(), "");

  return {
    base: mode === "development" ? "/" : "/si24/wp-content/themes/JTheme/assets/",

    build: {
      outDir: "assets",
      emptyOutDir: true,
      manifest: true,
      minify: "terser",
      terserOptions: {
        compress: {
          drop_console: true,
        },
      },
      rollupOptions: {
        input: {
          core: resolve(__dirname, "src/js/core/main.js"),
          "wp-ajax": resolve(__dirname, "src/js/core/wp-ajax.js"),
          style: resolve(__dirname, "src/scss/style.scss"),
          ...pageEntries,
          ...styleEntries,
        },
        output: {
          entryFileNames: (chunkInfo) => {
            if (chunkInfo.name.startsWith("pages/")) {
              const pageName = chunkInfo.name.replace("pages/", "");
              return `js/pages/${pageName}.js`;
            }
            return "js/[name].js";
          },
          chunkFileNames: "js/[name].js",
          assetFileNames: ({ name }) => {
            if (/\.(gif|jpe?g|png|svg)$/.test(name ?? "")) {
              return "images/[name][extname]";
            }
            if (/\.css$/.test(name ?? "")) {
              if (name && name.includes("styles/")) {
                const pageName = name.replace("styles/", "");
                return `css/pages/${pageName}.css`;
              }
              return "css/[name][extname]";
            }
            if (/\.(woff|woff2|eot|ttf|otf)$/.test(name ?? "")) {
              return "fonts/[name][extname]";
            }
            return "[name][extname]";
          },
        },
        external: ["jquery"],
      },
    },

    server: {
      cors: true,
      strictPort: true,
      port: Number(env.VITE_SERVER_PORT) || 3000,
      hmr: {
        host: env.VITE_HMR_HOST || "localhost",
        protocol: env.VITE_HMR_PROTOCOL || "ws",
      },
      watch: {
        usePolling: true,
      },
      host: true,
    },

    resolve: {
      alias: {
        "@": resolve(__dirname, "src"),
        "@core": resolve(__dirname, "src/js/core"),
        "@components": resolve(__dirname, "src/js/components"),
        "@layouts": resolve(__dirname, "src/js/layouts"),
        "@utils": resolve(__dirname, "src/js/utils"),
        "@hooks": resolve(__dirname, "src/js/hooks"),
        "@styles": resolve(__dirname, "src/scss"),
        jquery: "jquery/dist/jquery.min.js",
      },
    },

    css: {
      devSourcemap: true,
      preprocessorOptions: {
        scss: {
          includePaths: [
            resolve(__dirname, "src/scss"),
            resolve(__dirname, "node_modules"),
          ],
          additionalData: `
            @use "@styles/core/variables" as *;
            @use "@styles/core/mixins" as *;
          `,
        },
      },
    },

    optimizeDeps: {
      include: ["jquery"],
    },

    plugins: [
      postcssUrl({
        url: 'rebase', // Rewrite URLs to be relative
      }),
      viteStaticCopy({
        targets: [
          {
            src: "src/images/*",
            dest: "images",
          },
          {
            src: "src/fonts/*",
            dest: "fonts",
          },
        ],
      }),
    ],
  };
});