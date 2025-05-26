let remSizes = {};
for (let i = 1; i <= 96; i += 0.5) {
  remSizes[i] = i / 4 + "rem";
}

const spacing = {
  "1/10": "10%",
  "2/10": "20%",
  "3/10": "30%",
  "4/10": "40%",
  "5/10": "50%",
  "6/10": "60%",
  "7/10": "70%",
  "8/10": "80%",
  "9/10": "90%",

  "1/8": 100 / 8 + "%",
  "2/8": 200 / 8 + "%",
  "3/8": 300 / 8 + "%",
  "4/8": 400 / 8 + "%",
  "5/8": 500 / 8 + "%",
  "6/8": 600 / 8 + "%",
  "7/8": 700 / 8 + "%",

  "1/9": 100 / 9 + "%",
  "2/9": 200 / 9 + "%",
  "3/9": 300 / 9 + "%",
  "4/9": 400 / 9 + "%",
  "5/9": 500 / 9 + "%",
  "6/9": 600 / 9 + "%",
  "7/9": 700 / 9 + "%",
  "8/9": 800 / 9 + "%",
};

/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./*.php",
    "./template-parts/**/*.php",
    "./inc/**/*.php",
    "./src/**/*.{ts,js,scss}",
  ],
  theme: {
    extend: {
      colors: {
        "primary-blue": "#264480",
        "secondary-blue": "#3b82f6",
        "primary-red": "#EC3237",
        "secondary-red": "#dc2626",
        primary: "#264480",
        secondary: "#EC3237",
      },
      minWidth: {
        12: "3rem",
        16: "4rem",
        "4/5": (100 * 4) / 5 + "%",
        ...remSizes,
        ...spacing,
      },
      maxWidth: {
        12: "3rem",
        16: "4rem",
        ...remSizes,
        ...spacing,
      },
      width: {
        "11.4/12": "95%",
        "2.58/12": "21.5%",
        "5.25/12": "44%",
        "2.46/12": "20.5%",
      },
      height: {
        max: "max-content",
      },
      spacing: {
        ...spacing,
        ...remSizes,
      },
      fontSize: {
        base: ["1rem", "2rem"],
        sm: ["0.875rem", "27.3px"],
        "2xs": [".5rem", {}],
        "1xl": ["1.375rem", "2.68rem"],
        ...remSizes,
      },
      lineHeight: {
        ...remSizes,
      },
      borderRadius: {
        "4xl": "2rem",
        "5xl": "2.5rem",
        "6xl": "3rem",
        ...remSizes,
      },
      container: {
        center: true,
        padding: "1rem",
        screens: {
          sm: "640px",
          md: "768px",
          lg: "1024px",
          xl: "1280px",
          "2xl": "1280px", // ← مقدار جدید دلخواهت
        },
      },
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
    require("@tailwindcss/typography"),
    require("@tailwindcss/aspect-ratio"),
  ],
};
