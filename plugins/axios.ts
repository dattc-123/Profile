import axios from "axios";
import { useAuthStore } from "~/store/useAuthStore";
import { useRuntimeConfig } from "#imports";

export default defineNuxtPlugin((nuxtApp) => {
  const config = useRuntimeConfig();

  const api = axios.create({
    baseURL: config.public.apiBaseUrl as string, // Lấy từ .env
    headers: {
      "Content-Type": "application/json",
      Accept: "application/json",
    },
  });

  api.interceptors.request.use(
    (config) => {
      const authStore = useAuthStore();
      const token = authStore.token || localStorage.getItem("token");

      if (token) {
        config.headers.Authorization = `Bearer ${token}`;
      }

      return config;
    },
    (error) => Promise.reject(error)
  );

  api.interceptors.response.use(
    (response) => response,
    (error) => {
      if (error.response?.status === 401) {
        const authStore = useAuthStore();
        authStore.logout();
        localStorage.removeItem("token");
        navigateTo("/index");
      }
      return Promise.reject(error);
    }
  );

  nuxtApp.provide("api", api);
});
