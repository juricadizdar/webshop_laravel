@extends('layouts.admin')

@section('body')

<div class="table-responsive">
    <table class="table table-striped">
	<h3>List of orders</h3>
        <thead>
        <tr>
            <th>Id</th>
			<th>Name</th>
			<th>Address</th>
            <th>Order date</th>
			<th>Delivery date</th>
			<th>Status</th>
			<th>Paid</th>
            <th>Amount</th>
        </tr>
        </thead>
        <tbody>

        @foreach($orders as $order)
        <tr>

            <td>{{$order['id']}}</td>
            <td>{{$order['first_name']." ".$order['last_name']}}</td>
			<td>{{$order['address'].", ".$order['city'].", ".$order['zip'].", ".$order['state']}}</td>
            <td>{{$order['date']}}</td>
            <td>{{$order['del_date']}}</td>
			<td>{{$order['status']}}</td>
			<td>@if($order->payment['status'] == null) NO @else {{$order->payment['status']}} @endif</td>
			<td>{{$order['price']." HRK"}}</td>
			
        </tr>
        @endforeach

        </tbody>
    </table>
	{{ $orders->links() }}
</div>
@endsection