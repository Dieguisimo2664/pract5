<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <!-- <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous"
    /> -->
</head>
<body>


    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Detalles del Producto</h1>
                <div class="detail-view">
                    <div class="dt-view-sct1">
                        <img class="dt-lg-img" src="{{ explode(',', $selectedProduct->media)[0] }}" alt="{{ $selectedProduct->name }}">
                    </div>
                    <div class="dt-view-sct2">
                        <div class="dt-view-sct2--sct1">
                            <h2>{{ $selectedProduct->name }}</h2>
                            <p>{{ $selectedProduct->description }}</p>
                        </div>
                        <div class="dt-view-sct2--sct2">
                            <p><strong>Precio:</strong> ${{ $selectedProduct->price }}</p>
                            <!-- Otros detalles del producto -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>
</html>


