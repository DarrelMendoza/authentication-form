import Vue from 'vue'
import Router from 'vue-router'
import Register from '@/components/Register'
import Login from '@/components/Login'
import Post from '@/components/Post'
import ForgotPassword from '@/components/ForgotPassword'
import MyAccount from '@/components/MyAccount'


Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'Login',
      component: Login
    },
    {
      path: '/register',
      name: 'Register',
      component: Register
    },
    {
      path: '/login',
      name: 'Login',
      component: Login
    },
    {
      path: '/post',
      name: 'Post',
      component: Post
    },
    {
      path: '/forgot-password',
      name: 'ForgotPassword',
      component: ForgotPassword
    },
    {
      path: '/my-account',
      name: 'MyAccount',
      component: MyAccount
    },

  ]
})