@extends('layouts.user-layout')

@section('content')
<div class="row vh-100">
    <!-- Menu Content -->
    <div class="col-md-9 p-4" style="overflow-y: auto; max-height: 100vh;">
        <div class="sticky-top shadow form-floating bg-white mb-4 rounded">
            <input type="text" class="form-control"  id="searchInput" name="searchInput" placeholder="Find what you want...">
            <label for="floatingInput">Find what you want...</label>
        </div>
        
        <!-- Menu Items --> 
        <div class="row">
            @foreach ($menus as $menu)
                <div class="col-md-3 mb-4">
                    <div class="card shadow">
                        @if ($menu->image)
                            <img src="{{ asset('upload/menus-img/' . $menu->image) }}" class="card-img-top" alt="{{ $menu->menu_name }}">
                        @else
                            <img src="{{ asset('assets/img/Caffeine-default.png') }}" class="card-img-top" alt="{{ $menu->menu_name }}">
                        @endif
                        <div class="card-body text-center">
                            <h5 class="card-title text-center fw-bold">{{ $menu->menu_name }}</h5>
                            <p class="card-text text-start">{{ $menu->description }}</p>
                            <p class="card-text text-start fw-bold">{{ number_format($menu->price, 2) }}</p>
                            @if($menu->isAvailable)
                                <!-- Form to add item to order -->
                                <form action="{{ route('menu.addToOrder', $menu->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-dark">Add to Order</button>
                                </form>
                            @else
                                <button class="btn btn-outline-secondary" disabled>Out of Stock</button>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Order Summary -->
    <div class="col-md-3 d-flex flex-column bg-white p-4" style="max-height: 100vh;">
        <h4 class="mb-3">Table 4</h4>
        <hr>
        <!-- Order Items -->
        <div class="order-list flex-grow-1 overflow-auto" style="max-height: 70vh;">
            @foreach ($orders as $order)
                <div class="d-flex justify-content-between align-items-center mb-2 p-2 border rounded">
                    <div>
                        <h6 class="mb-0">{{ $order['name'] }}</h6>
                        <small>{{ number_format($order['price'], 2) }} x {{ $order['quantity'] }}</small>
                    </div>
                    <span class="fw-bold">{{ number_format($order['price'] * $order['quantity'], 2) }}</span>
                    
                </div>
            @endforeach
        </div>
        <hr>
        
        <!-- Order Total at Bottom -->
        <div class="mt-auto">
            <div class="d-flex justify-content-between mb-3">
                <h5>Total:</h5>
                @if($total > 0)
                    <h5>Rp.{{ number_format($total, 2) }}</h5>
                @else
                    <h5></h5>
                @endif
            </div>
            <button class="btn btn-primary w-100">Place Order</button>
        </div>
    </div>
</div>
@endsection
