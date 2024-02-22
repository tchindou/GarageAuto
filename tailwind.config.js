/** @type {import('tailwindcss').Config} */
export default {
    important: true,
    corePlugins: {
        preflight: false,
    },
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            fontFamily: {
                poppins: ["Poppins", "sans-serif"],
            },
            fontSize: {
                xs: ["10px", "14px"],
                sm: ["14px", "20px"],
                base: ["16px", "24px"],
                lg: ["20px", "28px"],
                xl: ["24px", "32px"],
            },
            screens: {
                sm: "420px",
                // => @media (min-width: 640px) { ... }

                md: "768px",
                // => @media (min-width: 768px) { ... }

                lg: "1024px",
                // => @media (min-width: 1024px) { ... }

                xl: "1280px",
                // => @media (min-width: 1280px) { ... }

                "2xl": "1536px",
                // => @media (min-width: 1536px) { ... }
            },
        },
    },
    plugins: [],
};
