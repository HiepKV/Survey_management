<template>
  <div class="container mt-3 w-50">
    <h2 class="mb-4">アカウント作成</h2>
    <div class="card p-4">
      <form @submit.prevent="handleSubmit">
        <div class="mb-3">
          <label class="form-label">ID <span class="text-danger">必須</span></label>
          <input
            type="text"
            class="form-control"
            v-model="form.id"
            placeholder="半角英数字10文字"
            required
          />
        </div>

        <div class="mb-3">
          <label class="form-label">パスワード <span class="text-danger">必須</span></label>
          <input
            type="password"
            class="form-control"
            v-model="form.password"
            placeholder="半角英数字8文字以上"
            required
          />
        </div>

        <div class="mb-3">
          <label class="form-label">メモ</label>
          <textarea
            class="form-control"
            rows="4"
            v-model="form.memo.content"
            placeholder="メモを入力"
          ></textarea>
        </div>

        <div class="text-center">
          <button type="button" class="btn btn-outline-primary me-2" @click="goBack">一覧に戻る</button>
          <button type="submit" class="btn btn-primary">登録する</button>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>
import { reactive } from 'vue'
import { useRouter } from 'vue-router'
import AccService from '../../services/AccService'

const router = useRouter()
const form = reactive({
  id: '',
  password: '',
  memo: {
    content: ''
  }
})
const handleSubmit = async () => {
  try {
    const payload = JSON.parse(JSON.stringify(form)) 

    if (!payload.memo.content?.trim()) {
      delete payload.memo
    }

    await AccService.create(payload)
    alert('アカウントを登録しました。')
    router.push('/accounts')
  } catch (error) {
    alert('登録に失敗しました。')
    console.error('アカウント作成エラー:', error)
  }
}

const goBack = () => {
  router.push('/accounts')
}
</script>
