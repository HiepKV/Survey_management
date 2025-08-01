<script setup>
import SideBar from '../views/SideBar/SideBar.vue'
</script>

<template>
  <div class="admin-layout d-flex">
    <aside class="admin-sidebar">
      <SideBar />
    </aside>
    <main class="admin-content flex-grow-1">
      <router-view />
    </main>
  </div>
</template>

<style scoped>
.admin-layout {
  min-height: 100vh;
}
.admin-content {
    background-color: #f8f9fa;
}
</style>
