const ONE_DAY = 60 * 60 * 24 * 1000;
const ONE_WEEK = ONE_DAY * 7;
export default defineNuxtConfig({
  app: {
    head: {
      title: "My Nuxt 3 App",
      meta: [
        { name: "viewport", content: "width=device-width, initial-scale=1" },
      ],
    },
  },


  modules: ["@pinia/nuxt", "@vueuse/nuxt"],

  imports: {
    autoImport: true,
  },

  runtimeConfig: {
    public: {
      apiBase: process.env.API_BASE_URL || "http://127.0.0.1:8000/api",
    },
    private: {
      cookieName: process.env.COOKIE_NAME || "__session",
      cookieSecret: process.env.COOKIE_SECRET || "secret",
      cookieExpires: parseInt(
        process.env.COOKIE_REMEMBER_ME_EXPIRES || ONE_DAY.toString(),
        10
      ), // 1 day
      cookieRememberMeExpires: parseInt(
        process.env.COOKIE_REMEMBER_ME_EXPIRES || ONE_WEEK.toString(),
        10
      ), // 7 days
    },
  },

  compatibilityDate: "2025-03-14",
});