<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PDV - Sistema de Vendas</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Momo+Trust+Display&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Momo+Trust+Display&display=swap" rel="stylesheet">
  <!-- <link rel="stylesheet" href="<?= BASE_URL ?>/../Assets/css/style.css"> -->

  <style>
    body {
      background-color: #f8f9fa;
      height: 100vh;
      overflow-x: hidden;
    }

    .pdv-products {
      /* height: vw; */
    }

    .sidebar {
      height: 100vh;
      background-color: #eeee;
      color: #fff;
      position: fixed;
      top: 0;
      left: 0;
      width: 50%;
      overflow-y: auto;
      transition: all 0.3s;
      /* z-index: 1050; */
    }

    .sidebar a {
      color: #fff;
      text-decoration: none;
    }

    .sidebar a:hover {
      background-color: #eeee;
      color: #fff;
    }

    .main-content {
      margin-left: 350px;
      padding: 20px;
      transition: all 0.3s;
    }

    .toggle-btn {
      display: none;
      background-color: #eeee;
      color: #fff;
      border: none;
      padding: 8px 12px;
      border-radius: 5px;
      position: fixed;
      top: 15px;
      left: 15px;
      z-index: 2000;
    }


    h2 {

      font-family: "Momo Trust Display", sans-serif;
      font-weight: 200;
      font-style: normal;


    }

    @media (max-width: 991px) {
      .sidebar {
        left: -450px;
      }

      .sidebar.active {
        left: 0;
      }

      .main-content {
        margin-left: 0;
      }

      .toggle-btn {
        display: inline-block;
      }
    }

    .compras {
      background-color: #ffffff10;
      color: white;
    }

    .product_img img {
      padding: 10px;
      width: 60%;
      height: 40%;
      background-color: #eeee;
      border-radius: 10px;
      object-fit: contain;
    }

    .pdv-header {
      background-color: #eeee;
      padding: 10px;
    }

    .compras {
      height: 250px;
    }
  </style>
</head>

