const initial = document.getElementById("oldEmail").value;

const SignIn = {
    data() {
        return {
            email: initial,
            password: '',
            showError: 'display: none'
        }
    },
    methods: {
        submitData(event) {
            if (event) {
                event.preventDefault();
            }
            if (/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(this.email) && this.password.length > 4){
                document.getElementById("signin").submit();
            } else {
                this.showError = 'display: block';
            }
        }
    }
}

export default SignIn;