<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <!-- <link href="<?= BASE_URL; ?>Assets/css/app.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Momo+Trust+Display&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fascinate&display=swap" rel="stylesheet">
    <link href="<?= BASE_URL; ?>Assets/css/style.css" rel="stylesheet">
    <link rel="shortcut icon" href="<?= BASE_URL; ?>Assets/img/favicon.png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <link rel="icon" href="<?= BASE_URL; ?>Assets/img/favicon.png" type="image/x-icon" />
    <?php if (isset($viewData['CSS'])) {
        echo $viewData['CSS'];
    }; ?>
    <style type="text/css">
        .slideshow-container {
            max-width: 1000px;
            position: relative;
            margin: auto;
        }

        .produto-card {
            display: flex;
            flex-direction: column;
            height: 90%;
            width: 100%;
        }

        .card-img-top {
            padding: 10px;
            width: 60%;
            height: 40%;
            background-color: #eeee;
            border-radius: 10px;
            object-fit: contain;

        }

        .imagem-big {
            padding: 20px;
            width: 65%;
            height: 60%;

            border-radius: 50%;
            object-fit: contain;
            background: #f9dc71;

        }


        input[type=number]::-webkit-inner-spin-button {
            -webkit-appearance: none;

        }

        input[type=number] {
            -moz-appearance: textfield;
            appearance: textfield;

        }

        .text-logo {
            color: #71841c;
            font-family: "Fascinate", system-ui;
            font-size: 60px;
            font-weight: 200;
            font-style: normal;
        }

        .category {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #eeeeeeff;
            width: 60px;
            height: 60px;

        }

        .card-produto {
            height: 150px;
            display: flex;
            align-items: center;
            justify-content: start;
            padding: 10px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .product_img {


            cursor: pointer;
            transition: .3s ease-in-out;
        }

        .product_img img {
            transition: .3s ease-in-out;
        }

        .card-produto:hover .product_img img {

            transform: scale(1.1);
        }

        .modal-content {
            background-color: transparent;

        }

        .text-light {
            font-family: "Momo Trust Display", sans-serif;
            font-weight: 400;
            font-style: normal;
        }
    </style>
    <title></title>
</head>

<body class="bg-light">
    <main class="container-fluid">
        <!-- <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
            <div class="container-fluid">

                <a class="navbar-brand" href="<?= BASE_URL ?>">
                    <img src="<?= BASE_URL . 'Assets/img/logo.mercado.png'; ?>" alt="Logo" width="100" class="d-inline-block align-text-top">
                </a>


                <a href="<?= BASE_URL ?>Site/CartView" class="btn position-relative">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="dark" class="bi bi-cart3" viewBox="0 0 16 16">
                        <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l.84 4.479 9.144-.459L13.89 4zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2" />
                    </svg>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        <?= $quantidade ?>
                    </span>
                </a>
            </div>
        </nav> -->


        <div id="myTab" role="tablist" class=" nav nav-tabs d-flex flex-nowrap overflow-auto mt-4 gap-3 shadow p-3 mb-5 bg-white rounded">



            <div class="nav-item" role="presentation">
                <button type="button" class="nav-link active" id="todos-tab" data-bs-toggle="tab" data-bs-target="#todos-tab-pane" type="button" role="tab" aria-controls="todos-tab-pane" aria-selected="true">
                    <img src="<?= BASE_URL . 'Assets/img/all.png'; ?>" alt="Logo" width="50" class="d-inline-block align-text-top">
                    <p class="text-dark">todos</p>
                </button>
            </div>

            <div class="nav-item" role="presentation">
                <a href='<?= BASE_URL ?>Site/Limpeza' class="nav-link">

                  <i class="fas fa-hamburger"></i>

                    <p class="text-dark">Limpeza</p>
                </a>
            </div>

            <div class="nav-item" role="presentation">
                <a href='<?= BASE_URL ?>Site/Bebidas' class="nav-link">
                    <img src="<?= BASE_URL . 'Assets/img/refrigerantes.png'; ?>" alt="Logo" width="50" class="d-inline-block align-text-top">
                    <p class="text-dark">Bebidas</p>
                </a>
            </div>

            <div class="nav-item" role="presentation">
                <a href='<?= BASE_URL ?>Site/Alimentos' class="nav-link">
                    <img src="<?= BASE_URL . 'Assets/img/comida-saudavel.png'; ?>" alt="Logo" width="50" class="d-inline-block align-text-top">
                    <p class="text-dark">Alimentos</p>
                </a>
            </div>

            <div class="nav-item" role="presentation">
                <a href='<?= BASE_URL ?>Site/Brinquedos' class="nav-link">
                    <img src="<?= BASE_URL . 'Assets/img/brinquedos.png'; ?>" alt="Logo" width="50" class="d-inline-block align-text-top">
                    <p class="text-dark">Brinquedos</p>
                </a>
            </div>

            <div class="nav-item" role="presentation">
                <a href='<?= BASE_URL ?>Site/Carnes' class="nav-link">
                    <img src="<?= BASE_URL . 'Assets/img/proteina.png'; ?>" alt="Logo" width="50" class="d-inline-block align-text-top">
                    <p class="text-dark">Carnes</p>
                </a>
            </div>

            <div class=" d-flex justify-content-between">
                <a href="<?= BASE_URL ?>Site/CartView" class="btn position-relative">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="dark" class="bi bi-cart3" viewBox="0 0 16 16">
                        <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l.84 4.479 9.144-.459L13.89 4zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2" />
                    </svg>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        <?= $quantidade ?>
                    </span>
                </a>
            </div>
        </div>


        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="todos-tab-pane" role="tabpanel" aria-labelledby="todos-tab" tabindex="0">
                <div class="row" id="row1">
                    <?php foreach ($produtos as $produto): ?>
                        <?php $id = $produto['id'] ?>
                        <div class="col-lg-4 col-md-6 mb-3">
                            <div class="card card-produto d-flex flex-row align-items-center  shadow-sm" style="max-height: 100px;">
                                <div class="product_img mx-3">
                                    <img data-bs-toggle="modal" data-bs-target="#modal-<?= $id ?>" src="<?= BASE_URL . $produto['imagem'] ?>" alt="<?= $produto['nome'] ?>" class="card-img-top" style="width: 70px; height: 100%; object-fit: cover;">
                                </div>

                                <div class="flex-grow-1">
                                    <h6 class="mb-1"><?= $produto['nome'] ?></h6>
                                    <div class="text-success mb-1">R$ <?= number_format($produto['valor'], 2, ',', '.') ?></div>

                                </div>
                                <div class="d-flex align-items-center">
                                    <a href="<?= BASE_URL ?>Site/CartRemove/<?= $produto['hash'] ?>" class="btn btn-outline-secondary btn-sm ms-1">-</a>
                                    <span class="mx-2">
                                        <?= isset($_SESSION['cart'][$produto['hash']]['quantity']) ? $_SESSION['cart'][$produto['hash']]['quantity'] : 0 ?>
                                    </span>
                                    <a href="<?= BASE_URL ?>Site/CartAdd/<?= $produto['hash'] ?>" class="btn btn-outline-secondary btn-sm ms-1">+</a>

                                </div>
                            </div>
                        </div>

                        <!-- MODAL IMAGEM-->
                        <div class="modal fade" id="modal-<?= $id ?>" tabindex="-1" aria-labelledby="label-<?= $id ?>" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <h1 class="text-light p-3"><?= $produto['nome'] ?></h1>
                                    <div class="modal-body mt-3 mb-4 d-flex justify-content-center" style="position: relative;">

                                        <img src="<?= BASE_URL . $produto['imagem'] ?>" alt="<?= $produto['nome'] ?>" class="imagem-big" style="height: 300px;">

                                    </div>
                                    <img src="<?= BASE_URL . 'Assets/img/svg.png'; ?>" alt="Logo" width="100%" class="rounded-bottom d-inline-block align-text-top" style="position: absolute; margin-top: 305px; z-index: -1;">

                                </div>
                            </div>

                        </div>

                    <?php endforeach; ?>
                </div>
            </div>
        </div>






    </main>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<script async src="Assets/js/category.js"></script>

</html>