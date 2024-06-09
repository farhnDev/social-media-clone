const mix = require("laravel-mix");
require("laravel-mix-tailwind");
// Mengkompilasi file CSS dengan Tailwind CSS

// Mengkompilasi file JavaScript
mix.js("resources/js/app.js", "public/js")
    .vue() // Jika Anda menggunakan Vue.js, jika tidak, hapus baris ini.
    .react()
    .postCss("resources/css/app.css", "public/css", [require("tailwindcss")]);

// Mengaktifkan versi file untuk cache busting (opsional)
if (mix.inProduction()) {
    mix.version();
}

// Mengaktifkan source maps untuk debugging (opsional)
mix.sourceMaps();