<body>

  <button class="toggle-btn" id="toggleBtn">☰ Menu</button>
  <?php if (!empty($mensagem_erro)): ?>
    <?= $mensagem_erro ?>
  <?php endif; ?>

  <?php if (!empty($mensagem_sucesso)): ?>
    <?= $mensagem_sucesso ?>
  <?php endif; ?>
  <div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6">

      <div class="sidebar p-3" id="sidebar">
        <div class="row m-2">
          <?php
          if (!empty($caixa)) {
            $ultimoProduto = end($caixa);
          } else {
            $ultimoProduto = null;
          }
          ?>
          <div class="card">
            <?php if ($ultimoProduto): ?>
              <div class="card-header mt-2">
                <h2 class="text-dark text-center"><?= htmlspecialchars($ultimoProduto['name']) ?></h2>
              </div>
              <div class="card-body">

                <div class="text-center mb-4">
                  <img src="<?= BASE_URL . htmlspecialchars($ultimoProduto['image']) ?>" alt="<?= htmlspecialchars($ultimoProduto['name']) ?>" class="card-img-top imagem-big" style="max-width: 250px;">
                </div>
                <div class="d-flex align-items-end gap-5 justify-content-end">
                  <h2 class="text-success">R$ <?= number_format($ultimoProduto['price'], 2, ',', '.') ?></h2>
                </div>

              </div>

            <?php else: ?>
              <p class="text-center text-muted m-0">Nenhum produto selecionado</p>

            <?php endif; ?>
          </div>
        </div>

        <div class="row m-2">
          <form action="<?= BASE_URL ?>OperadorCaixa/BuscarCod/" method="GET" class="row g-2 align-items-center">
            <div class="col-12 col-md-6">
              <div class="form-floating">
                <input type="text" class="form-control" id="codigoBarrasInput" name="codigo_barras" placeholder="Código de barras">
                <label for="codigoBarrasInput">Código de barras</label>
              </div>
            </div>
            <div class="col-12 col-md-4">
              <div class="form-floating">
                <input type="text" class="form-control" id="quantidadeInput" name="quantidade" placeholder="Quantidade">
                <label for="quantidadeInput">Quantidade</label>
              </div>
            </div>
            <div class="col-12 col-md-2 d-flex justify-content-center">
              <button class="btn btn-outline-light w-100 h-100" type="submit" title="Buscar produto">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#fffff" class="bi bi-search" viewBox="0 0 16 16">
                  <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                </svg>
              </button>
            </div>
          </form>
        </div>

        <div class="row m-2 mt-4">
          <div class="card compras">
            <div class="card-header text-center bg-success text-white">Compras</div>
            <div class="card-body">
              <table class="table table-sm text-white">
                <thead>
                  <tr>
                    <th scope="col">Produto</th>
                    <th scope="col">Qtde</th>
                    <th scope="col">Unitário</th>
                    <th scope="col">Total</th>
                    <th scope="col">...</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (!empty($caixa) && is_array($caixa)): ?>
                    <?php foreach ($caixa as $item): ?>
                      <tr>
                        <td><?= $item['name'] ?></td>
                        <td><?= $item['quantity'] ?></td>
                        <td><?= $item['valor'] ?></td>
                        <td><?= $item['price'] ?></td>
                        <td><a href="<?= BASE_URL ?>OperadorCaixa/CaixaRemove/<?= $item['id'] ?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-x" viewBox="0 0 16 16">
                              <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                            </svg></td></a>

                      </tr>
                    <?php endforeach; ?>
                  <?php else: ?>
                    <tr>
                      <td colspan="4" class="text-center text-white">Nenhum produto no carrinho</td>
                    </tr>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>


        <div class="pdv-footer d-flex fixed-bottom justify-content-center w-50 p-3 mb-5">
          <div class="row w-100">
            <h2 class="text-dark text-center">Valor Total:</h2>
            <div class="card w-100 h-100 d-flex justify-content-center align-items-center">
              <?php
              $total = 0;
              if (isset($_SESSION['caixa']) && is_array($_SESSION['caixa'])) {
                foreach ($_SESSION['caixa'] as $item) {
                  $total += $item['price'];
                }
              }
              ?>

              <h1 class="text-success p-2 text-center">R$ <?= number_format($total, 2, ',', '.') ?></h1>
            </div>
          </div>

        </div>
      </div>
    </div>


    <div class="col-lg-6 col-md-6 col-sm-6">

      <div class="pdv-header  d-flex flex-wrap justify-content-between align-items-center mb-3">
        <span>Caixa: <strong><?= $operador['caixa'] ?? '' ?></strong></span>
        <span>Operador: <strong><?= $operador['nome'] ?? '' ?></strong></span>
        <span>Data: <strong><?= $operador['data_abertura'] ?? '' ?></strong></span>
        <span>Valor Inicial: <strong><?= $caixaOperador['valor_inicial'] ?? '' ?></strong></span>
      </div>

      <div class="row h-100">
        <div class="d-flex justify-content-center flex-column">
          <?php foreach ($products as $produto): ?>
            <div class="pdv-products">
              <div class="tab-pane fade show active">
                <div class="row d-flex justify-content-center" id="row1">
                  <div class="col-6 mb-3">
                    <div class="card shadow-sm border-0 rounded-3 ">
                      <div class="card-body d-flex align-items-center gap-3">
                        <div class="product_img flex-shrink-0">
                          <img src="<?= BASE_URL . $produto['imagem'] ?>" alt="<?= $produto['nome'] ?>" class="rounded" style="width: 80px; height: 80px; object-fit: cover; object-position: center;">
                        </div>
                        <div class="flex-grow-1">
                          <h6 class="mb-1 fw-semibold text-dark text-truncate" title="<?= $produto['nome'] ?>"><?= $produto['nome'] ?></h6>
                          <p class="mb-1 small text-muted">Cód: <?= $produto['codigo_barras'] ?></p>
                          <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold text-success">R$ <?= number_format($produto['valor'], 2, ',', '.') ?></span>
                            <span class="badge bg-primary text-white px-2 py-1"><?= $produto['quantidade'] ?></span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php endforeach; ?>
                </div>
              </div>
            </div>
            <div class=" d-flex fixed-bottom justify-content-end w-100 p-3 ">
              <a href="<?= BASE_URL ?>OperadorCaixa/CancelarVenda" class="btn btn-danger btn-cancelar me-2">Cancelar Venda</a>
              <button class="btn btn-success btn-finalizar" data-bs-toggle="modal" data-bs-target="#ModalCaixa">Finalizar Venda</button>
              <?php
              $data = $operador['data_abertura'];
              $data_de_abertura = str_replace(" ", "_", $data);
              ?>
              <a href="<?= BASE_URL ?>OperadorCaixa/FecharCaixa/<?= $operador['caixa'] ?? '' ?>/<?= $data_de_abertura ?> " class="btn btn-danger btn-cancelar mx-2">Fechar caixa</a>
            </div>

        </div>
      </div>


    </div>
  </div>



  <div class="modal fade" id="ModalCaixa" tabindex="-1" aria-labelledby="ModalCaixaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="ModalCaixaLabel">Dados para finalizar a compra</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <?php
          $caixa = $operador['caixa'] ?? '';
          $name = $operador['nome'] ?? '';
          $data_abertura = isset($operador['data_abertura']) ? str_replace(['/', ':', ' '], ['-', '-', '_'], trim($operador['data_abertura'])) : '';

          $total = 0;
          if (isset($_SESSION['caixa']) && is_array($_SESSION['caixa'])) {
            foreach ($_SESSION['caixa'] as $item) {
              $total += $item['price'];
            }
          }
          ?>

          <form id="formulario" method="get" action="<?= BASE_URL ?>OperadorCaixa/CompraCaixa/<?= $caixa ?>/<?= $name ?>/<?= $data_abertura ?>">
            <div class="row g-3">
              <div class="col-6">
                <div class="card shadow-sm w-100">
                  <input type="hidden" name="total_compra" value="<?= $total ?>">
                  <div class="card-title m-2">Dados para finalização da compra</div>
                  <div class="card-body p-2">
                    <div class="mb-3">
                      <select name="forma_de_pagamento" class="form-select" required>
                        <option value="">Selecione a forma de pagamento</option>
                        <option value="pix">Pix</option>
                        <option value="especie">Espécie</option>
                        <option value="credito">Cartão de Crédito</option>
                        <option value="debito">Cartão de Débito</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="">Valor recebido:</label>
                      <input type="text" id="nome" name="nome" class="form-control" onkeyup="mostrarSugestao(this.value)">
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-6">
                <div class="card shadow-sm w-100">
                  <div class="card-body">
                    <div class="m-3 text-dark card-title">Valor total</div>
                    <h1 class="mb-3 text-primary text-center">R$<?= number_format($total, 2, ',', '.') ?></h1>
                    <div class="form-group m-2">
                      <p>Sugestões: <span id="txtSugestao"></span></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Finalizar Compra</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script>
    const toggleBtn = document.getElementById('toggleBtn');
    const sidebar = document.getElementById('sidebar');
    toggleBtn.addEventListener('click', () => {
      sidebar.classList.toggle('active');
    });

    function mostrarSugestao(str) {
      if (str.length == 0) {
        document.getElementById("txtSugestao").innerHTML = "";
        return;
      }
      const xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("txtSugestao").innerHTML = this.responseText;
        }
      };
      xmlhttp.open("GET", "http://localhost/estruturamvc/OperadorCaixa/troco?q=" + str, true);
      xmlhttp.send();
    }
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>