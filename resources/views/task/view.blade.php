@extends('layout')

@section('content')

<!--
<strong>Debug vars:</strong><br>
task_view->project->id :  {{ $task_view->project->id }} <br>
task_view->project->project_name: {{ $task_view->project->project_name }}  <br>
task_view->id: {{ $task_view->id }}<br>
-->


<div class="col-md-8">
    <h1>{{ $task_view->task_title }}</h1>

    <div class="form-group">
        <label>Description:</label>
        <p>{!! $task_view->task !!}</p>
    </div>
        

    <div class="btn-group">
        <a href="{{ route('task.edit', ['id' => $task_view->id ]) }}" class="btn btn-primary"> edit </a>
        <a class="btn btn-default" href="{{ route('task.show') }}">Go Back</a>
    </div>

    <div class="row">
        <hr>
        @if( count($images_set) > 0 ) 
            <div class="col-md-6">

                <div class="panel panel-jc">
                    <div class="panel-heading">File Task/Tugas</div>
                    <div class="panel-body">
                        <ul id="images_col">
                            @foreach ( $images_set as $image )
                                <li> 
                                    <a href="<?php echo asset("images/$image") ?>" data-lightbox="images-set">
                                        <img class="img-responsive" src="<?php echo asset("images/$image") ?>">
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

            </div>
        @endif


        
        @if( count($files_set) > 0 ) 
            <div class="col-md-6">

                <div class="panel panel-jc">
                    <div class="panel-heading"> File Task/Tugas</div>
                    <div class="panel-body">
                        <ul id="images_col">
                            @foreach ( $files_set as $file )
                                <li> 
                                    <a target="_blank" href="<?php echo asset("images/$file") ; ?>">{{ $file }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

            </div>
        @endif


    </div>
    {{-- submited task --}}
    @if( count($submit) >0 ) 
    <div>
            
            {{-- <span class="label label-success">Telah Disubmit</span> --}}
            
            @if( count($submit_images_set) > 0 ) 
            <div class="col-md-6">

                <div class="panel panel-jc">
                    <div class="panel-heading">Uploaded Submit Task</div>
                    <div class="panel-body">
                        <ul id="images_col">
                            @foreach ( $submit_images_set as $image )
                                <li> 
                                    <a href="<?php echo asset("images/submit_file/$image") ?>" data-lightbox="images-set">
                                        <img class="img-responsive" src="<?php echo asset("images/submit_file/$image") ?>">
                                    </a>
                                </li>
                              
                            @endforeach
                            
                        </ul>
                        
                    </div>
                </div>
               
            </div>
            <div class="col-md-3">
            
            
        @endif


        
        @if( count($submit_files_set) > 0 ) 
            <div class="col-md-6">

                <div class="panel panel-jc">
                    <div class="panel-heading"> Uploaded Submit Task</div>
                    <div class="panel-body">
                        <ul id="images_col">
                            @foreach ( $submit_files_set as $file )
                                <li> 
                                    <a target="_blank" href="<?php echo asset("images/submit_file/$file") ; ?>">{{ $file }}</a>
                                </li>
                            @endforeach
                            
                        </ul>
                    </div>
                </div>

            </div>
        @endif
        
            </div>
        @if( count($nilai) > 0 ) 
        <h3>Nilai : {{$nilai[0]->nilai}}</h3>
        @endif
        @if( count($nilai) == 0 ) 
            <form action="{{ route('task.submitnilai') }}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="task_id" value="{{$task_id}}">
                    <input type="hidden" name="user_id" value="{{$user_id}}">

                    <input type="text" name="nilai" placeholder="nilai rentang 0-100">
                    <input class="btn btn-primary" type="submit" value="Submit Nilai" >

                </form>
        @endif
        
       
    @else
    @if( count($nilai) > 0 ) 
    
    <h3>Nilai : {{$nilai[0]->nilai}}</h3>
    @endif
    <span class="label label-danger">Belum disubmit</span>
    

@endif
@if ( $task_view->completed == 0 )
                
@if ( $is_overdue )
    <span class="label label-danger">Overdue</span>
    <form action="{{ route('task.submitnilai') }}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="task_id" value="{{$task_id}}">
            <input type="hidden" name="user_id" value="{{$user_id}}">

            <input type="text" name="nilai" placeholder="nilai rentang 0-100">
            <input class="btn btn-primary" type="submit" value="Submit Nilai" >

        </form>
@endif
@endif 


</div>

<div class="col-md-4">


    <div class="panel panel-jc">
        <div class="panel-heading">Project</div>
        <div class="panel-body">
            <span class="label label-jc">
                <a href="{{ route('task.list', [ 'projectid' => $task_view->project->id ]) }}">{{ $task_view->project->project_name }}</a>
            </span>
        </div>
    </div>

    <div class="panel panel-jc">
        <div class="panel-heading">Priority</div>
        <div class="panel-body">
            @if ( $task_view->priority == 0 )
                <span class="label label-info">Normal</span>
            @else
                <span class="label label-danger">High</span>
            @endif
        </div>
    </div>



    <div class="panel panel-jc">
        <div class="panel-heading">Created</div>
        <div class="panel-body">
            {{ $formatted_from }} 
        </div>
    </div>

    <div class="panel panel-jc">
        <div class="panel-heading">Due Date</div>
        <div class="panel-body">
            {{ $formatted_to }} 
        </div>
    </div>


    <div class="panel panel-jc">
        <div class="panel-heading">Status</div>
        <div class="panel-body">
            @if ( $task_view->completed == 0 )
                <span class="label label-warning">Open</span>
                @if ( $is_overdue )
                    <span class="label label-danger">Overdue</span>
                @else
                    <p><br>{{ $diff_in_days }} days left to complete this task</p>
                @endif                
            @else
                <span class="label label-success">Done/Telah Selesai</span>
            @endif
        </div>
    </div>

</div>

@stop

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/lightbox.min.css') }}">
@stop


@section('scripts')
    <script src="{{ asset('js/lightbox.min.js') }}"></script>  

@stop


