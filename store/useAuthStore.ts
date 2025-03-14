import { defineStore } from "pinia";

export const useAuthStore = defineStore("auth", {
    state: () => ({
        user: null,
        token: "",
    }),
    actions: {
        setUser( user: any) {
            this.user = user;
        },
        setToken(token:string) {
            this.token = token;
        },
        logout() {
            this.user = null;
            this.token = "";
        }
    }
})