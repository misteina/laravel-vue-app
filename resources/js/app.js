require('./bootstrap');

import SignIn from './SignIn';
import ToDo from './ToDo';
import SignUp from './SignUp';


const routes = {
    '/signIn': SignIn,
    '/SignUp': SignUp,
    '/todo': ToDo
}

const App = {
    data: () => ({
        currentRoute: window.location.pathname
    }),

    computed: {
        CurrentComponent() {
            return routes[this.currentRoute] || NotFoundComponent
        }
    },

    render() {
        return Vue.h(this.CurrentComponent)
    }
}

Vue.createApp(App).mount('#app');