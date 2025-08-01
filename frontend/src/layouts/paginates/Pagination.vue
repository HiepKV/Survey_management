<template>
  <nav v-if="totalPages > 1" class="mt-3">
    <ul class="pagination mb-0">
      <!-- Prev -->
      <li
        class="page-item"
        :class="{ disabled: currentPage === 1 }"
        @click="goToPage(currentPage - 1)"
      >
        <a class="page-link" href="javascript:void(0)">«</a>
      </li>

      <!-- First Page -->
      <li
        v-if="pages[0] > 1"
        class="page-item"
        @click="goToPage(1)"
      >
        <a class="page-link" href="javascript:void(0)">1</a>
      </li>
      <li v-if="pages[0] > 2" class="page-item disabled">
        <span class="page-link">...</span>
      </li>

      <!-- Page Numbers -->
      <li
        v-for="page in pages"
        :key="page"
        class="page-item"
        :class="{ active: currentPage === page }"
        @click="goToPage(page)"
      >
        <a class="page-link" href="javascript:void(0)">{{ page }}</a>
      </li>

      <!-- Last Page -->
      <li v-if="pages[pages.length - 1] < totalPages - 1" class="page-item disabled">
        <span class="page-link">...</span>
      </li>
      <li
        v-if="pages[pages.length - 1] < totalPages"
        class="page-item"
        @click="goToPage(totalPages)"
      >
        <a class="page-link" href="javascript:void(0)">{{ totalPages }}</a>
      </li>

      <!-- Next -->
      <li
        class="page-item"
        :class="{ disabled: currentPage === totalPages }"
        @click="goToPage(currentPage + 1)"
      >
        <a class="page-link" href="javascript:void(0)">»</a>
      </li>
    </ul>
  </nav>
</template>

<script setup>
import { computed, defineProps, defineEmits } from 'vue'

const props = defineProps({
  currentPage: { type: Number, required: true },
  totalItems: { type: Number, required: true },
  perPage: { type: Number, default: 10 }
})

const emit = defineEmits(['update:currentPage'])

const totalPages = computed(() => Math.ceil(props.totalItems / props.perPage))

const goToPage = (page) => {
  if (page >= 1 && page <= totalPages.value) {
    emit('update:currentPage', page)
  }
}

const pages = computed(() => {
  const range = []
  const maxVisible = 5
  const half = Math.floor(maxVisible / 2)
  let start = Math.max(1, props.currentPage - half)
  let end = Math.min(totalPages.value, start + maxVisible - 1)

  if (end - start < maxVisible - 1) {
    start = Math.max(1, end - maxVisible + 1)
  }

  for (let i = start; i <= end; i++) {
    range.push(i)
  }

  return range
})
</script>

<style scoped>
.page-item.active .page-link {
  background-color: #0d6efd;
  border-color: #0d6efd;
  color: white;
}
.page-link {
  cursor: pointer;
}
</style>
