<script setup lang="ts">
import type { Action } from '@/types'

interface Props {
  action: Action
}

const props = defineProps<Props>()
</script>

<template>
  <div>
    {{ action.parameter }} {{ action.type == 'increment' ? 'увеличиваем на' : 'уменьшаем на' }}
    {{ action.value }}
  </div>
</template>

<style scoped></style>
