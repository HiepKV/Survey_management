<template>
  <div class="container-fluid px-4 pt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h4>アカウント一覧</h4>
      <button class="btn btn-primary" @click="onAdd">＋追加</button>
    </div>

    <p class="text-muted small">
      {{ meta.from }}〜{{ meta.to }}件を表示 / 全{{ meta.total }}件
    </p>

    <div class="table-responsive">
      <table class="table align-middle border-top border-bottom">
        <thead class="table-light">
          <tr>
            <th>ID</th>
            <th>メモ</th>
            <th>作成日</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="account in accounts" :key="account.id" class="table-row">
            <td>{{ account.id }}</td>
            <td>
              <div v-if="account.memos?.length" class="text-truncate" style="max-width: 400px;">
                {{ account.memos[0].content }}
              </div>
            </td>
            <td>{{ formatDate(account.created_at) }}</td>
          </tr>
          <tr v-if="accounts.length === 0">
            <td colspan="3" class="text-center text-muted py-4">データがありません。</td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="d-flex justify-content-center mt-4">
      <Pagination
        v-if="meta.total > meta.per_page"
        :currentPage="meta.current_page"
        :totalItems="meta.total"
        :perPage="meta.per_page"
        @update:currentPage="handlePageChange"
      />
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import AccService from '../../services/AccService'
import Pagination from '../../layouts/paginates/Pagination.vue'

const router = useRouter()
const accounts = ref([])
const meta = ref({
  current_page: 1,
  total: 0,
  per_page: 10,
  from: 0,
  to: 0
})

const fetchData = async (page = 1) => {
  try {
    const res = await AccService.get({ page })
    const data = res.data

    accounts.value = Array.isArray(data.data) ? data.data : []
    meta.value = {
      current_page: data.current_page,
      total: data.total,
      per_page: data.per_page,
      from: data.from,
      to: data.to
    }
  } catch (error) {
    console.error('Fetch accounts error:', error)
  }
}

const handlePageChange = (page) => {
  fetchData(page)
}

const formatDate = (dateStr) => {
  const date = new Date(dateStr)
  return `${date.getFullYear()}年${date.getMonth() + 1}月${date.getDate()}日  -- ${date.getHours()}:${String(date.getMinutes()).padStart(2, '0')}`
}

const onAdd = () => {
  router.push('/accounts/add')
}
onMounted(() => {
  fetchData()
})
</script>

<style scoped>
.table-row:hover {
  background-color: #f9f9f9;
}
.text-truncate {
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}
</style>
