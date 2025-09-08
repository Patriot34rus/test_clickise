import { defineStore } from 'pinia'
import type { Rule, Settings } from '@/types'
import { fetchRules, fetchRuleSettings } from '@/fetcher'

export const useRuleStore = defineStore('rulesStore', {
  state: () => ({
    rules: [] as Rule[],
    settings: {} as Settings,
    loading: false,
    error: null as string | null,
  }),
  actions: {
    async fetchRules() {
      this.loading = true
      this.error = null
      try {
        const response = await fetchRules()
        this.rules = response.data
      } catch (err: any) {
        this.error = err.message || 'Failed to fetch rules'
      } finally {
        this.loading = false
      }
    },
    async fetchSettings() {
      this.loading = true
      this.error = null
      try {
        const response = await fetchRuleSettings()
        this.settings = response.data
      } catch (err: any) {
        this.error = err.message || 'Failed to fetch rules setting'
      } finally {
        this.loading = false
      }
    },
  },
  getters: {
    getRuleById: (state) => {
      return (ruleId: number) => state.rules.find((rule) => rule.id == ruleId)
    },
  },
})
