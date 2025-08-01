<template>
  <div class="container-fluid px-4 pt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h4>Companies</h4>
      <button class="btn btn-primary" @click="onAdd">＋追加</button>
    </div>
    <div class="mb-3 w-50">
      <input v-model="search" type="text" class="form-control" placeholder="会社名" />
    </div>
    <p class="text-muted small">
      {{ meta.from }}〜{{ meta.to }}件を表示 / 全{{ meta.total }}件
    </p>
    <div class="table-responsive">
      <table class="table table-hover align-middle">
        <thead class="table-light">
          <tr>
            <th>会社名</th>
            <th>担当者名</th>
            <th>電話番号</th>
            <th>メール</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="item in companies" :key="item.id" @click="goToDetail(item.id)" class="table-row">
            <td>{{ item.name }}</td>
            <td>{{ item.contact_name }}</td>
            <td>{{ item.phone }}</td>
            <td>{{ item.email }}</td>
          </tr>
          <tr v-if="companies.length === 0">
            <td colspan="4" class="text-center text-muted py-4">データがありません。</td>
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
        @update:currentPage="page => { filters.page = page; fetchData() }"
      />
    </div>
  </div>
</template>

<script setup>
import { ref, watch, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import { CompanyRepository } from '../../../repositories/CompanyRepository'
import Pagination from '../../../layouts/paginates/Pagination.vue'

const router = useRouter()
const companies = ref([])
const search = ref('')
const filters = ref({ name: '', page: 1 })

const meta = ref({
  current_page: 1,
  total: 0,
  per_page: 10,
  from: 0,
  to: 0
})

const fetchData = async () => {
  try {
    filters.value.name = search.value
    const response = await CompanyRepository.get(filters.value)
    const res = response.data

    companies.value = Array.isArray(res.data) ? res.data : []
    meta.value = {
      current_page: res.current_page,
      total: res.total,
      per_page: res.per_page,
      from: res.from,
      to: res.to
    }
  } catch (error) {
    console.error('Fetch companies error:', error)
  }
}

const onAdd = () => {
  router.push('/companies/add')
}

const goToDetail = (id) => {
  router.push(`/companies/${id}`)
}

watch(search, () => {
  filters.value.page = 1
  fetchData()
})

onMounted(() => {
  fetchData()
})
</script>

<style scoped>
.table-row {
  cursor: pointer;
}

.table-row:hover {
  background-color: #f9f9f9;
}
</style>
