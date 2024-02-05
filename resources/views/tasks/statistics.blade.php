<!-- resources/views/tasks/statistics.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Top 10 Users with Highest Task Counts</h1>

    <table>
        <thead>
            <tr>
                <th>User</th>
                <th>Task Count</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($topUsers as $stat)
                <tr>
                    <td>{{ $stat->user->name }}</td>
                    <td>{{ $stat->task_count }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
