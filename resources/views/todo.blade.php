@extends('layouts.main')

@section('content')
    @parent
    <div class="todo-list">
        <input type="hidden" ref="todoData" value="{{ json_encode($todoData) }}">
        <div class="set-options">
            <div class="date">
                <label for="dateFrom">Date From:</label>
                <input type="date" ref="dateFrom" v-model="dateFrom" class="form-control input-width" id="dateFrom" value="{{ date('Y-m-d') }}">
            </div>
            <div class="date">
                <label for="dateTo">Date To:</label>
                <input type="date" ref="dateTo" v-model="dateTo" class="form-control input-width" id="dateTo" value="{{ date('Y-m-d') }}">
            </div>
            <div class="category">
                <label for="selectCategory">Category:</label>
                <select class="custom-select" id="selectCategory" v-model="category">
                    <option selected value="all">Choose...</option>
                    <option v-for="cat in filterCategory" value="@{{ cat.category }}">@{{ cat.category }}</option>
                    <option v-if="Object.keys(filterCategory).length === 0" selected>None</option>
                </select>
            </div>
          <button type="button" v-on:click="getTodos" class="btn btn-secondary btn-lg btn-block" id="list-button">List Todos</button>  
        </div>
        <div class="list">
            <div class="todo-item" v-for="(todo, time) in todos">
                <div class="todo-header">
                    <button type="button" v-on:click="deleteTodo(time)" class="delete-todo" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="todo-title">@{{ todo.title }}</div><div class="todo-time">@{{ time }}</div>
                </div>
                <div class="todo-body">
                    <p>@{{ todo.body }}</p>
                </div>
            </div>
            <div v-if="Object.keys(todos).length === 0" class="no-todos">No Todos available</div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Todo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="category">Category</label>
                            <input type="text" v-model="category" class="form-control" id="category">
                        </div>
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" v-model="title" class="form-control" id="title">
                        </div>
                        <div class="form-group">
                            <label for="body">Body</label>
                            <textarea id="body" v-model="body" class="form-control"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" v-on:click="addTodo" class="btn btn-primary add-todo-button">Add</button>
                </div>
            </div>
        </div>
    </div>
    <div class="fixed-bottom fixed-footer">
        <button type="button" class="btn btn-primary btn-lg btn-block" id="add-todo" data-toggle="modal" data-target="#exampleModal">
            <b>Add Todo</b>
        </button>
    </div>
@endsection