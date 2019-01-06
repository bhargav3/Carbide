@extends('layouts.app')
<div class="container">
    @section('content')
        @foreach(collect($cars->items())->chunk(4) as $items)
            <div class="card-deck">
                @foreach($items as $car)
                    <div class="card">
                        <img class="card-img-top" src="https://storage.googleapis.com/carbide/cars/{{$car->image}}"
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
                                    <input type="number" name="amount" autocomplete="off"
                                           onchange="updateBid('{{$car->id}}', $(this).val())">
                                </label>

                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
        {!! $cars->render() !!}
    @endsection
    <script type="text/javascript">
        let updateBid = function (car_id, amount) {
            $.ajax({
                url: "/car_bidding",
                method: 'post',
                data: {
                    "car_id": car_id,
                    "amount": amount
                }
            }).done(function (data) {
                $.notify('Your bid has been placed for ' + data.amount, 'success');
            }).fail(function (data) {
                $.notify('You need to place a bid more than ' + data.amount, 'error');
            });
        }
    </script>
</div>
