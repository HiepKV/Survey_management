<template>
  <div class="container py-4" v-if="campaign">
    <section class="mb-4">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold mb-0">案件情報</h5>
        <span
          class="status-badge"
          :class="{
            'status-waiting': campaign.status === 'waiting',
            'status-inprogress': campaign.status === 'inprogress',
            'status-completed': campaign.status === 'completed'
          }"
        >
          {{ formatStatus(campaign.status) }}
        </span>
      </div>

      <div class="card p-4">
        <div class="mb-3">
          <p class="mb-0">
            <strong>案件名：</strong>
            {{ campaign.title }}
          </p>
        </div>
        <div class="mb-3">
          <strong>送信手段：</strong>
          <span>{{ campaign.send_method }}</span>
        </div>
        <div class="row mb-3">
          <div class="col-md-6">
            <strong>送信開始日時：</strong>
            <span>{{ formatDate(campaign.send_date) || '-' }}</span>
          </div>
            <div class="col-md-6">
                <strong>送信完了日時：</strong>
                <span>{{ formatDate(campaign.end_date) || '-' }}</span>
            </div>
        </div>

        <div class="table-responsive mb-4">
          <table class="table table-bordered text-center align-middle mb-0">
            <thead class="table-light">
              <tr>
                <th>リスト件数</th>
                <th>送信完了件数</th>
                <th>反響件数</th>
                <th>商談件数</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>{{ campaign.recipients_count.toLocaleString() }}件</td>
                <td>10,000件</td> 
                <td>{{ campaign.form_answers_count }}件</td> 
                <td><a href="#">500件</a></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="row">
          <div class="col-md-6 mb-2 mb-md-0">
            <strong>案件作成者：</strong>
            <span>UserID  {{ campaign.created_by }}</span> 
          </div>
          <div class="col-md-6">
            <strong>案件作成日時：</strong>
            <span>{{ formatDate(campaign.created_at) }}</span>
          </div>
        </div>
      </div>
    </section>

    <section>
      <h5 class="fw-bold mb-3">お問い合わせ内容</h5>
      <div class="card p-4">
        <table class="table table-borderless align-middle detail-table mb-4">
          <tbody>
            <tr>
              <th>会社名</th>
              <td>{{ campaign.company?.name }}</td>
            </tr>
            <tr>
              <th>担当者名</th>
              <td>{{ campaign.company?.contact_name }}</td>
            </tr>
            <tr>
              <th>電話番号</th>
              <td>{{ campaign.company?.phone }}</td>
            </tr>
            <tr>
              <th>メールアドレス</th>
              <td>{{ campaign.company?.email }}</td>
            </tr>
            <tr>
              <th>件名</th>
              <td>{{ campaign.title }}</td>
            </tr>
            <tr class="inquiry-row">
              <th>お問い合わせ内容</th>
              <td>
                お問い合わせ内容が入ります お問い合わせ内容が入ります お問い合わせ内容が入ります
              </td>
            </tr>
          </tbody>
        </table>

        <div class="text-center">
          <router-link to="/surveys" class="btn btn-outline-primary">
            一覧に戻る
          </router-link>
        </div>
      </div>
    </section>
  </div>

  <div v-else class="text-center py-5">Loading...</div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRoute } from 'vue-router'
import CampaignService from '../../../services/CampaignService'

const route = useRoute()
const campaign = ref(null)

const fetchData = async () => {
  try {
    const data = await CampaignService.getById(Number(route.params.id))
    campaign.value = data
  } catch (error) {
    console.error('Error fetching campaign data:', error)
  }
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

const formatStatus = (status) => {
  if (status === 'waiting') return '待機中'
  if (status === 'inprogress') return '送信中'
  if (status === 'completed') return '完了'
  return status
}

onMounted(fetchData)
</script>

<style scoped>
.card {
  border-radius: 8px;
  background-color: #fff;
}

.status-badge {
  display: inline-block;
  padding: 6px 14px;
  font-size: 14px;
  font-weight: 600;
  border-radius: 20px;
  text-align: center;
  min-width: 90px;
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

.detail-table th,
.detail-table td {
  border-bottom: 1px solid #dee2e6;
  padding: 10px 12px;
  vertical-align: top;
}

.detail-table th {
  background-color: #f8f9fa;
  font-weight: 600;
  width: 25%;
}

.detail-table td {
  background-color: #fff;
  white-space: pre-wrap;
}

.detail-table .inquiry-row td {
  min-height: 100px;
  line-height: 1.6;
}
</style>
