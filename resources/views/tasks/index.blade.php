@extends('layouts.app')

@section('content')

{{-- container for tasks display --}}
<div class="container col-md-8 justify-content-center">
    {{-- session message --}}
    @if (session()->has('success'))
    <div class="alert alert-success" style="display: flex; align-items: center;">
        {{ session()->get('success') }}
        <button type="button" class="close" aria-hidden="true" style="margin-left: auto; margin-right: 0;"
            onclick="this.parentElement.style.display='none'">X</button>
    </div>
    @elseif (session()->has('error'))
    <div class="alert alert-danger" style="display: flex; align-items: center;">
        {{ session()->get('error') }}
        <button type="button" class="close" aria-hidden="true" style="margin-left: auto; margin-right: 0;"
            onclick="this.parentElement.style.display='none'">x</button>
    </div>
    @endif
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-7 col-sm-12">
                    <!-- Adjust column widths as needed -->
                    <h3>Wise360 <b>Task</b></h3>
                </div>
                <div class="col-md-5 col-sm-12 d-flex justify-content-end ">
                    <!-- Adjust column widths as needed -->
                    {{-- <a href="#" class="btn btn-warning btn-regular align-items-center mr-2">
                        <i class="bi bi-sort-down mr-1"></i> Sort by Priority
                    </a> --}}
                    <a class="btn btn-success btn-regular align-items-center" data-toggle="modal"
                        data-target="#addTask">
                        <i class="bi bi-patch-plus mr-1"></i> Add task
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-center">
                <table class="table table-hover" id="myTable">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Assigned_to</th>
                            <th scope="col">Status</th>
                            @role('admin')
                            <th scope="col">Action</th>
                            @endrole
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = ($tasks->currentPage() - 1) * $tasks->perPage() + 1; ?>
                        @foreach ($tasks as $task)
                        <tr>
                            <td>
                                {{ $i++ }}
                            </td>
                            <td>{{ $task->title }}</td>
                            <td>{{ $task->description }}</td>
                            <td>{{ $task->user->name ?? 'N/A' }}</td>
                            <td>
                                @if($task->status == 0)
                                <span class="badge badge-warning" style="color: black;">
                                    <i class="bi bi-exclamation-triangle-fill"></i> Pending
                                </span>
                                @else
                                <span class="badge" style="background-color: rgb(154, 248, 30); color:black">
                                    <i class="bi bi-check-circle-fill"></i> Completed
                                </span>
                                @endif
                            </td>
                            @role('admin')
                            <td>
                                <span>
                                    <a class="btn btn-icon btn-sm btn-warning update_task" data-toggle="modal"
                                        data-target="#editTask" title="Edit" data-id="{{ $task->id }}"
                                        data-title="{{ $task->title }}" data-description="{{ $task->description }}"
                                        data-status="{{ $task->status }}" data-assigned_to="{{ $task->assigned_to }}">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>

                                    <a class="btn btn-icon btn-sm btn-danger" title="Delete" style="color: black">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </span>
                            </td>
                            @endrole
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- displaying Paginations --}}
            <div class="d-flex justify-content-start">
                <ul class="pagination">
                    {{ $tasks->links('pagination::bootstrap-4') }}
                </ul>
            </div>

        </div>
    </div>
</div>

@include('tasks.create')
@include('tasks.edit')
@endsection
