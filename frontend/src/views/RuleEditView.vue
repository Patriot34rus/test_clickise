<script setup lang="ts">
import { onMounted, computed, ref, watch } from 'vue'
import { useRuleStore } from '@/stores/rules.ts'
import { useRoute } from 'vue-router'
import type { Action, Condition } from '@/types'
import { createRule } from '@/fetcher'

const ruleStore = useRuleStore()
const route = useRoute()

onMounted(() => {
  ruleStore.fetchSettings()
  ruleStore.fetchRules()
})

const rule = computed(() => ruleStore.getRuleById(Number(route.params.ruleId)))

const form = ref({
  id: 0,
  name: '',
  pattern: '',
  conditions: [] as Condition[],
  action: {} as Action,
})

let loading = ref<boolean>(false)

function validateConditionsCount() {
  const count = form.value.pattern === 'if_then' ? 1 : 2
  const conditionsCount = form.value.conditions.length

  if (conditionsCount === count) {
    return
  }
  if (conditionsCount > count) {
    form.value.conditions = form.value.conditions.slice(conditionsCount - count)
  }

  if (conditionsCount < count) {
    for (let i = conditionsCount; i < count; i++) {
      form.value.conditions.push({
        id: 0,
        parameterLeft: '',
        parameterRight: '',
        operator: '',
        value: 0,
      })
    }
  }
}

watch(
  rule,
  (newRule) => {
    if (newRule) {
      form.value = JSON.parse(JSON.stringify(newRule))
    }
  },
  { immediate: true },
)

const onSubmit = async () => {
  loading.value = true
  try {
    createRule(form.value)
  } catch (error) {
  } finally {
    loading.value = false
  }
}

function onChangedPattern(newDate: any) {
  validateConditionsCount()
}

const onChangeParameter = () => {}
</script>

<template>
  <div>
    <h1>Правила</h1>
    <div v-if="loading">Загрузка...</div>
    <div v-else>
      <BForm @submit.prevent="onSubmit">
        <BFormGroup
          label-cols-sm="4"
          label-cols-lg="2"
          content-cols-sm
          content-cols-lg="4"
          id="input-group-1"
          label="Название"
          label-for="name"
        >
          <BFormInput id="name" v-model="form.name" type="text" required />
        </BFormGroup>

        <BFormGroup
          label-cols-sm="4"
          label-cols-lg="2"
          content-cols-sm
          content-cols-lg="4"
          id="input-group-1"
          label="Шаблон правила"
          label-for="pattern"
        >
          <BFormSelect
            id="inline-form-custom-select-pref"
            v-model="form.pattern"
            class="mb-2 me-sm-2 mb-sm-0"
            @update:modelValue="onChangedPattern"
            :options="ruleStore.settings?.patterns"
          />
        </BFormGroup>
        <hr />
        <label class="col-form-label col-lg-2 me-sm-2" for="inline-form-custom-select-pref"
          >Условие</label
        >
        <div v-for="item in form?.conditions" :key="item.id">
          <div class="row">
            <div class="col-lg-2">
              <BFormSelect
                id="inline-form-custom-select-pref"
                v-model="item.parameterLeft"
                class="mb-2 me-sm-2 mb-sm-0"
                :options="ruleStore.settings?.parameters"
              />
            </div>
            <div class="col-lg-2">
              <BFormSelect
                id="inline-form-custom-select-pref"
                v-model="item.operator"
                class="mb-2 me-sm-2 mb-sm-0"
                :options="ruleStore.settings?.operators"
              />
            </div>
            <div class="col-lg-2">
              <BFormSelect
                id="inline-form-custom-select-pref"
                v-model="item.parameterRight"
                class="mb-2 me-sm-2 mb-sm-0"
                @change="onChangeParameter"
                :options="ruleStore.settings?.parameters"
              />
            </div>
            <div class="col-lg-2">
              <BFormInput id="input-1" v-model="item.value" type="text" />
            </div>
          </div>
        </div>
        <hr />
        <label class="col-form-label col-lg-2 me-sm-2" for="inline-form-custom-select-pref"
          >Операция</label
        >
        <div class="row">
          <div class="col-lg-2">
            <BFormSelect
              id="inline-form-custom-select-pref"
              v-model="form.action.type"
              class="mb-2 me-sm-2 mb-sm-0"
              :options="ruleStore.settings?.actions"
            />
          </div>
          <div class="col-lg-2">
            <BFormSelect
              id="inline-form-custom-select-pref"
              v-model="form.action.parameter"
              class="mb-2 me-sm-2 mb-sm-0"
              @change="onChangeParameter"
              :options="['budget', 'cpm']"
            />
          </div>
          <div class="col-lg-2">
            <BFormInput id="input-1" v-model="form.action.value" type="text" />
          </div>
        </div>
        <hr />
        <div class="col-lg-2 col-form-label">
          <BButton type="submit" variant="primary">Сохранить</BButton>
        </div>
      </BForm>
    </div>
  </div>
</template>

<style></style>
