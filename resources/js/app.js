require('./bootstrap');

import SignIn from './SignIn';
import ToDo from './ToDo';
//import NotFound from './NotFound';
import SignUp from './SignUp';

const Routes = {
    '/signin': SignIn,
    '/signup': SignUp,
    '/todo' : ToDo
};

const Page = Routes[window.location.pathname] || NotFound;


Vue.createApp(Page).mount('#app');