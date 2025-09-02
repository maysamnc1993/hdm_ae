/** @type {import('tailwindcss').Config} */
const remSizes = {};
for (let i = 1; i <= 96; i += 0.5) {
  remSizes[i] = `${i / 4}rem`;
}

const percentageSpacing = {
  "1/10": "10%",
  "2/10": "20%",
  "3/10": "30%",
  "4/10": "40%",
  "5/10": "50%",
  "6/10": "60%",
  "7/10": "70%",
  "8/10": "80%",
  "9/10": "90%",
  "1/8": `${100 / 8}%`,
  "2/8": `${200 / 8}%`,
  "3/8": `${300 / 8}%`,
  "4/8": `${400 / 8}%`,
  "5/8": `${500 / 8}%`,
  "6/8": `${600 / 8}%`,
  "7/8": `${700 / 8}%`,
  "1/9": `${100 / 9}%`,
  "2/9": `${200 / 9}%`,
  "3/9": `${300 / 9}%`,
  "4/9": `${400 / 9}%`,
  "5/9": `${500 / 9}%`,
  "6/9": `${600 / 9}%`,
  "7/9": `${700 / 9}%`,
  "8/9": `${800 / 9}%`,
};

module.exports = {
  content: [
    "./*.php",
    "./template-parts/**/*.php",
    "./inc/**/*.php",
    "./src/**/*.{ts,js,scss}",
  ],
  theme: {
    extend: {
      // Font Families
      fontFamily: {
        space: ["Space Grotesk", "sans-serif"],
        inter: ["Inter", "sans-serif"],
      },

      // Colors (Semantic Naming)
      colors: {
        primary: "#c15b19", // Main brand color (orange)
        dark: "#060C14",
        light: "#E7E5D4",
        border: "#DCDBD0",
        borderLight: "#BFBEB5",
        brand: {
          primary: "#c15b19", // Main brand color (orange)
          secondary: "#bf5917",
          accent: "#ff944a",
          highlight: "#feb995",
          muted: "#b9561b",
        },
        neutral: {
          dark: "#00081f", // Body background
          darker: "#0c0c0f", // Dark background for components
          darkest: "#0f0f0f",
          gray: {
            100: "#92969f",
            200: "#b4b9b1",
            300: "#212122",
            400: "#222222",
            500: "#141d1f",
            600: "#212e31",
          },
        },
        success: {
          DEFAULT: "#9de500",
          light: "#adff85",
          lighter: "#acfe85",
        },
        secondary: {
          DEFAULT: "#00091c",
        },
        blue: {
          dark: "#004ba4",
          darker: "#002862",
          muted: "rgba(17, 60, 105, 0.2)",
        },
        white: {
          DEFAULT: "#fff",
          80: "rgba(255, 255, 255, 0.8)",
          65: "rgba(255, 255, 255, 0.65)",
          50: "rgba(255, 255, 255, 0.5)",
          30: "rgba(255, 255, 255, 0.3)",
          c7: "#ffffffc7",
          a6: "#ffffffa6",
        },
        black: {
          DEFAULT: "#000",
          80: "#00000080",
          40: "rgba(0, 0, 0, 0.4)",
          59: "#00000059",
        },
      },

      // Typography
      fontSize: {
        "2xs": ["0.5rem", { lineHeight: "1rem" }],
        sm: ["0.875rem", { lineHeight: "27.3px" }],
        base: ["1rem", { lineHeight: "2rem" }],
        "1xl": ["1.375rem", { lineHeight: "2.68rem" }],
        "2.5xl": ["2.5rem", { lineHeight: "3rem" }],
        "3xl": ["3rem", { lineHeight: "3.5rem" }],
        "3.5xl": ["3.625rem", { lineHeight: "4rem" }],
        "4.5xl": ["4.5rem", { lineHeight: "5rem" }],
        "5xl": ["5rem", { lineHeight: "5.5rem" }],
        "title-csat": ["100px", { lineHeight: "90px", letterSpacing: "-8px" }],
        ...remSizes,
      },
      lineHeight: {
        ...remSizes,
      },

      // Spacing
      spacing: {
        ...percentageSpacing,
        ...remSizes,
      },

      // Widths and Heights
      width: {
        fit: "fit-content",
        max: "max-content",
        min: "min-content",
        "11.4/12": "95%",
        "2.58/12": "21.5%",
        "5.25/12": "44%",
        "2.46/12": "20.5%",
        "22vw": "22vw",
        "120vw": "120vw",
        746: "746px",
        1200: "1200px",
      },
      height: {
        "100vh": "100vh",
        "700vh": "700vh",
        "50vh": "50vh",
        350: "350px",
        500: "500px",
        max: "max-content",
        min: "min-content",
      },
      minWidth: {
        12: "3rem",
        16: "4rem",
        "4/5": `${(100 * 4) / 5}%`,
        ...remSizes,
        ...percentageSpacing,
      },
      maxWidth: {
        12: "3rem",
        16: "4rem",
        ...remSizes,
        ...percentageSpacing,
      },

      // Border Radius
      borderRadius: {
        "4xl": "2rem",
        "5xl": "2.5rem",
        "6xl": "3rem",
        ...remSizes,
      },

      // Box Shadow
      boxShadow: {
        faq: "16px 24px 20px 8px rgba(0, 0, 0, 0.4)",
        whyChoose: "0px 20px 30px 0px rgb(0, 0, 0)",
        date: [
          "0 0.5971px 1.3137px #00000003",
          "0 1.8109px 3.9839px #0000000b",
          "0 4.787px 10.5314px #0000001c",
          "0 15px 33px #00000059",
        ].join(", "),
        copper: [
          "inset -3px -3px 8px rgba(255, 255, 255, 0.1)",
          "inset 3px 3px 6px rgba(0, 0, 0, 0.2)",
          "0 8px 20px rgba(255, 120, 50, 0.3)",
        ].join(", "),
        "copper-hover": [
          "inset -2px -2px 6px rgba(255, 255, 255, 0.2)",
          "inset 2px 2px 5px rgba(0, 0, 0, 0.2)",
          "0 10px 24px rgba(255, 135, 50, 0.4)",
        ].join(", "),
        circle: "0 1px 17px #ffffff40",
      },

      // Animations
      keyframes: {
        "scroll-left": {
          "0%": { transform: "translateX(0)" },
          "100%": { transform: "translateX(-50%)" },
        },
        "scroll-x": {
          from: { transform: "translateX(0)" },
          to: { transform: "translateX(calc(-100% - var(--gap)))" },
        },
        "pulse-animation": {
          "0%": { boxShadow: "0 0 0 0px rgb(157, 229, 0)" },
          "100%": { boxShadow: "0 0 0 0.25rem rgba(157, 229, 0, 0.1)" },
        },
        "fly-away": {
          "0%": { opacity: 1, transform: "translateX(0) scale(1)" },
          "100%": { opacity: 0, transform: "translateX(-225px) scale(0)" },
        },
        "fly-away2": {
          "0%": {
            opacity: 1,
            transform: "translateX(0) scale(1) rotate(-180deg)",
          },
          "100%": {
            opacity: 0,
            transform: "translateX(225px) scale(0) rotate(-180deg)",
          },
        },
        animate: {
          "0%": { backgroundPosition: "-500%" },
          "100%": { backgroundPosition: "500%" },
        },
      },
      animation: {
        "scroll-left": "scroll-left 10s linear infinite",
        "scroll-x": "scroll-x 30s linear infinite",
        pulse: "pulse-animation 2s infinite",
        "fly-away": "fly-away 2s ease forwards",
        "fly-away2": "fly-away2 2s ease forwards",
        slogan: "animate 3s linear infinite",
      },

      // Containers
      container: {
        center: true,
        padding: "1rem",
        screens: {
          sm: "640px",
          md: "768px",
          lg: "1024px",
          xl: "1280px",
          "2xl": "1280px",
        },
      },

      // Typography Plugin
      typography: {
        DEFAULT: {
          css: {
            maxWidth: "none",
            color: "inherit",
            a: {
              color: "var(--primary-color)",
              "&:hover": {
                color: "var(--primary-color-dark)",
              },
            },
          },
        },
      },
    },
  },
  plugins: [
    // require("@tailwindcss/typography"),
    require("@tailwindcss/aspect-ratio"),
    require("tailwind-bootstrap-grid")({
      gridGutters: {
        0: 0,
        1: ".5rem",
        2: "1rem",
        3: "1.5rem",
        4: "2rem",
        5: "2.75rem",
        6: "3.25rem",
      },
    }),
  ],
};
