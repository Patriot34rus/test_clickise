<script setup lang="ts">
import type { Condition } from '@/types'

interface Props {
  conditions: Condition[]
}

const props = defineProps<Props>()
</script>

<template>
  <ul>
    <li v-for="item in conditions" :key="item.id">
      {{ item.parameterLeft }} {{ item.operator }}
      {{ item.parameterRight === 'value' ? item.value : item.parameterRight }}
    </li>
  </ul>
</template>

<style scoped></style>
