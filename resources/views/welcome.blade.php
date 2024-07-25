<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous"
    />
</head>

<body>

    <!-- <section class="splash-screen"></section> -->

    <nav>
        <span class="nav-logo">MANHATTAN CLOTHES</span>

        
        
        <ul class="nav-options-container">

            <li class="nv-op-ct-li">
                <button class="acc-btn">
                    <img src="./media/user-icon.svg" alt="">
                </button>
                <section class="log-in-sigh-in-options-container">


                    @if (Route::has('login'))
                        
                        @auth

                            <li class="session_data_container">
                            
                                <button class="head-data-account">
                                    <div class="hd-dat-acc-img-ctr">
                                        <img src="./media/user-icon.svg" alt="">
                                    </div>
                                    <span>{{ Auth::user()->name }}</span>
                                </button>

                                <!-- <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"  aria-haspopup="true" aria-expanded="false" v-pre>
                                    
                                </a> -->

                                <section class="account-hidden-menu">

                                    <a class="dropdown-item" href="#">
                                        {{ Auth::user()->email }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </section>

                            </li>

                        @else
                            
                            <a href="{{ route('login') }}">LOGIN</a>

                            @if (Route::has('register'))
                            
                                <a href="{{ route('register') }}">REGISTER</a>

                            @endif

                        @endauth
                        
                    @endif
                    
                </section>
            </li>

            <li class="nv-op-ct-li">
                <a class="nv-op-ct-li-a" href="#">HOME</a>
                <a class="nv-op-ct-li-a" href="#">SHOP</a>
                <a class="nv-op-ct-li-a" href="#">ACCOUNT</a>
                <a class="nv-op-ct-li-a" href="#">CONTACT</a>
            </li>

            <li class="nv-op-ct-li">
                <button class="shc-btn">
                    <div class="shc-btn-ctr">
                        <img class="shc-btn-img" src="./media/cart-icon.svg" alt="">
                        <span class="dn-quantity-indicator"></span>
                    </div>
                </button>
            </li>

        </ul>

        

        <button class="menu-btn">
            <img src="./media/menu.png">
        </button>
        
    </nav>

    <header>
        <span>NEW</span>
        <span>AMAZING</span>
        <span>COLLECTION</span>
    </header>

    <main>
        <div class="main-content-container">


            <div id="p-container-id" class="categorys-container">

                <a class="category-btn" href="{{ url('/') }}#p-container-id">all</a>

                @foreach($uniqueCategories as $produc)
                    <a class="category-btn" href="{{ $produc }}#p-container-id">{{ $produc }}</a>
                @endforeach

            </div>


            

            <div class="products-container">

                @foreach($products as $product)

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
    </main>

    <footer>
        <div class="footer-sct1">
            <span>CONTACT US</span>
            <hr>
        </div>
        <div class="footer-sct2">
            <a href="#">
                <img class="lazyload" data-src="//img.ltwebstatic.com/images3_pi/2019/10/16/1571217650399593457a6848bb799392d8a333d481.webp" width="30" height="30" alt="" loaded="true" src="//img.ltwebstatic.com/images3_pi/2019/10/16/1571217650399593457a6848bb799392d8a333d481.webp">
            </a>
            <a href="#">
                <img class="lazyload" data-src="//img.ltwebstatic.com/images3_pi/2019/10/16/15712176364cf63dd5884d7cc219eebc5198b48991.webp" width="30" height="30" alt="" loaded="true" src="//img.ltwebstatic.com/images3_pi/2019/10/16/15712176364cf63dd5884d7cc219eebc5198b48991.webp">
            </a>
            <a href="#">
                <img class="lazyload" data-src="//img.ltwebstatic.com/images3_acp/2024/03/27/00/17115274075603d9a7f2aa02a415b6fef976c6ac65.webp" width="30" height="30" alt="" loaded="true" src="//img.ltwebstatic.com/images3_acp/2024/03/27/00/17115274075603d9a7f2aa02a415b6fef976c6ac65.webp">
            </a>   
        </div>
        <div class="footer-sct3">
            ©2024 MANHATTAN CLOTHES WEBSITE. All rights reserved
        </div>
    </footer>

    <template class="template-product">

        <div class="product-body">
            
            <div class="pb-img-container">
                <img class= "pb-img" src="">
                <div class="pb-sizes-container"></div>
            </div>

            <div class="pb-info-container">
                <p class="pb-name-product"></p>
                <span class="pb-price-product"></span> 
            </div>
            
        </div>
        
    </template>

    <template class="template-p-detail">
        <div class="detail-view-bgrd">
            <div class="detail-view">
                <div class="dt-view-sct1">
                    <img class="dt-lg-img" src="" alt="image">
                </div>
                <div class="dt-view-sct2">
                    <div class="dt-view-sct2--sct1"></div>
                    <div class="dt-view-sct2--sct2"></div>
                </div>
            </div>
        </div>
    </template>


    @include('templates')


    @include('layouts.cart-view')

    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.6/dist/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <script src="{{ asset('./js/app.js') }}"></script>
</body>
</html>