/*
 * Copyright 2023 Digi Dinos JSC. All rights reserved.
 * Email: tech@digidinos.com.
 */

import { useAuthStore } from "~/store/useAuthStore";

export default defineNuxtRouteMiddleware((to, from) => {
  const authStore = useAuthStore();
  let token = authStore.token;

  if (process.client) {
    token = localStorage.getItem("token") || authStore.token;
  }

});
