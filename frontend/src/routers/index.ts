import { createRouter, createWebHistory } from 'vue-router'
import Home from '../pages/Home.vue'
import SurveyList from '../components/admins/surveys/SurveyList.vue'
import CompanyList from '../components/admins/companies/CompanyList.vue'
import DetailSurvey from '../components/admins/surveys/DetailSurvey.vue'
import AddSurvey from '../components/admins/surveys/AddSurvey.vue'
import Login from '../views/Config/Login.vue'
import AddCompany from '../components/admins/companies/AddCompany.vue'
import Logout from '../views/Config/Logout.vue'
import AccList from '../components/Accounts/AccList.vue'
import AccAdd from '../components/Accounts/AccAdd.vue'
const routes = [
  { 
    path: '/',
    name: 'home', 
    component: Home,
    children: [
        { path: 'surveys', component: SurveyList},
        { path: 'surveys/:id', component: DetailSurvey },
        { path: 'surveys/add', component: AddSurvey },
        { path: 'companies', component: CompanyList},
        { path: 'companies/add', component: AddCompany },
        { path: 'accounts', component: AccList },
        { path: 'accounts/add', component: AccAdd }, 
    ]
 },
 { path: '/login', component: Login },
 { path: '/logout', component: Logout},
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

export default router
