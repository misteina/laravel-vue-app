require('./bootstrap');

import SignIn from './SignIn';
//import ToDo from './ToDo';
//import SignUp from './SignUp';

const Routes = {
    '/signin': SignIn,
    //'/signup': SignUp,
    //'/todo' : Todo
};


Vue.createApp(Routes[window.location.pathname]).mount('#app');