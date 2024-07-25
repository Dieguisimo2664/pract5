<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"/>
</head>
<body>
    @include('modals.modal01')

    <div class="detail-background">

        <div class="detail-background-body">

            <div class="detail-navbar">

                <a class="dn-sct1" href="#">
                    <img src="/media/arrow-left-icon.svg" alt="">
                </a>

                <h3>DETAIL VIEW</h3>

                <a class="dn-sct2" href="#">
                    <img src="/media/cart-icon.svg" alt="">
                    <span class="dn-quantity-indicator"></span>
                </a>

            </div>

            <div class="detail-view">

                <div class="dt-view-sct1">
                    <img class="dt-lg-img" src="{{ explode(',', $selectedProduct->media)[0] }}" alt="{{ $selectedProduct->name }}">
                </div>

                <div class="dt-view-sct2">

                    <div class="dt-view-sct2--sct1">

                        @foreach(explode(',', $selectedProduct->media) as $src)
                            <a class="dt-sm-img" href="#">
                                <img src="{{ $src }}" alt="">
                            </a>
                        @endforeach

                    </div>

                    <div class="dt-view-sct2--sct2">

                        <div class="dt-sct2-sct2-sc1">
                            <h2>{{ $selectedProduct->name }}</h2>
                        </div>

                        <div class="dt-sct2-sct2-sc2">
                            <div class="dt-avaliable-sizes-ctr">
                                @foreach(explode(',', $selectedProduct->sizes) as $size)
                                    <button class="dt-size-btn" data-data="{{ $size }}">{{ trim($size) }}</button>
                                @endforeach
                            </div>
                        </div>

                        <div class="dt-sct2-sct2-sc3">
                            <div class="dt-color-container">
                                <img src="{{ explode(',', $selectedProduct->media)[0] }}" alt="">
                            </div>
                        </div>

                        <div class="dt-sct2-sct2-sc4">
                            <div class="dt-p-data-sct1">sku: {{ $selectedProduct->id }}</div>
                            <div class="dt-p-data-sct2">category: {{ $selectedProduct->category }}</div>
                        </div>

                        <div class="dt-sct2-sct2-sc5">
                            <p>{{ $selectedProduct->description }}</p>
                        </div>
                        
                        <div class="dt-sct2-sct2-sc6">
                            <p class="dt-price">${{ number_format($selectedProduct->price, 2) }}</p>

                            <div class="dt-btns-container">

                                <button class="dt-add-quantity">+</button>
                                <span class="dt-show-quantity">1</span>
                                <button class="dt-sub-quantity">-</button>

                                <button class="btn-add-to-cart" data-data="{{ json_encode(['sp_data' => $selectedProduct, 's_product' => $selectedProduct->id, 's_size' => 'none', 's_quantity' => 1]) }}">
                                    ADD TO CART
                                </button>

                            </div>

                            

                        </div>
                        
                    </div>

                </div>

            </div>

            <div class="others-view">

                <div class="products-container">

                    @foreach($relatedProducts as $product)

                        <a href="/detail/{{{ base64_encode(json_encode($product->id)) }}}" class="product-body" data-data="{{ base64_encode(json_encode($product)) }}">
                            <div class="nc pb-img-container">
                                <img class="pb-img" src="{{ explode(',', $product->media)[0] }}">
                            </div>
                            <div class="nc pb-sizes-container"></div>
                            <div class="nc pb-info-container">
                                <p class="pb-name-product">{{ $product->name }}</p>
                                <span class="pb-price-product">{{ '$ ' . number_format($product->price, 2, ',', '.') }}</span> 
                            </div>
                        </a>

                    @endforeach

                </div>

            </div>

        </div>

    </div>
    @include('templates')
    
    @include('layouts.cart-view')
    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.6/dist/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <script src="{{ asset('./js/app.js') }}"></script>
</body>
</html>


