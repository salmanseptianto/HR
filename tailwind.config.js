/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                primary: "#0C4A6E", // Property theme color
                secondary: "#38BDF8", // Light blue for accents
            },
        },
    },
    plugins: [],
    
};
