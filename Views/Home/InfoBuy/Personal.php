<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Mercadinho</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">


    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Fascinate&display=swap" rel="stylesheet">

    <style>
        body {
            background-color: #f6f7f5;
            font-family: 'Inter', sans-serif;
        }

        .navbar {
            background: #fff;
            border-bottom: 2px solid #eaeaea;
        }

        .text-logo {
            color: #71841c;
            font-family: "Fascinate", cursive;
            font-size: 48px;
        }

        .section-box {
            background: #fff;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
            margin-bottom: 25px;
        }

        .section-title {
            font-weight: 600;
            color: #4b4b4b;
            margin-bottom: 15px;
        }

        label {
            font-size: 0.9rem;
            color: #555;
        }

        .form-control,
        .form-select {
            border-radius: 10px;
            border-color: #ccc;
            box-shadow: none;
        }

        .form-check-input:checked {
            background-color: #71841c;
            border-color: #71841c;
        }

        .payment-option {
            background: #e8ebde;
            transition: all 0.2s ease-in-out;
            cursor: pointer;
            border-radius: 12px;
            text-align: center;
            padding: 15px;
        }

        .payment-option:hover {
            background: #dfe3ce;
        }

        .payment-option label {
            font-weight: 600;
            color: #4a4a4a;
            cursor: pointer;
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

        .btn-primary:hover {
            background-color: #59b172;
            border-color: #59b172;
        }
    </style>
</head>

<body>

    <?php $total = 0;
    foreach ($_SESSION['cart'] as $item):
        $total += $item['price'];
    endforeach ?>
    <header>
        <nav class="navbar shadow-sm py-2">
            <div class="container d-flex align-items-center justify-content-between">
                <a href="<?= BASE_URL ?>Site/VoltarCart" class="btn btn-outline-secondary rounded-circle" style="width: 40px; height: 40px;">
                    <i class="bi bi-arrow-left"></i>
                </a>
                <h5 class="m-0 fw-semibold">Seu Carrinho</h5>
                <div style="width: 40px;"></div>
            </div>
        </nav>
    </header>

    <main class="container my-4">
        <form action="<?= BASE_URL ?>Site/AddCompra/" method="get">
            <div class="row">
                <div class="col-lg-8">
                    <div class="section-box">
                        <h6 class="section-title">Informações pessoais</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <label>*Nome completo</label>
                                <input name="nome_completo" required type="text" class="form-control" value="<?= $cliente['name'] ?? $cliente['name'] = '' ?>" value="">
                            </div>
                            <div class="col-md-6">
                                <label>*WhatsApp</label>
                                <input name="whatsapp" required type="text" class="form-control" value="<?= $cliente['whatsapp'] ?? $cliente['whatsapp'] = '' ?>">
                            </div>
                        </div>
                    </div>

                    <?php if ($total > 100): ?>
                        <div class="section-box">
                            <h6 class="section-title">Endereço para entrega</h6>
                            <input name="entrega" type="hidden" value="1">
                            <div class="row">
                                <div class="col-md-5">
                                    <label>Rua</label>
                                    <input name="rua" type="text" class="form-control" value="<?= $cliente['rua'] ?? $cliente['rua'] = '' ?>">
                                </div>
                                <div class="col-md-5">
                                    <label>Bairro</label>
                                    <select name="bairro" class="form-select" required>
                                        <option value="vilinha">Vila Santa Teresinha</option>
                                        <option value="frei_damiao">Frei Damião</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label>Nº</label>
                                    <input name="numero" type="text" class="form-control" value="<?= $cliente['numero_casa'] ?? $cliente['numero_casa'] = '' ?>">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label>Ponto de referência</label>
                                    <input name="ponto_de_referencia" type="text" class="form-control" placeholder="<?= $cliente['ponto_de_referencia'] ?? $cliente['ponto_de_referencia'] = '' ?>">
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>


                    <div class="section-box">
                        <h6 class="section-title">Forma de pagamento</h6>
                        <div class="d-flex gap-3 flex-wrap">
                            <div class="payment-option flex-grow-1">
                                <input class="form-check-input" value="pix" type="radio" name="Radio" id="pix">
                                <label for="pix"><i class="bi bi-qr-code"></i> Pix</label>
                            </div>
                            <div class="payment-option flex-grow-1">
                                <input class="form-check-input" value="especie" type="radio" name="Radio" id="especie">
                                <label for="especie"><i class="bi bi-cash-coin"></i> Espécie</label>
                            </div>
                            <div class="payment-option flex-grow-1">
                                <input class="form-check-input" value="cartao" type="radio" name="Radio" id="cartao">
                                <label for="cartao"><i class="bi bi-credit-card"></i> Cartão</label>
                            </div>
                        </div>
                    </div>


                    <div class="section-box">
                        <h6 class="section-title">Observações</h6>
                        <textarea name="descricao" class="form-control" rows="4" placeholder="Escreva aqui alguma observação..."></textarea>
                    </div>
                </div>


                <div class="col-lg-4">
                    <div class="section-box">
                        <div class="alert-delivery mb-3">
                            <i class="bi bi-exclamation-circle"></i>
                            <p class="m-0 mt-1">Entregas apenas para compras acima de R$ 100,00</p>
                        </div>
                        <p class="text-center fw-semibold mb-2">Valor total da sua compra</p>
                        <div class="total-box mb-3">
                            R$ <?= number_format($total, 2, ',', '.') ?>
                        </div>

                        <div class="form-check">
                            <?php
                            if (isset($cliente['SaveCheck']) && !empty($cliente['SaveCheck'])) {
                                if ($cliente['SaveCheck'] == 'Check') {
                                    $checked = 'checked';
                                } else {
                                    $checked = '';
                                }
                            } else {
                                $checked = '';
                            }
                            ?>

                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" name="SaveCheck" <?= $checked ?>>
                            <label class="form-check-label" for="flexCheckDefault">
                                Salvar informações
                            </label>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            Finalizar pedido
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>