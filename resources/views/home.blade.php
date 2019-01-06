@extends('layouts.app')

@section('content')
    <div id="app">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Dashboard</div>

                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <h1>Your biddings</h1>
                            @foreach(collect($cars->items())->chunk(4) as $items)
                                <div class="card-deck">
                                    @foreach($items as $car)
                                        <div class="card">
                                            <img class="card-img-top"
                                                 src="https://storage.googleapis.com/carbide/cars/{{$car->image}}"
                                                 alt="{{$car->model}}">
                                            <div class="card-body">
                                                <h5 class="card-title">{{$car->make}}</h5>
                                                <p>{{$car->year}} {{$car->model}}</p>
                                                <p class="card-text">
                                                    <small class="text-muted">{{$car->body_style}}</small>
                                                </p>
                                                <p>
                                                    <span>Current Bid</span>
                                                    <label for="amount">
                                                        <input type="text"
                                                               onchange="$.notify('Value updated', 'success')"
                                                               name="amount" autocomplete="off">
                                                    </label>
                                                </p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                            {!! $cars->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
