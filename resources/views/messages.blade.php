@extends('layouts.app')

@section('content')
    <script>
        window.setInterval(function() {
            var elem = document.getElementById('messDiv');
            elem.scrollTop = elem.scrollHeight;
        }, 5000);
    </script>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="well">
                    <div class="card-header">Chat with <strong>{{$user_det->name}}</strong> </div>

                    <div id="messDiv" class="card-body" style="overflow-y:scroll; height:300px;">
                        @if(count ($messages )> 0 && !is_null($messages))
                            @foreach($messages as $message)
                                @if( Auth::id() == $message->user_id)
                                    <div class="col-12" style="background-color: #cce3f6;border-radius: 2px">
                                        <small style="color: #686868">You</small>
                                        <p align="right">{{$message->message}}</p>
                                    </div>

                                @else
                                    <div class="col-12" style="background-color: #98e1b7;border-radius: 2px">
                                        <small align="left" style="color: #686868">{{$user_det->name}}</small>
                                        <p align="left">{{$message->message}}</p>
                                    </div>
                                @endif

                            @endforeach
                        @else
                            <p align="center" style="color: #686868">No chats yet!</p>
                        @endif
                    </div>
                    <div class="card-footer col-12">
                        @include('inc.alert')
                        {!! Form::open(['action' => 'MessageController@store','method' => 'POST']) !!}
                            <div class="form-group">

                                {{Form::textarea('message','',['class' => 'form-control','placeholder' => 'Type Message..','style' => 'height:100px'])}}
                                <input name="invisible" type="hidden" value="{{$table_name}}">
                            </div>
                            <div class="form-group">
                                {{Form::submit('Send',['class' => 'btn btn-primary btn-block'])}}
                            </div>
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
