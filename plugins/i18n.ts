/*
 * Copyright 2023 Digi Dinos JSC. All rights reserved.
 * Email: tech@digidinos.com.
 */

import { createI18n } from "vue-i18n";
import en from "~/assets/locales/en.json";
import vi from "~/assets/locales/vi.json";

let locale = "ja"; // Mặc định là tiếng Nhật

if (process.client) {
  locale = localStorage.getItem("lang") || "ja";
}

const i18n = createI18n({
  legacy: false,
  globalInjection: true,
  locale,
  messages: {
    en,
    vi,
  },
});

export default defineNuxtPlugin((nuxtApp) => {
  nuxtApp.vueApp.use(i18n);
});
