@extends('admin.layouts.master')

@section('pagename')
    Orders
@endsection

@section('content')
<div class="row">
    {{--  {{dd($orders)}}  --}}
    @include('admin.layouts.messages');
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="title">Orders</h4>
                <p class="category">List of all orders</p>
            </div>
            <div class="content table-responsive table-full-width">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Status</th>
                        <th>Make Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($orders as $order)
                    <tr>
                        <td>{{$order->id}}</td>
                        <td>{{$order->user->name}}</td>
                        <td>
                            @foreach ($order->products as $item)
                                {{$item->name}}
                            @endforeach
                        </td>
                        <td>
                            @foreach ($order->orderItems as $item)
                                {{$item->quantity}}
                            @endforeach
                        </td>
                        <td>
                            @if ($order->status)
                                        <span class="label label-success">Confirmed</span>
                            @else
                                        <span class="label label-warning">Pending</span>
                            @endif
                        </td>
                        <td>

                            @if($order->status)
                                {{ link_to_route('orders.pending','Pending',$order->id,['class'=>'btn btn-warning btn-sm']) }}
                            @else
                                {{ link_to_route('orders.confirm','Confirm',$order->id,['class'=>'btn btn-success btn-sm']) }}
                            @endif

                                {{ link_to_route('orders.show','See Details',$order->id,['class'=>'btn btn-info btn-sm']) }}
                        </td>
                    </tr>
                    @endforeach
                 </tbody>
                </table>

            </div>
        </div>
    </div>


</div>
@endsection
