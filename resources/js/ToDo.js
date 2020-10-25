const ToDo = {
    data() {
        return {
            dateFrom: '',
            dateTo: '',
            category: 'all',
            showCategories: [],
            addDay: '',
            addHour: '00',
            addMinute: '00',
            addCategory: '',
            addTitle: '',
            addBody: '',
            todos: [],
            errors: [],
            showErrors: false,
            confirmDelete: false,
            deleteItemId: ''
        }
    },
    methods: { 
        getTodos() {
            let url = '/todo?' + new URLSearchParams(
                { "from": this.dateFrom, "to": this.dateTo, "category": this.category }
            );
            let x = this;
            let xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    x.todos = JSON.parse(this.responseText)[0] || [];
                    x.showCategories = JSON.parse(this.responseText)[1] || [];
                }
            };
            xhttp.open("GET", url, true);
            xhttp.setRequestHeader("Request-Medium", "ajax");
            xhttp.send();
        },
        addTodo() {
            this.showErrors = false;
            this.errors = [];
            if (!/^[a-z]+$/.test(this.addCategory)){
                this.errors.push('Invalid category');
            }
            if (this.addTitle.length === 0) {
                this.errors.push('Empty title field');
            }
            if (this.addBody.length === 0){
                this.errors.push('Empty body field');
            }
            if (this.addDay.length === 0){
                this.errors.push('No schedule date selected');
            }
            if (isNaN(new Date(this.addDay).getTime()) || new Date().getTime() > new Date(this.addDay).getTime()) {
                this.errors.push('Invalid schedule date');
            }
            if (this.errors.length === 0){

                let addTime = `${this.addDay} ${this.addHour}:${this.addMinute}:00`;
                let token = document.getElementsByName("csrf-token")[0].getAttribute("content");
                let xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        console.log(this.responseText);
                        if (this.responseText.hasOwnProperty('success')) {
                            location.reload();
                        } else if (this.responseText.hasOwnProperty('error')) {
                            this.errors = this.responseText.error;
                        } else {
                            this.errors = ['An error was encountered'];
                        }
                    }
                };
                xhttp.open("POST", '/todo/add', true);
                xhttp.setRequestHeader("Content-Type", "application/json");
                xhttp.setRequestHeader("X-CSRF-TOKEN", token);
                xhttp.setRequestHeader("Request-Medium", "ajax");
                xhttp.send(JSON.stringify(
                    { "category": this.addCategory, "title": this.addTitle, "body": this.addBody, "time": addTime }
                ));
            } else {
                this.showErrors = true;
            }
        },
        confirmDeleteItem(itemId){
            this.confirmDelete = true;
            this.deleteItemId = itemId;
        },
        deleteTodo() {
            this.confirmDelete = false;
            console.log(this.deleteItemId);

            for (const [key, value] of Object.entries(this.todos)) {
                if (key == this.deleteItemId){
                    delete this.todos[key];
                    break;
                }
            }
            let xhttp = new XMLHttpRequest();
            xhttp.open("POST", "/todo/delete", true);
            xhttp.setRequestHeader("X-CSRF-TOKEN", document.getElementsByName("csrf-token")[0].getAttribute("content"));
            xhttp.setRequestHeader("Content-Type", "application/json");
            xhttp.send(JSON.stringify({ "id": this.deleteItemId }));
        },
        getHour(hour) {
            hour = (parseInt(hour) - 1).toString();
            return (hour.length === 1) ? `0${hour}` : hour;
        },
        getMinute(minute) {
            minute = (parseInt(minute) - 1).toString();
            return (minute.length === 1) ? `0${minute}` : minute;
        }
    },
    mounted() {
        this.dateFrom = this.$refs.dateFrom.dataset.from;
        this.dateTo = this.$refs.dateTo.dataset.to;
        this.todos = JSON.parse(this.$refs.todoData.value)[0] || [];
        this.showCategories = JSON.parse(this.$refs.todoData.value)[1] || [];
    }
}

export default ToDo;