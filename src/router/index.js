import Vue from 'vue'
import Router from 'vue-router'
import Register from '@/components/Register'
import Login from '@/components/Login'
import Post from '@/components/Post'
import ForgotPassword from '@/components/ForgotPassword'
import MyAccount from '@/components/MyAccount'

Vue.use(Router)

const router = new Router({
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
      component: Post,
      meta: { requiresAuth: true }
    },
    {
      path: '/forgot-password',
      name: 'ForgotPassword',
      component: ForgotPassword,
      meta: { requiresAuth: true }
    },
    {
      path: '/my-account',
      name: 'MyAccount',
      component: MyAccount,
      meta: { requiresAuth: true }
    },
  ]
})

// This function checks if the user is authenticated
function isAuthenticated() {
  // Replace this with actual authentication check logic
  // e.g., check for a token in localStorage or make an API request
  return !!localStorage.getItem('loggedInUserId');
}

router.beforeEach((to, from, next) => {
  // Check if the route requires authentication
  if (to.matched.some(record => record.meta.requiresAuth)) {
    // If user is not authenticated, redirect to login page
    if (!isAuthenticated()) {
      next({ name: 'Login' });
    } else {
      next();
    }
  } else {
    // If the route does not require authentication, proceed as normal
    next();
  }
});

export default router;
