@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="well">
                <div class="card-header">Users</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @if($user->isOnline())
                            user is online!!
                        @endif
                    @endif
                        @if(count ($user_details )> 0)
                            @foreach ($user_details as $user)
                                <a class="list-group-item" href="/chat/{{$user->id}}">
                                    <strong> {{$user -> name}} </strong>
                                    @if($user->status)
                                        <small class="pull-right" style="color: green">online</small>
                                    @else
                                        <small class="pull-right" style="color:red">offline</small>
                                    @endif
                                </a>
                            @endforeach
                        @else
                            <p>No user Found!</p>
                        @endif


                    {{--<a class="list-group-item" href="">--}}
                        {{--<strong> Rashedd </strong> <small class="pull-right" style="color: red">offline</small>--}}
                    {{--</a>--}}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
