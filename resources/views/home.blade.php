@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default panel-class">
                <div class="panel-heading">Characters</div>
                @foreach ($characters as $character)
                    <div class="panel-body panel-body-{{ $character->charclass->slug() }}">
                        <h4><span class="class-icon class-icon-{{ $character->charclass->slug() }}"></span> {{ $character->name }}</h4>
                        <p>{{ $character->charclass->name }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
