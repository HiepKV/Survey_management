<template>
    <div class="container-fluid px-4 pt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>Surveys</h4>
            <button class="btn btn-primary" @click="onAdd">＋追加</button>
        </div>
        <div class="mb-3 w-50">
            <input v-model="search" type="text" class="form-control" placeholder="案件名・会社名" />
        </div>
        <p class="text-muted small">
            {{ meta.from }}〜{{ meta.to }}件を表示 / 全{{ meta.total }}件
        </p>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>案件名</th>
                        <th>ステータス</th>
                        <th>会社名</th>
                        <th>リスト件数</th>
                        <th>回答件数</th>
                        <th>送信開始日時</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in campaigns" :key="item.id" @click="goToDetail(item.id)" class="table-row">
                        <td>{{ item.title }}</td>
                        <td>
                            <span class="status-badge" :class="{
                                'status-waiting': item.status === 'waiting',
                                'status-inprogress': item.status === 'inprogress',
                                'status-completed': item.status === 'completed'
                            }">
                                {{ item.status.charAt(0).toUpperCase() + item.status.slice(1) }}
                            </span>
                        </td>
                        <td>{{ item.company?.name }}</td>
                        <td>{{ item.recipients_count.toLocaleString() }}件</td>
                        <td>
                            <span v-if="item.form_answers_count > 0" class="text-primary" style="cursor: pointer;">
                                {{ item.form_answers_count.toLocaleString() }}件
                            </span>
                            <span v-else>ー</span>
                        </td>
                        <td>{{ formatDate(item.send_date) || '-' }}</td>
                    </tr>
                    <tr v-if="campaigns.length === 0">
                        <td colspan="6" class="text-center text-muted py-4">
                            データがありません。
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-4">
            <Pagination v-if="meta.total > meta.per_page" :currentPage="meta.current_page" :totalItems="meta.total"
                :perPage="meta.per_page" @update:currentPage="page => { filters.page = page; fetchData() }" />
        </div>
    </div>
</template>

<script setup>
import { ref, watch, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import CampaignService from '../../../services/CampaignService'
import Pagination from '../../../layouts/paginates/Pagination.vue'

const campaigns = ref([])
const search = ref('')
const filters = ref({ title: '', name: '', page: 1 })

const meta = ref({
    current_page: 1,
    total: 0,
    per_page: 10,
    from: 0,
    to: 0
})

const router = useRouter()

const fetchData = async () => {
    try {
        const response = await CampaignService.get(filters.value)
        const res = response.data

        campaigns.value = res.data
        meta.value = {
            current_page: res.current_page,
            total: res.total,
            per_page: res.per_page,
            from: res.from,
            to: res.to
        }
    } catch (error) {
        console.error('Fetch campaigns error:', error)
    }
}

const onAdd = () => {
    router.push('/surveys/add')
}



const formatDate = (dateStr) => {
    if (!dateStr) return ''
    const normalized = dateStr.replace(' ', 'T')
    const d = new Date(normalized)
    return (
        d.toLocaleDateString('ja-JP') +
        ' ' +
        d.toLocaleTimeString('ja-JP', { hour: '2-digit', minute: '2-digit' })
    )
}

const goToDetail = (id) => {
    router.push(`/surveys/${id}`)
}
watch(search, () => {
    page.value = 1
    fetchCompanies()
})

onMounted(() => {
    fetchData()
})
</script>

<style scoped>
.status-badge {
    display: inline-block;
    padding: 4px 12px;
    font-size: 14px;
    font-weight: 500;
    border-radius: 20px;
    text-transform: capitalize;
    min-width: 90px;
    text-align: center;
}

.status-waiting {
    background-color: #ffe5e5;
    color: #d9534f;
}

.status-inprogress {
    background-color: #e6f3ff;
    color: #0d6efd;
}

.status-completed {
    background-color: #f1f1f1;
    color: #6c757d;
}

.table-row {
    cursor: pointer;
}

.table-row:hover {
    background-color: #f9f9f9;
}
</style>
