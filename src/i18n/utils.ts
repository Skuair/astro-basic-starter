import fr from "./locales/fr.json";
import en from "./locales/en.json";

const translations = {
    fr,
    en,
};

export function t(key: string, lang: string = "fr") {
    const keys = key.split(".");
    let value: any = translations[lang as keyof typeof translations];

    for (const k of keys) {
        value = value?.[k];
    }

    return value || key;
}

export function useTranslations(lang: string) {
    return (key: string) => t(key, lang);
}
