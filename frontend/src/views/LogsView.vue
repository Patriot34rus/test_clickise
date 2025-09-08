<script setup lang="ts">
import { onMounted, ref } from 'vue'
import { fetchLogs, fetchFilters } from '@/fetcher'
import type { AnnouncementFilter, Log } from '@/types'
import VueDatePicker from '@vuepic/vue-datepicker'

async function load() {
  loading.value = true
  try {
    const response = await fetchLogs(filter.value)
    logs.value = response.logs
    count.value = response.count
  } catch (error) {
  } finally {
    loading.value = false
  }
}

function convertToSelectDataSet(data: object) {
  return Object.entries(data).map(([key, value]) => ({
    value: key,
    text: value,
  }))
}

function onPageChange(page: any) {
  filter.value.page = page
  load()
}

function onFilterChanged(newDate: any) {
  load()
}

onMounted(() => {
  load()
  fetchFilters().then((response) => {
    announcementDistinctList.value = convertToSelectDataSet(response.announcements)
  })
})

const fields = ref([
  { key: 'id', label: 'ID' },
  { key: 'name', label: 'Объявление' },
  { key: 'rule', label: 'Правило' },
  { key: 'budget', label: 'Бюджет' },
  { key: 'cpm', label: 'cpm' },
  { key: 'date', label: 'Дата' },
])

const logs = ref<Log[]>([])
const loading = ref(false)
const count = ref(1)
const filter = ref<AnnouncementFilter>({
  dateStart: null,
  endDate: null,
  announcement: null,
  page: 0,
})
const announcementDistinctList = ref<Array<{ value: string; text: any }>>([])
</script>

<template>
  <div v-if="loading">Загрузка...</div>
  <div v-else>
    <div>
      <BFormGroup
        label-cols-sm="4"
        label-cols-lg="2"
        content-cols-sm
        content-cols-lg="4"
        label-for="filter-announcement"
        label="Объявления"
      >
        <BFormSelect
          v-model="filter.announcement"
          id="filter-announcement"
          class="mb-2 me-sm-2 mb-sm-0"
          @update:modelValue="onFilterChanged"
          :options="announcementDistinctList"
        />
      </BFormGroup>
      <BFormGroup
        label-cols-sm="4"
        label-cols-lg="2"
        content-cols-sm
        content-cols-lg="4"
        label-for="filter-announcement"
        label="Выберите период:"
      >
        <VueDatePicker
          v-model="filter.dateStart"
          @update:modelValue="onFilterChanged"
        ></VueDatePicker>
        <VueDatePicker
          v-model="filter.endDate"
          @update:modelValue="onFilterChanged"
        ></VueDatePicker>
      </BFormGroup>
      <hr />
      <BTable striped hover :items="logs" :fields="fields" />
      <div class="overflow-auto">
        <b-pagination
          v-model="filter.page"
          :total-rows="count"
          per-page="10"
          @update:modelValue="onPageChange"
        ></b-pagination>
      </div>
    </div>
  </div>
</template>
