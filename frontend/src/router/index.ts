import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import RulesView from '../views/RulesView.vue'
import RuleEditView from '../views/RuleEditView.vue'
import StatsView from '../views/StatsView.vue'
import LogsView from '../views/LogsView.vue'
import MainLayout from '@/layouts/MainLayout.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: MainLayout,
      children: [
        { path: '', name: 'main', component: HomeView },
        { path: '/rules', name: 'rules', component: RulesView },
        { path: '/rule/edit/:ruleId', name: 'rule.edit', component: RuleEditView },
        { path: '/rule/new', name: 'rule.new', component: RuleEditView },
        { path: '/stats', name: 'stats', component: StatsView },
        { path: '/logs', name: 'logs', component: LogsView },
      ],
    },
  ],
})

export default router
