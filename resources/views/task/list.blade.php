@extends('layout')

@section('content')

<h1>Project Task List for:  "{{ $p_name->project_name }}" </h1>
<div class="new_project">
    {{-- <button type="button" class="btn btn-primary btn-lg" href="{{ route('task.create') }}"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;Add New Task</button> --}}
    <a class="btn btn-primary btn-lg" href="{{ route('task.create') }}">Add new task</a>
</div>

<table class="table table-striped">
    <thead>
      <tr>
        <th>Task Title</th>
        <th>Project Name</th>
        <th>Priority</th>
        <th>Status</th>
        <th>Actions</th>
      </tr>
    </thead>

@if ( !$task_list->isEmpty() ) 
    <tbody>
    @foreach ( $task_list as $task)
      <tr>
        <td>{{ $task->task_title }} </td>
        <td>
         
                @foreach( $users as $user) 
                    @if ( $user->id == $task->user_id )
                        <a href="{{ route('user.list', [ 'id' => $user->id ]) }}">{{ $user->name }}</a>
                    @endif
                @endforeach
                <span class="label label-jc">{{ $task->project->project_name }}</span>
    
            </td>
        <td>
            @if ( $task->priority == 0 )
                <span class="label label-info">Normal</span>
            @else
                <span class="label label-danger">High</span>
            @endif
        </td>
        <td>
           
            @if ( !$task->completed )
                {{-- <a href="" class="btn btn-warning"> Mark as completed</a> --}}
                <span class="label label-warning">Mark as completed</span>
            
            @else
                <span class="label label-success">Completed</span>
            @endif
        </td>
        <td>
            <!-- <a href="{{ route('task.edit', ['id' => $task->id]) }}" class="btn btn-primary"> edit </a> -->
            <a href="{{ route('task.view', ['id' => $task->id]) }}" class="btn btn-primary"> <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> </a>
            <a href="{{ route('task.delete', ['id' => $task->id]) }}" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>

        </td>
      </tr>

    @endforeach
    </tbody>
@else 
    <p><em>There are no tasks assigned yet</em></p>
@endif


</table>



<div class="btn-group">
    <a class="btn btn-default" href="{{ redirect()->getUrlGenerator()->previous() }}">Go Back</a>
</div>




@stop