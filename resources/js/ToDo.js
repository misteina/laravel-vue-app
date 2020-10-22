const ToDo = {
    data() {
        return {
            dateFrom: '',
            dateTo: '',
            showError: false
        }
    },
    methods: {
        submitData(event) {
            if (event) {
                event.preventDefault();
            }
        }   
    },
    mounted() {
        this.dateFrom = this.$refs.dateFrom.value;
        this.dateTo = this.$refs.dateTo.value;
    }
}

export default ToDo;