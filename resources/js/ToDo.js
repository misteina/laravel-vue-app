const ToDo = {
    data() {
        return {
            dateFrom: '',
            dateTo: '',
            filterCategory: [],
            category: 'all',
            title: '',
            body: '',
            todos: [],
        }
    },
    methods: {
        getTodos() {
            fetch('/todo', {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(
                    { from: dateFrom, to: dateTo, category: filterCategory, ajax: true}
                )
            }).then(
                response => response.json()
            ).then(
                data => {
                    if (data.length > 0) {
                        this.todos = data[0];
                        this.filterCategory = data[1];
                    } else {
                        this.todos = [];
                        this.filterCategory = [];

                    }
                }
            );
        },
        addTodo() {
            fetch('/todo/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.getElementsByName("csrf-token")[0].getAttribute("content")
                },
                body: JSON.stringify(
                    { category: category, title: title, body: body }
                )
            }).then(
                response => response.json()
            ).then(
                data => array_unshift(this.todos, data)
            );
        },
        deleteTodo(time) {
            fetch('/todo/delete', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.getElementsByName("csrf-token")[0].getAttribute("content")
                },
                body: JSON.stringify({ id: time })
            }).then(
                response => response.json()
            ).then(
                data => {
                    if (data.length > 0) {
                        array_unshift(this.todos, data);
                    } else {
                        this.todos = [];
                        this.filterCategory = [];
                    }
                }
            );
        }
    },
    mounted() {
        this.dateFrom = this.$refs.dateFrom.value;
        this.dateTo = this.$refs.dateTo.value;
        this.todos = JSON.parse(this.$refs.todoData.value)[0];
        this.filterCategory = JSON.parse(this.$refs.todoData.value)[1];
    }
}

export default ToDo;