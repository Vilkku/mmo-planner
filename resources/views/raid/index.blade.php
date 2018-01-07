@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Raids</div>
                    @foreach ($raids as $raid)
                        <div class="panel-body">
                            <h4><a href="{{ route('raid', ['id' => $raid->id]) }}">{{ $raid->name }}</a></h4>
                            <p>{{ $raid->start_time }} - {{ $raid->end_time }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection