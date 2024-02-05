@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Create Task</h2>
        <form method="post" action="{{ route('tasks.store') }}">
            @csrf
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
            </div>
            <div class="form-group">
                <label for="assigned_to_id">Assigned To:</label>
                <select class="form-control" id="assigned_to_id" name="assigned_to_id" required>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Create Task</button>
        </form>
    </div>
@endsection
