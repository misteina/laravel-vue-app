@extends('layouts.main')

@section('content')
    @parent
    <div class="todo-list">
        <input type="hidden" ref="todoData" value="{{ json_encode($todoData) }}">
        <div class="set-options">
            <div class="date">
                <label for="dateFrom">Date From:</label>
                <input type="date" ref="dateFrom" v-model="dateFrom" class="form-control input-width" id="dateFrom" data-from="{{ date('Y-m-d') }}">
            </div>
            <div class="date">
                <label for="dateTo">Date To:</label>
                <input type="date" ref="dateTo" v-model="dateTo" class="form-control input-width" id="dateTo" data-to="{{ date('Y-m-d') }}">
            </div>
            <div class="category">
                <label for="selectCategory">Category:</label>
                <select class="custom-select" id="selectCategory" v-model="category">
                    <option selected value="all">Choose...</option>
                    <option v-for="cat in showCategories">@{{ cat }}</option>
                    <option v-if="Object.keys(showCategories).length === 0" selected>None</option>
                </select>
            </div>
          <button type="button" v-on:click="getTodos" class="btn btn-secondary btn-lg btn-block" id="list-button">List Todos</button>  
        </div>
        <div class="list">
            <div class="todo-item" v-for="(todo, time) in todos">
                <div class="todo-header">
                    <button type="button" v-on:click=confirmDeleteItem(time) data-toggle="modal" data-target="#deleteItem" class="delete-todo" aria-label="Close">
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
                        <div v-if="showErrors" class="alert alert-danger" role="alert">
                            <ul>
                                <li v-for="error in errors">@{{ error }}</li>
                            </ul>
                        </div>
                        @csrf
                        <div class="schedule-time">
                            <div class="pick-date">
                                <label for="scheduleDate">Date</label>
                                <input type="date" v-model="addDay" class="form-control" id="scheduleDate">
                            </div>
                            <div class="pick-date float-right">
                                <div  class="time-box left-side">
                                    <label for="hour">Hour</label>
                                    <select class="custom-select" id="hour" v-model="addHour">
                                        <option selected disabled value="00">HH</option>
                                        <option v-for="hour in 24">@{{ getHour(hour) }}</option>
                                    </select>
                                </div>
                                <div class="time-box right-side">
                                    <label for="minute">Min</label>
                                    <select class="custom-select" id="minute" v-model="addMinute">
                                        <option selected disabled value="00">MM</option>
                                        <option v-for="minute in 60">@{{ getMinute(minute) }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="category">Category</label>
                            <input type="text" v-model="addCategory" class="form-control" id="category">
                        </div>
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" v-model="addTitle" class="form-control" id="title">
                        </div>
                        <div class="form-group">
                            <label for="body">Body</label>
                            <textarea id="body" maxlength="500" v-model="addBody" class="form-control"></textarea>
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
    <div v-if="confirmDelete" class="modal fade" id="deleteItem" tabindex="-1" aria-labelledby="deleteItemlLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteItemLabel">Confirm Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this item?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button v-on:click="deleteTodo" type="button" class="btn btn-primary" data-dismiss="modal">Yes</button>
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