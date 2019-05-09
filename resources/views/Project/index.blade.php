@extends('layouts.app')

@section('content')
<style>
        .card-task {
                    background-color: skyblue;
                    color: white;
                    padding: 20px;
                    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
                    max-width: 300px;
                    margin: 20px;
                    text-align: center;
                    font-family: arial;
                    border-radius: 10px;
                    box-shadow: -1rem 0 1rem #000;
                    display: inline-block;
            
        
}
        </style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">PROJECT MANAGER</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                            <div class="card-task">
                                <h2>London</h2>
                                <p>London is the capital of England.</p>
                                </div>

                                <div class="card-task">
                                <h2>Paris</h2>
                                <p>Paris is the capital of France.</p>
                                </div>

                                <div class="card-task">
                                <h2>Tokyo</h2>
                                <p>Tokyo is the capital of Japan.</p>
                            </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Front END</div>
    
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <table class="table table-bordered" id="users-table">
                            <thead>
                                <div class="card-task">
                                    <h2>London</h2>
                                    <p>London is the capital of England.</p>
                                    </div>
    
                                    <div class="card-task">
                                    <h2>Paris</h2>
                                    <p>Paris is the capital of France.</p>
                                    </div>
    
                                    <div class="card-task">
                                    <h2>Tokyo</h2>
                                    <p>Tokyo is the capital of Japan.</p>
                                </div>
    
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



