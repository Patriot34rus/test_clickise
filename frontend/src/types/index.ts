export interface Rule {
  id: number
  name: string
  pattern: string
  conditions: Condition[]
  action: Action
}

export interface Action {
  id: number
  parameter: string
  type: string
  value: number
}

export interface Condition {
  id: number
  parameterLeft: string
  parameterRight: string
  operator: string
  value: number
}

export interface Settings {
  parameters: string[]
  operators: string[]
  patterns: string[]
  actions: string[]
}

export interface Log {
  id: number
  name: string
  rule: string
  budget: number
  cpm: number
  date: string
}

export interface AnnouncementFilter {
  dateStart: string | null
  endDate: string | null
  announcement: number | null
  page: number
}

export interface APIResponse<T> {
  data: T
  message?: string
  success: boolean
}
