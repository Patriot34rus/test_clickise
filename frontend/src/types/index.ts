export interface Rule {
  id: number
  name: string
  pattern: string
}

export interface Condition {
  id: number
  parameterLeft: string
  parameterRight: string
  value: number
  ruleId: number
}

export interface APIResponse<T> {
  data: T
  message?: string
  success: boolean
}
