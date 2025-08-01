<template>
  <div class="logout-overlay d-flex justify-content-center align-items-center">
    <div class="logout-box text-center p-4 bg-white rounded shadow">
      <h5 class="fw-bold mb-3">ログアウト</h5>
      <p class="mb-4">本当にログアウトしますか？</p>
      <div class="d-flex justify-content-center gap-3">
        <button class="btn btn-secondary px-4" @click="cancel">キャンセル</button>
        <button class="btn btn-danger px-4" @click="confirmLogout">ログアウトする</button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useRouter } from 'vue-router'
import AuthService from '../../services/AuthService'

const router = useRouter()

const confirmLogout = async () => {
  try {
    router.push('/') 
    await AuthService.logout()
  } catch (err) {
    console.error('Logout failed:', err)
  }
}

const cancel = () => {
  router.push('/surveys')
}
</script>

<style scoped>
.logout-overlay {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0, 0, 0, 0.7);
  z-index: 9999;
}
.logout-box {
  min-width: 320px;
}
</style>
