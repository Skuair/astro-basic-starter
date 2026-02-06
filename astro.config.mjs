import { defineConfig } from "astro/config";
import tailwindcss from "@tailwindcss/vite";

import sitemap from "@astrojs/sitemap";

// https://astro.build/config
export default defineConfig({
    site: "http://localhost:4321/",
    integrations: [sitemap()],
    vite: {
        plugins: [tailwindcss()],
    },
    devToolbar: {
        enabled: false,
    },
    i18n: {
        defaultLocale: "fr",
        locales: ["fr", "en"],
        routing: {
            prefixDefaultLocale: false, // /fr/about ou juste /about pour le défaut
        },
    },
});
