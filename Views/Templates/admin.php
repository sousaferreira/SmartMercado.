<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Momo+Trust+Display&display=swap" rel="stylesheet">

    <title>Administrativo</title>

    <link href="<?= BASE_URL; ?>Assets/css/app.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- FAVICON -->
    <link rel="shortcut icon" href="<?= BASE_URL; ?>Assets/img/favicon.png" />
    <link rel="icon" href="<?= BASE_URL; ?>Assets/img/favicon.png" type="image/x-icon" />
    <?php if (isset($viewData['CSS'])) {
        echo $viewData['CSS'];
    }; ?>
    <style type="text/css">
        .slideshow-container {
            max-width: 1000px;
            position: relative;
        }

        .modal-title {
            font-family: "Momo Trust Display", sans-serif;
            font-weight: 400;
            font-style: normal;
            color: #0066ebff;
        }
    </style>
</head>

<body class="">
    <div class="wrapper">
        <nav id="sidebar" class="sidebar">
            <div class="sidebar-content js-simplebar">
                <a class="sidebar-brand" href="#">
                    <span class="align-middle">Administrativo</span>
                </a>

                <ul class="sidebar-nav">
                    <!-- DASHBOARD -->
                    <!-- DASHBOARD -->
                    <li class="sidebar-item <?= (isset($viewData['nivel-1']) && $viewData['nivel-1'] == 'Dashboard') ? 'active' : ''; ?>">
                        <a href="#dashboardMenu" data-bs-toggle="collapse"
                            class="sidebar-link <?= (isset($viewData['nivel-1']) && $viewData['nivel-1'] == 'Dashboard') ? '' : 'collapsed'; ?>">
                            <i class="align-middle" data-feather="home"></i>
                            <span class="align-middle">Dashboard</span>
                        </a>
                        <ul id="dashboardMenu" class="sidebar-dropdown list-unstyled collapse <?= (isset($viewData['nivel-1']) && $viewData['nivel-1'] == 'Dashboard') ? 'show' : ''; ?>" data-bs-parent="#sidebar">
                            <li class="sidebar-item <?= (isset($viewData['nivel-2']) && $viewData['nivel-2'] == 'Principal') ? 'active' : ''; ?>">
                                <a class="sidebar-link" href="<?= BASE_URL . 'Home'; ?>">Dashboard Principal</a>
                            </li>
                            <li class="sidebar-item <?= (isset($viewData['nivel-2']) && $viewData['nivel-2'] == 'Análises') ? 'active' : ''; ?>">
                                <a class="sidebar-link" href="<?= BASE_URL . 'Business/Analistic'; ?>">Análises</a>
                            </li>
                            <li class="sidebar-item <?= (isset($viewData['nivel-2']) && $viewData['nivel-2'] == 'MaisVendidos') ? 'active' : ''; ?>">
                                <a class="sidebar-link" href="<?= BASE_URL . 'Business/MaisVendidos'; ?>">Produtos Mais Vendidos</a>
                            </li>
                        </ul>
                    </li>

                    <!-- ESTOQUE -->
                    <li class="sidebar-item <?= (isset($viewData['nivel-1']) && $viewData['nivel-1'] == 'Estoque') ? 'active' : ''; ?>">
                        <a href="#estoqueMenu" data-bs-toggle="collapse"
                            class="sidebar-link <?= (isset($viewData['nivel-1']) && $viewData['nivel-1'] == 'Estoque') ? '' : 'collapsed'; ?>">
                            <i class="align-middle" data-feather="layers"></i>
                            <span class="align-middle">Estoque</span>
                        </a>
                        <ul id="estoqueMenu" class="sidebar-dropdown list-unstyled collapse <?= (isset($viewData['nivel-1']) && $viewData['nivel-1'] == 'Estoque') ? 'show' : ''; ?>" data-bs-parent="#sidebar">
                            <li class="sidebar-item <?= (isset($viewData['nivel-2']) && $viewData['nivel-2'] == 'Disponivel') ? 'active' : ''; ?>">
                                <a class="sidebar-link" href="<?= BASE_URL . 'Business/estoque'; ?>">Gerenciar Estoque</a>
                            </li>
                            <li class="sidebar-item <?= (isset($viewData['nivel-2']) && $viewData['nivel-2'] == 'Indisponiveis') ? 'active' : ''; ?>">
                                <a class="sidebar-link" href="<?= BASE_URL . 'Business/RupturaEstoque'; ?>">Indisponíveis</a>
                            </li>
                        </ul>
                    </li>

                    <!-- COMPRAS -->
                    <li class="sidebar-item <?= (isset($viewData['nivel-1']) && $viewData['nivel-1'] == 'Compras') ? 'active' : ''; ?>">
                        <a href="#comprasMenu" data-bs-toggle="collapse"
                            class="sidebar-link <?= (isset($viewData['nivel-1']) && $viewData['nivel-1'] == 'Compras') ? '' : 'collapsed'; ?>">
                            <i class="align-middle" data-feather="shopping-cart"></i>
                            <span class="align-middle">Compras</span>
                        </a>
                        <ul id="comprasMenu" class="sidebar-dropdown list-unstyled collapse <?= (isset($viewData['nivel-1']) && $viewData['nivel-1'] == 'Compras') ? 'show' : ''; ?>" data-bs-parent="#sidebar">
                            <li class="sidebar-item <?= (isset($viewData['nivel-2']) && $viewData['nivel-2'] == 'Finalizadas') ? 'active' : ''; ?>">
                                <a class="sidebar-link" href="<?= BASE_URL . 'Business/ComprasFinalizadas'; ?>">Compras Finalizadas</a>
                            </li>
                            <li class="sidebar-item <?= (isset($viewData['nivel-2']) && $viewData['nivel-2'] == 'Pendentes') ? 'active' : ''; ?>">
                                <a class="sidebar-link" href="<?= BASE_URL . 'Business/ComprasPendentes'; ?>">Pendentes</a>
                            </li>
                        </ul>
                    </li>

                    <!-- CAIXA -->
                    <li class="sidebar-item <?= (isset($viewData['nivel-1']) && $viewData['nivel-1'] == 'Caixa') ? 'active' : ''; ?>">
                        <a href="#caixaMenu" data-bs-toggle="collapse"
                            class="sidebar-link <?= (isset($viewData['nivel-1']) && $viewData['nivel-1'] == 'Caixa') ? '' : 'collapsed'; ?>">
                            <i class="align-middle" data-feather="credit-card"></i>
                            <span class="align-middle">Caixa</span>
                        </a>
                        <ul id="caixaMenu" class="sidebar-dropdown list-unstyled collapse <?= (isset($viewData['nivel-1']) && $viewData['nivel-1'] == 'Caixa') ? 'show' : ''; ?>" data-bs-parent="#sidebar">
                            <li class="sidebar-item <?= (isset($viewData['nivel-2']) && $viewData['nivel-2'] == 'GerenciarCaixa') ? 'active' : ''; ?>">
                                <a class="sidebar-link" href="<?= BASE_URL . 'Business/gerenciarCaixa'; ?>">Gerenciar Caixa</a>
                            </li>
                            <li class="sidebar-item <?= (isset($viewData['nivel-2']) && $viewData['nivel-2'] == 'Caixa') ? 'active' : ''; ?>">
                                <a class="sidebar-link" target="_blank" href="<?= BASE_URL . 'Business/caixa'; ?>">Caixa</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                    <!-- BOTÃO DE SUPORTE -->
                    <div class="sidebar-cta mt-4">
                        <div class="d-grid">
                            <a href="#" class="btn btn-primary" target="_blank">Suporte / Help</a>
                        </div>
                    </div>
            </div>
        </nav>

        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <a class="sidebar-toggle d-flex">
                    <i class="hamburger align-self-center"></i>
                </a>

                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav navbar-align">


                        <li class="nav-item dropdown d-flex align-items-center">
                            <!-- Ícone mobile -->
                            <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                                <i class="align-middle" data-feather="settings"></i>
                            </a>

                            <!-- Imagem e nome alinhados -->
                            <a class="nav-link dropdown-toggle d-flex align-items-center d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                                <img src="<?= BASE_URL . 'Assets/img/perfil.png'; ?>"
                                    alt="IMG"
                                    class="rounded-circle me-2"
                                    height="32">
                                <span class="text-dark"><?= htmlspecialchars($viewData['name'] ?? 'Usuário'); ?></span>
                            </a>

                            <!-- Dropdown menu -->
                            <ul class="dropdown-menu dropdown-menu-end mt-5">
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="align-middle me-1" data-feather="settings"></i> Configurações
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item" href="<?= BASE_URL . 'Login/logout'; ?>">
                                        <i class="align-middle me-1" data-feather="log-out"></i> Sair
                                    </a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </div>
            </nav>

            <?php $this->loadViewInTemplate($viewName, $viewData); ?>

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-6 text-start">
                            <p class="mb-0">
                                <a href="index.html" class="text-muted"><strong>AdminKit Demo</strong></a> &copy; Priscila Sousa
                            </p>
                        </div>
                        <div class="col-6 text-end">
                            <ul class="list-inline">
                                <li class="list-inline-item"><a class="text-muted" href="#">Support</a></li>
                                <li class="list-inline-item"><a class="text-muted" href="#">Help Center</a></li>
                                <li class="list-inline-item"><a class="text-muted" href="#">Privacy</a></li>
                                <li class="list-inline-item"><a class="text-muted" href="#">Terms</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="<?= BASE_URL; ?>Assets/js/jquery-3.5.1.js"></script>
    <script src="<?= BASE_URL; ?>Assets/js/jquery.mask.js"></script>
    <script src="<?= BASE_URL; ?>Assets/js/app.js"></script>
    <script type="text/javascript">
        const BASE_URL = '<?= BASE_URL; ?>'
    </script>
    <?php if (isset($viewData['JS'])) {
        echo $viewData['JS'];
    }; ?>
</body>

</html>