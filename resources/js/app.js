import SignIn from './SignIn';
import ToDo from './ToDo';
import SignUp from './SignUp';

const Routes = {
    '/signin': SignIn,
    '/signup': SignUp,
    '/todo' : ToDo
};

const Template = Routes[window.location.pathname] || null;

Vue.createApp(Template).mount('#app');