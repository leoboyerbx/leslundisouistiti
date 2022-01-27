module.exports = {
    content: [
        "./assets/**/*.{vue,js,ts,jsx,tsx}",
        "./templates/**/*.{html,twig}",
        // "./src/**/*.{php}",
    ],
    theme: {
        extend: {},
    },
    plugins: [
        require('daisyui'),
    ],
}
