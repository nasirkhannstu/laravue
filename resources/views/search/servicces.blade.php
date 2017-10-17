@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Notifications</div>

                <div class="panel-body">
                    @foreach($nots as $not)
                    <li>
                        {{$not->data['name']}} &nbsp {{$not->data['data']}} <span class="pull-right">{{$not->created_at->diffForHumans()}}</span>
                    </li>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
