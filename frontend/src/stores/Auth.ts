// src/stores/auth.ts
import { defineStore } from 'pinia';
import axios from 'axios';

interface User {
  id: number;
  name: string;
  username: string;
  phone: string;
  email: string;
  [key: string]: any;
}

export const useAuthStore = defineStore('auth', {
  state: () => ({
    user: null as User | null,
    token: localStorage.getItem('access_token') || '',
  }),

  getters: {
    isLoggedIn: (state) => !!state.token,
  },

  actions: {
    setToken(token: string) {
      this.token = token;
      localStorage.setItem('access_token', token);
      axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
    },

    setUser(user: User) {
      this.user = user;
    },

    logout() {
      this.token = '';
      this.user = null;
      localStorage.removeItem('access_token');
      delete axios.defaults.headers.common['Authorization'];
    },
  },
});
