import axios from 'axios'
import type { Rule, Settings, APIResponse, AnnouncementFilter } from '@/types'

const apiClient = axios.create({
  baseURL: 'http://localhost:8080/api/', // Replace with your API base URL
  headers: {
    'Content-Type': 'application/json',
  },
})

export const fetchRules = async () => {
  try {
    const response = await apiClient.get<APIResponse<Rule[]>>('rule/list')
    return response.data
  } catch (error) {
    console.error('Error fetching rules:', error)
    throw error
  }
}

export const fetchRuleSettings = async () => {
  try {
    const response = await apiClient.get<APIResponse<Settings>>('rule/settings')
    return response.data
  } catch (error) {
    console.error('Error fetching rule settings:', error)
    throw error
  }
}

export const createRule = async (rule: Rule) => {
  try {
    const response = await apiClient.put(`rule/create`, { rule })
    return response.data
  } catch (error) {
    console.error(`Error create rule :`, error)
    throw error
  }
}

export const fetchStats = async () => {
  try {
    const response = await apiClient.get(`announcement/stats/chart`)
    return response.data
  } catch (error) {
    console.error(`Error fetch stats :`, error)
    throw error
  }
}

export const fetchLogs = async (filter: AnnouncementFilter) => {
  try {
    const response = await apiClient.post(`announcement/logs?page=${filter.page}`, filter)
    return response.data
  } catch (error) {
    console.error(`Error fetch logs :`, error)
    throw error
  }
}

export const fetchFilters = async () => {
  try {
    const response = await apiClient.get(`announcement/filter-data`)
    return response.data
  } catch (error) {
    console.error(`Error fetch filters :`, error)
    throw error
  }
}
