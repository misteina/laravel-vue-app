const SignUp = {
    data() {
        return {
            name: '',
            email: '',
            password: '',
            verifyPassword: '',
            showError: false,
            errors: []
        }
    },
    methods: {
        submitData(event) {
            if (event) {
                event.preventDefault();
            }
            this.errors = [];
            if (!/^[a-zA-Z ]+$/.test(this.name)){
                this.errors.push('Invalid name');
            }
            if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(this.email)){
                this.errors.push('Invalid email');
            }
            if (this.password.length < 4) {
                this.errors.push('Invalid password');
            }
            if (this.password !== this.verifyPassword){
                this.errors.push('Password mismatch');
            }

            if (this.errors.length === 0){
                this.$refs.signup.submit();
            } else {
                this.showError = true;
            }
        }
    },
    mounted(){
        this.email = this.$refs.oldEmail.value;
        this.name = this.$refs.oldName.value;
    }
}

export default SignUp;