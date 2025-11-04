<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="<?= BASE_URL; ?>Assets/css/app.css" rel="stylesheet">

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
            object-fit: contain;
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
            background-color: #e4e4e4ff;
            width: 30px;
            height: 60px;

        }

        .alert-delivery {
            background: #fff4f4;
            color: #b90000;
            border: 1px solid #ffcccc;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            font-size: 0.9rem;
        }

        .alert-cart {
            background: #fff4f4;
            color: #d8cc1eff;
            border: 1px solid #ffcccc;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            font-size: 0.9rem;
        }

        .total-box {
            background: #f9faf6;
            border-radius: 10px;
            padding: 20px;
            font-size: 1.1rem;
            font-weight: 600;
            color: #333;
            text-align: center;
        }

        .btn-primary {
            background-color: #33a44c;
            border-color: #33a44c;
            border-radius: 12px;
            font-weight: 600;
            padding: 10px;
        }
        .btn-warning{
           background-color: #fbc41d;
            border-color: #fbc41d;
            border-radius: 12px;
            font-weight: 600;
            padding: 10px; 
        }
        .btn-primary:hover {
            background-color: #59b172;
            border-color: #59b172;
        }
    </style>
    <title></title>
</head>

<body class="bg-light">
    <main class="content-fluid">
        <header>
            <nav class="navbar bg-white shadow-sm border-bottom py-2">
                <div class="container-fluid d-flex align-items-center justify-content-between">

                    <a href="<?= BASE_URL ?>Site/Voltar" class="btn d-flex align-items-center justify-content-center btn btn-outline-secondary rounded-circle" style="width: 38px; height: 38px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                        </svg>
                    </a>


                    <h5 class="m-0 flex-grow-1 text-center fw-semibold">Seu carrinho</h5>




                    <div style="width: 38px;"></div>
                </div>
            </nav>
        </header>

        <div class="container mt-5">
            <div class="row d-flex justify-content-center">

                <div class="col-lg-6 col-sm-6">
                    <?php

                    if ($_SESSION['cart'] ==  []): ?>

                        <div class="col-lg-6">
                            <div class="section-box mb-3">
                                <div class="alert-cart mb-3">
                                    <i class="bi bi-exclamation-circle"></i>
                                    <p class="m-0 mt-1">Seu carrinho está vázio</p>
                                </div>


                                <a href="<?= BASE_URL ?>Site/Voltar" class="btn btn-warning w-100">Olhar os produtos</a>

                            </div>
                        </div>

                    <?php endif ?>
                    <?php foreach ($carrinho as $cart): ?>

                        <div class="col-lg-12 mb-3">



                            <div class="btn btn-success d-flex justify-content-center" style="position: absolute; z-index: 2; font-size: 10px; height: 22px; width: 20px;">
                                <?= $cart['quantity'] ?>
                            </div>
                            <div class="card d-flex flex-row align-items-center p-2 shadow-sm" style="min-height: 100px;">
                                <div class="imagem">
                                    <img src="<?= BASE_URL . $cart['image'] ?>" alt="<?= $cart['name'] ?>" class="img-fluid me-4" style="width: 70px; height: 100%; object-fit: cover;">
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1"><?= $cart['name'] ?></h6>
                                    <div class="text-success mb-1">R$ <?= number_format($cart['price'], 2, ',', '.') ?></div>
                                </div>


                                <div class="d-flex align-items-center">
                                    <a href="<?= BASE_URL ?>Site/CartRemove/<?= $cart['id'] ?>" class="btn btn-outline-secondary btn-sm ms-1">-</a>
                                    <span class="mx-2">
                                        <?= isset($_SESSION['cart'][$cart['id']]['quantity']) ? $_SESSION['cart'][$cart['id']]['quantity'] : 0 ?>
                                    </span>
                                    <a href="<?= BASE_URL ?>Site/CartAdd/<?= $cart['id'] ?>" class="btn btn-outline-secondary btn-sm ms-1">+</a>

                                </div>



                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="col-lg-4">
                    <div class="section-box">
                        <div class="alert-delivery mb-3">
                            <i class="bi bi-exclamation-circle"></i>
                            <p class="m-0 mt-1">Entregas apenas para compras acima de R$ 100,00</p>
                        </div>
                        <p class="text-center fw-semibold mb-2">Valor total da sua compra</p>
                        <?php
                        $total = 0;
                        foreach ($_SESSION['cart'] as $item):
                            $total += $item['price'];
                        endforeach ?>
                        <div class="total-box mb-3">
                            R$ <?= number_format($total, 2, ',', '.') ?>
                        </div>
                        <a href="<?= BASE_URL ?>Site/InfoPersonal" class="btn btn-primary w-100">Continuar</a>

                    </div>
                </div>

            </div>
        </div>




    </main>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<script async src="Assets/js/carrinho.js"></script>

</html>