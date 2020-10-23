@extends('layouts.main')

@section('content')
    @parent
    <div class="todo-list">
        <div class="set-options">
            <div class="date">
                <label for="dateFrom">Date From:</label>
                <input type="date" class="form-control input-width" id="dateFrom" value="{{ date('Y-m-d') }}">
            </div>
            <div class="date">
                <label for="dateTo">Date To:</label>
                <input type="date" class="form-control input-width" id="dateTo" value="{{ date('Y-m-d') }}">
            </div>
            <div class="category">
                <label for="selectCategory">Category:</label>
                <select class="custom-select" id="selectCategory">
                    @if (count($todoData) > 0)
                        <option selected>Choose...</option>
                        @foreach ($todoData[1] as $category)
                            <option value="{{ $category }}">{{ $category }}</option>
                        @endforeach
                    @else
                        <option selected>None</option>
                    @endif
                </select>
            </div>
          <button type="button" class="btn btn-secondary btn-lg btn-block" id="list-button">List Todos</button>  
        </div>
        <div class="list">
            @if (count($todoData) > 0)
                @foreach ($todoData[0] as $time => $todo)
                    <div class="todo-item">
                        <div class="todo-header">
                            <button type="button" class="delete-todo" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div class="todo-title">{{ $todo['title'] }}</div><div class="todo-time">{{ $time }}</div>
                        </div>
                        <div class="todo-body">
                            <p>{{ $todo['body'] }}</p>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="no-todos">No Todos available</div>
            @endif
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
                            <input type="text" class="form-control" id="category">
                        </div>
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title">
                        </div>
                        <div class="form-group">
                            <label for="body">Body</label>
                            <textarea id="body" class="form-control"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary add-todo-button">Add</button>
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