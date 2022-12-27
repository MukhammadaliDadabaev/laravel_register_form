/** @type {import('tailwindcss').Config} */
module.exports = {
    content: ["./resources/**/*.blade.php"],
    theme: {
        extend: {},
    },
    plugins: [require("@tailwindcss/forms")],
    // plugins: [
    //     require("@tailwindcss/forms")({
    //         strategy: "base", // only generate global styles
    //         strategy: "class", // only generate classes
    //     }),
    // ],
};
