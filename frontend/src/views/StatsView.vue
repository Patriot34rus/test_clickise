<script setup lang="ts">
import {
  Chart as ChartJS,
  CategoryScale,
  LinearScale,
  PointElement,
  LineElement,
  Title,
  Tooltip,
  Legend,
} from 'chart.js'
import { Line } from 'vue-chartjs'
import { onMounted, ref } from 'vue'
import { fetchStats } from '@/fetcher'

ChartJS.register(CategoryScale, LinearScale, PointElement, LineElement, Title, Tooltip, Legend)

onMounted(() => {
  loading.value = true
  fetchStats().then((response) => {
    data.value = response
  })
  loading.value = false
})

const data = ref({
  labels: [],
  datasets: [],
})

const options = ref({
  responsive: true,
  maintainAspectRatio: false,
})

const loading = ref(false)
</script>

<template>
  <h1>Статистика</h1>
  <div v-if="loading">Загрузка ...</div>
  <div v-else>
    <Line :data="data" :options="options" />
  </div>
</template>

<style></style>
