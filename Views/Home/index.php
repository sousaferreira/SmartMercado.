<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <!-- <link href="<?= BASE_URL; ?>Assets/css/app.css" rel="stylesheet"> -->

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
            background-color: #eeeeeeff;
            width: 60px;
            height: 60px;

        }

        .card {
            height: 150px;
            display: flex;
            align-items: center;
            justify-content: start;
            padding: 10px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
    <title></title>
</head>

<body class="bg-light">
    <main class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
            <div class="container-fluid">

                <a class="navbar-brand" href="<?= BASE_URL ?>">
                    <img src="<?= BASE_URL . 'Assets/img/logo.mercado.png'; ?>" alt="Logo" width="100" class="d-inline-block align-text-top">
                </a>


                <a href="<?= BASE_URL ?>Site/CartView" class="btn position-relative">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="dark" class="bi bi-cart3" viewBox="0 0 16 16">
                        <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l.84 4.479 9.144-.459L13.89 4zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2" />
                    </svg>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        <?=$quantidade ?>
                    </span>
                </a>
            </div>
        </nav>

        <div id="myTab" role="tablist" class=" nav nav-tabs d-flex flex-nowrap overflow-auto mt-4 gap-3 shadow p-3 mb-5 bg-white rounded">
            
                <div class="nav-item" role="presentation">
                    <button type="button" class="nav-link active" id="todos-tab" data-bs-toggle="tab" data-bs-target="#todos-tab-pane" type="button" role="tab" aria-controls="todos-tab-pane" aria-selected="true">
                        <img src="<?= BASE_URL . 'Assets/img/all.png'; ?>" alt="Logo" width="50" class="d-inline-block align-text-top">
                        <p class="text-dark">todos</p>
                    </button>
                </div>

                <div class="nav-item" role="presentation">
                    <button type="button" class="nav-link" id="limpeza-tab" data-bs-toggle="tab" data-bs-target="#limpeza-tab-pane" type="button" role="tab" aria-controls="limpeza-tab-pane" aria-selected="false">
                        <img src="<?= BASE_URL . 'Assets/img/produtos.png'; ?>" alt="Logo" width="50" class="d-inline-block align-text-top">
                        <p class="text-dark">Limpeza</p>
                    </button>
                </div>

                <div class="nav-item" role="presentation">
                    <button type="button" class="nav-link" id="bebidas-tab" data-bs-toggle="tab" data-bs-target="#bebidas-tab-pane" type="button" role="tab" aria-controls="bebidas-tab-pane" aria-selected="false">
                        <img src="<?= BASE_URL . 'Assets/img/refrigerantes.png'; ?>" alt="Logo" width="50" class="d-inline-block align-text-top">
                        <p class="text-dark">Bebidas</p>
                    </button>
                </div>

                <div class="nav-item" role="presentation">
                    <button type="button" class="nav-link" id="alimentos-tab" data-bs-toggle="tab" data-bs-target="#alimentos-tab-pane" type="button" role="tab" aria-controls="alimentos-tab-pane" aria-selected="false">
                        <img src="<?= BASE_URL . 'Assets/img/comida-saudavel.png'; ?>" alt="Logo" width="50" class="d-inline-block align-text-top">
                        <p class="text-dark">Alimentos</p>
                    </button>
                </div>

                <div class="nav-item" role="presentation">
                    <button type="button" class="nav-link" id="brinquedos-tab" data-bs-toggle="tab" data-bs-target="#brinquedos-tab-pane" type="button" role="tab" aria-controls="brinquedos-tab-pane" aria-selected="false">
                        <img src="<?= BASE_URL . 'Assets/img/brinquedos.png'; ?>" alt="Logo" width="50" class="d-inline-block align-text-top">
                        <p class="text-dark">Brinquedos</p>
                    </button>
                </div>

                <div class="nav-item" role="presentation">
                    <button type="button" class="nav-link" id="carnes-tab" data-bs-toggle="tab" data-bs-target="#carnes-tab-pane" type="button" role="tab" aria-controls="carnes-tab-pane" aria-selected="false">
                        <img src="<?= BASE_URL . 'Assets/img/proteina.png'; ?>" alt="Logo" width="50" class="d-inline-block align-text-top">
            <p class="text-dark">Carnes</p>
                    </button>
                </div>

            
        </div>


        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="todos-tab-pane" role="tabpanel" aria-labelledby="todos-tab" tabindex="0">
                <div class="row" id="row1">
                    <?php foreach ($produtos as $produto): ?>
                        <div class="col-lg-4 col-md-6 mb-3">
                            <div class="card d-flex flex-row align-items-center p-2 shadow-sm" style="min-height: 100px;">
                                <div class="imagem">
                                    <img src="<?= BASE_URL . $produto['imagem'] ?>" alt="<?= $produto['nome'] ?>" class="img-fluid me-4" style="width: 70px; height: 100%; object-fit: cover;">
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
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="tab-pane fade" id="limpeza-tab-pane" role="tabpanel" aria-labelledby="limpeza-tab" tabindex="0">
                <div class="row" id="row1">
                    <?php foreach ($limpeza as $produto): ?>
                        <div class="col-lg-4 col-md-6 mb-3">
                            <div class="card d-flex flex-row align-items-center p-2 shadow-sm" style="min-height: 100px;">
                                <div class="imagem">
                                    <img src="<?= BASE_URL . $produto['imagem'] ?>" alt="<?= $produto['nome'] ?>" class="img-fluid me-4" style="width: 70px; height: 100%; object-fit: cover;">
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
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="tab-pane fade" id="bebidas-tab-pane" role="tabpanel" aria-labelledby="bebidas-tab" tabindex="0">
                <div class="row" id="row1">
                    <?php foreach ($bebidas as $produto): ?>
                        <div class="col-lg-4 col-md-6 mb-3">
                            <div class="card d-flex flex-row align-items-center p-2 shadow-sm" style="min-height: 100px;">
                                <div class="imagem">
                                    <img src="<?= BASE_URL . $produto['imagem'] ?>" alt="<?= $produto['nome'] ?>" class="img-fluid me-4" style="width: 70px; height: 100%; object-fit: cover;">
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
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="tab-pane fade" id="alimentos-tab-pane" role="tabpanel" aria-labelledby="alimentos-tab" tabindex="0">
                <div class="row" id="row1">
                    <?php foreach ($alimentacao as $produto): ?>
                        <div class="col-lg-4 col-md-6 mb-3">
                            <div class="card d-flex flex-row align-items-center p-2 shadow-sm" style="min-height: 100px;">
                                <div class="imagem">
                                    <img src="<?= BASE_URL . $produto['imagem'] ?>" alt="<?= $produto['nome'] ?>" class="img-fluid me-4" style="width: 70px; height: 100%; object-fit: cover;">
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
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="tab-pane fade" id="brinquedos-tab-pane" role="tabpanel" aria-labelledby="brinquedos-tab" tabindex="0">
                <div class="row" id="row1">
                    <?php foreach ($brinquedos as $produto): ?>
                        <div class="col-lg-4 col-md-6 mb-3">
                            <div class="card d-flex flex-row align-items-center p-2 shadow-sm" style="min-height: 100px;">
                                <div class="imagem">
                                    <img src="<?= BASE_URL . $produto['imagem'] ?>" alt="<?= $produto['nome'] ?>" class="img-fluid me-4" style="width: 70px; height: 100%; object-fit: cover;">
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
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="tab-pane fade" id="carnes-tab-pane" role="tabpanel" aria-labelledby="carnes-tab" tabindex="0">
                <div class="row" id="row1">
                    <?php foreach ($carnes as $produto): ?>
                        <div class="col-lg-4 col-md-6 mb-3">
                            <div class="card d-flex flex-row align-items-center p-2 shadow-sm" style="min-height: 100px;">
                                <div class="imagem">
                                    <img src="<?= BASE_URL . $produto['imagem'] ?>" alt="<?= $produto['nome'] ?>" class="img-fluid me-4" style="width: 70px; height: 100%; object-fit: cover;">
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
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

    </main>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<script async src="Assets/js/category.js"></script>

</html>