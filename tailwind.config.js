export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                primary: {
                    DEFAULT: "#1E40AF",  // your main primary
                    light: "#60A5FA",    // optional
                    dark: "#1E3A8A",     // optional
                    dim: "#7e7e7eff",
                    gray: "#e4e4e4ff",
                    main: "rgb(12, 74, 110)",
                },
            },
        },
    },
    plugins: [],
}
