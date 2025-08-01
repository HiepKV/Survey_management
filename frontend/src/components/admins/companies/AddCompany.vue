<template>
  <div class="container mt-4">
    <h2 class="mb-4">会社情報作成</h2>
    <div class="card p-4">
      <form @submit.prevent="submitForm">
        <div class="mb-3">
          <label class="form-label">会社名 <span class="text-danger">必須</span></label>
          <input v-model="form.name" type="text" class="form-control" placeholder="会社名を入力" required />
        </div>
        <div class="row">
          <div class="col-md-6 mb-3">
            <label class="form-label">性</label>
            <input v-model="form.contact_last_name" type="text" class="form-control" placeholder="せい" />
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label">名</label>
            <input v-model="form.contact_first_name" type="text" class="form-control" placeholder="めい" />
          </div>
        </div>
        <div class="mb-3">
          <label class="form-label">電話番号 <span class="text-danger">必須</span></label>
          <input v-model="form.phone" type="text" class="form-control" placeholder="電話番号を入力" required />
        </div>
        <div class="mb-3">
          <label class="form-label">メールアドレス <span class="text-danger">必須</span></label>
          <input v-model="form.email" type="email" class="form-control" placeholder="メールアドレスを入力" required />
        </div>
        <div class="d-flex justify-content-center gap-3 mt-4">
          <button type="button" class="btn btn-outline-primary" @click="goBack">一覧に戻る</button>
          <button type="submit" class="btn btn-primary">登録する</button>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import { CompanyRepository } from '../../../repositories/CompanyRepository'

const router = useRouter()

const form = ref({
  name: '',
  contact_last_name: '',
  contact_first_name: '',
  phone: '',
  email: '',
})

const submitForm = async () => {
  try {
    const contact_name = `${form.value.contact_last_name} ${form.value.contact_first_name}`.trim()
    const payload = {
      name: form.value.name,
      contact_name: contact_name,
      phone: form.value.phone,
      email: form.value.email,
    }

    await CompanyRepository.create(payload)
    alert('会社を登録しました！')
    router.push('/companies') // hoặc route bạn muốn trở về
  } catch (err) {
    alert('登録中にエラーが発生しました')
    console.error(err)
  }
}

const goBack = () => {
  router.push('/companies')
}
</script>

<style scoped>
.container {
  max-width: 800px;
}
.card {
  border-radius: 10;
}
</style>
