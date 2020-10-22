const SignIn = {
    data() {
        return {
            email: '',
            password: '',
            showError: false
        }
    },
    methods: {
        submitData(event) {
            if (event) {
                event.preventDefault();
            }
            if (/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(this.email) && this.password.length > 4){
                this.$refs.signin.submit();
            } else {
                this.showError = true;
            }
        }
    },
    mounted(){
        this.email = this.$refs.oldEmail.value;
    }
}

export default SignIn;