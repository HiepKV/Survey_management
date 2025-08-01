<template>
  <div class="d-flex justify-content-center align-items-center vh-100 bg-light">
    <div class="card p-4 shadow-sm" style="width: 100%; max-width: 400px;">
      <h2 class="text-center text-primary mb-4">Sign in</h2>
      <form @submit.prevent="handleLogin">
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input
            v-model="form.username"
            type="text"
            class="form-control"
            id="username"
            placeholder="IDを入力"
            required
          />
        </div>
        <div class="mb-4">
          <label for="password" class="form-label">Password</label>
          <input
            v-model="form.password"
            type="password"
            class="form-control"
            id="password"
            placeholder="パスワードを入力"
            required
          />
        </div>
        <button type="submit" class="btn btn-primary w-100">
          Sign in
        </button>
      </form>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import AuthService from '../../services/AuthService';

const router = useRouter();


const form = ref({
  username: '',
  password: '',
});

const handleLogin = async () => {
  try {
    const res = await AuthService.login(form.value);
    router.push('/');
    alert('Login successful');
    console.log('Login successful:', res);
  }catch (error) {
    console.error('Login error:', error);
    alert('Login failed. Please check your credentials.');
  }
};
</script>

<style scoped>
</style>
