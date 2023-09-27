@extends('layouts.admin_master')


@section('admin_content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                    <div class="card-header mt-2">
                        <h2>Filter Order</h2>
                    </div>
                
            </div>
            <div class="col-md-4 mt-2">
                <form action="{{ url('order/filter')  }} " method="POST">
                    @csrf
                    <div><h3 class="text-secondary">Filter By:</h3></div>
                    <div class="input-group mb-3">
                        
                        <select name="filter_by" class="form-select" id="inputGroupSelect02">
                            <option value="id">Order ID</option>
                            <option value="customer_no">Customer Number</option>
                            <option value="order_status">Order Status</option>
                        </select>
                        
                        <input type="text" name="search_key" class="form-control" placeholder="Search">
                        
                    </div>
                    <button type="submit" class="fs-4 px-5 input-group-text bg-success" for="inputGroupSelect02">Filter</button>
                </form>
            </div>

        </div>
        <div class="row ">
            <div class="col-md-12">
                <div class="card-header mt-2">
                    <h2>Order Details</h2>
                </div>
                
                @if(session('success')) 
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong> {{ session('success') }} </strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <table class="table">
                    <thead>
                        <th scope="col">SI NO</th>
                        <th scope="col">Customer Name</th>
                        <th scope="col">Customer Adress</th>
                        <th scope="col">Customer Number </th>
                        <th scope="col">Ordered Date</th>
                        <th scope="col">Status Message </th>
                        <th scope="col">Action</th>

                    </thead>
                    <tbody>
                        

                        @foreach ($orders as $order)
                            <tr>
                                <th scope="row">{{ $orders->firstItem()+$loop->index }}</th>
                                <td> {{$order->customer_name}} </td>
                                <td> 
                                    {{ $order->customer_address }}
                                </td>
                                <td> {{$order->customer_no}} </td>
                                
                                <td>{{ $order->created_at->format('d-m-Y h:i A') }}</td>
                                <td class="order_status_msg"> {{ $order->order_status }} </td>
                                <td class="">
                                    <a href=" {{ url('Order/View/'.$order->id ) }} " class="btn btn-success admin-order-action-list ">View</a>
                                    <a href=" {{ url('Delete/Order/'.$order->id ) }} "  class="btn btn-danger admin-order-action-list" onclick="return confirm( 'Are you sure you want to cancel the order?' )">Delete</a>

                                </td>
                                
                            </tr>
                        @endforeach
                    </tbody>

                </table>
                {{ $orders->links('pagination::bootstrap-5')  }}

            </div>
        </div>
    </div>
@endsection








