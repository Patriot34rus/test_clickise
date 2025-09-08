<script setup lang="ts">
import { onMounted } from 'vue'
import { useRuleStore } from '@/stores/rules.ts'

const ruleStore = useRuleStore()

const fileds = [
  { key: 'id', label: 'ID' },
  { key: 'name', label: 'Название' },
  { key: 'pattern', label: 'Шаблон' },
]

onMounted(() => {
  ruleStore.fetchRules()
})
</script>

<template>
  <div>
    <h1>Правила</h1>
    <div v-if="ruleStore.loading">Загрузка правил...</div>
    <div v-else-if="ruleStore.error" class="error">{{ ruleStore.error }}</div>
    <div v-else>
      <BTable striped hover :items="ruleStore.rules" :fields="fileds" />
    </div>
  </div>
</template>

<style></style>
