<template>
    okkkkkkkkkk
    <button class="btn btn-primary" @click="returnList">Return</button>
</template>
<script setup lang="ts">
import { useRouter } from 'vue-router'
const router = useRouter()
const returnList = () => {
  router.push('/accounts')
}
</script>