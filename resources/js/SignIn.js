const SignIn = {
    data() {
        return {
            email: '',
            password: '',
            showError: 'none'
        }
    },
    methods: {
        submitData(event) {
            if (event) {
                event.preventDefault();
            }
            if (/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email) || password.length > 4){

            } else {
                this.showError = 'block';
            }
        }
    }
}

export default SignIn;