<template>
  <aside class="d-flex flex-column bg-white border-end vh-100" style="width: 220px;">
    <div class="p-3 fw-bold text-primary">
      Survey Management
    </div>
    <nav class="nav flex-column">
      <router-link
        v-for="item in menuItems"
        :key="item.path"
        :to="item.path"
        class="nav-link position-relative px-4 py-2 text-dark"
        :class="{ active: $route.path === item.path }"
      >
        {{ item.label }}
      </router-link>
    </nav>
  </aside>
</template>

<script setup>
const menuItems = [
  { label: 'Surveys', path: '/surveys' },
  { label: '会社一覧', path: '/companies' },
  { label: 'リスト', path: '/lists' },
  { label: 'アカウント一覧', path: '/accounts' },
  { label: 'ログアウト', path: '/logout' }
]
</script>

<style scoped>
.nav-link.active {
  color: #0d6efd;
  font-weight: 500;
}
.nav-link.active::before {
  content: "";
  position: absolute;
  left: 0;
  top: 0;
  bottom: 0;
  width: 4px;
  background-color: #0d6efd;
}
.nav-link:hover {
  background-color: #f8f9fa;
}
</style>
