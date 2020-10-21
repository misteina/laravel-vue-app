@extends('layouts.main')

@section('content')
    @parent
    <div class="todo-list">
        <div class="set-options">
            <div class="date">
                <label for="dateFrom">Date From:</label>
                <input type="date" class="form-control input-width" id="dateFrom" placeholder="yyyy-mm-dd">
            </div>
            <div class="date">
                <label for="dateTo">Date To:</label>
                <input type="date" class="form-control input-width" id="dateTo" placeholder="yyyy-mm-dd">
            </div>
            <div class="category">
                <label for="selectCategory">Category:</label>
                <select class="custom-select" id="selectCategory">
                    <option selected>Choose...</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
            </div>
          <button type="button" class="btn btn-secondary btn-lg btn-block" id="list-button">List Todos</button>  
        </div>
        <div class="list">
            <div class="todo-item">
                <div class="todo-header">
                    <button type="button" class="delete-todo" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="todo-title">Modal title</div><div class="todo-time">2020-12-2 12:03</div>
                </div>
                <div class="todo-body">
                    <p>Modal body text goes here.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="fixed-bottom fixed-footer">
        <button type="button" class="btn btn-primary btn-lg btn-block" id="add-todo">
            <b>Add Todo</b>
        </button>
    </div>
@endsection