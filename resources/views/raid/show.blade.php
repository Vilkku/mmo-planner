@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $raid->name }}</div>
                    <div class="panel-body">
                        <p>{{ $raid->description }}</p>
                    </div>
                </div>
                @if (!empty($characters))
                    <div class="panel panel-default">
                        <div class="panel-heading">Sign up</div>
                        <div class="panel-body">
                            {!! Form::open(['url' => route('raidSignUp', ['id' => $raid->id])]) !!}
                            <div class="form-group">
                                {!! Form::label('character', 'Character') !!}
                                {!! Form::select('character', $characters->pluck('name', 'id')->all(), null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('status', 'Status') !!}
                                {!! Form::select('status', $statuses->pluck('name', 'id')->all(), null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('role', 'Role') !!}
                                {!! Form::select('role', $roles->pluck('name', 'id')->all(), null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::submit('Sign up', ['class' => 'btn btn-default']) !!}
                            </div>
                        {!! Form::close() !!}
                        </div>
                    </div>
                @endif
                <div class="panel panel-default">
                    <div class="panel-heading">Signups</div>
                    <div class="panel-body">
                        @foreach ($signups as $status => $statusSignups)
                            <h3>{{ $status }}</h3>
                            <ul>
                                @foreach ($statusSignups as $signup)
                                    <li>{{ $signup->character->name }}</li>
                                @endforeach
                            </ul>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection