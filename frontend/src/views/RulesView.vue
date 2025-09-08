<script setup lang="ts">
import { onMounted, ref } from 'vue'
import { useRuleStore } from '@/stores/rules.ts'
import ConditionsDetail from '@/components/ConditionsDetail.vue'
import ActionDetail from '@/components/ActionDetail.vue'

const ruleStore = useRuleStore()

const fileds = [
  { key: 'id', label: 'ID' },
  { key: 'name', label: 'Название' },
  { key: 'pattern', label: 'Шаблон' },
  { key: 'show_details', label: 'Детали' },
]

onMounted(() => {
  loading.value = true
  ruleStore.fetchRules()
  loading.value = false
})

let loading = ref<boolean>(false)
</script>

<template>
  <div>
    <h1>Правила</h1>
    <BButton size="sm" class="mr-2" @click="$router.push(`/rule/new`)"> Создать</BButton>
    <div v-if="ruleStore.loading">Загрузка правил...</div>
    <div v-else>
      <BTable striped hover :items="ruleStore.rules" :fields="fileds">
        <template #cell(show_details)="row">
          <BButton size="sm" class="mr-2" @click="row.toggleDetails">
            {{ row.detailsShowing ? 'Скрыть' : 'Показать' }} детали
          </BButton>
          |
          <BButton size="sm" class="mr-2" @click="$router.push(`/rule/edit/${row.item.id}`)">
            Редактировать
          </BButton>
        </template>

        <template #row-details="row">
          <BCard>
            <BRow class="mb-2">
              <BCol sm="3" class="text-sm-right"><b>Условия</b></BCol>
              <BCol>
                <ConditionsDetail :conditions="row.item.conditions" />
              </BCol>
            </BRow>

            <BRow class="mb-2">
              <BCol sm="3" class="text-sm-right"><b>Операция:</b></BCol>
              <BCol>
                <ActionDetail :action="row.item.action" />
              </BCol>
            </BRow>
          </BCard>
        </template>
      </BTable>
    </div>
  </div>
</template>

<style></style>
