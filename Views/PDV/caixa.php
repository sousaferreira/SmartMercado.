<!DOCTYPE html>
<html lang="pt-BR">
<?php $operador = isset($operador) ? $operador : []; ?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PDV - Sistema de Vendas</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Momo+Trust+Display&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Fascinate&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= BASE_URL ?>/../Assets/css/style.css">
  <style>
    body {
      background-color: #f8f9fa;
      overflow-x: hidden;
    }

    /* Sidebar fixa no desktop */
    .sidebar {
      height: 100vh;
      background-color: #198754;
      color: #fff;
      position: fixed;
      top: 0;
      left: 0;
      width: 350px;
      overflow-y: auto;
      transition: all 0.3s;
      z-index: 1050;
    }

    .sidebar a {
      color: #fff;
      text-decoration: none;
    }

    .sidebar a:hover {
      background-color: #157347;
      color: #fff;
    }

    /* Conteúdo principal */
    .main-content {
      margin-left: 350px;
      padding: 20px;
      transition: all 0.3s;
    }

    /* Botão de menu responsivo */
    .toggle-btn {
      display: none;
      background-color: #198754;
      color: #fff;
      border: none;
      padding: 8px 12px;
      border-radius: 5px;
      position: fixed;
      top: 15px;
      left: 15px;
      z-index: 2000;
    }

    /* Responsividade */
    @media (max-width: 991px) {
      .sidebar {
        left: -350px;
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
  </style>
</head>

<body>
  <button class="toggle-btn" id="toggleBtn">☰ Menu</button>

  <div class="pdv-container">
    <!-- Sidebar -->
    <div class="sidebar p-3" id="sidebar">
      <nav class="h-100">
        <div class="row mx-1">
          <div class="card overflow-auto compras">
            <div class="card-header text-center bg-success text-white">Carrinho</div>
            <div class="card-body">
              <table class="table table-sm text-white">
                <thead>
                  <tr>
                    <th scope="col">Produto</th>
                    <th scope="col">Qtde</th>
                    <th scope="col">Unitário</th>
                    <th scope="col">Total</th>
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

          <div class="mt-3">
            <form action="<?= BASE_URL ?>OperadorCaixa/BuscarCod/" method="GET" class="row g-2 align-items-center">
              <div class="col-12 col-md-6">
                <div class="form-floating">
                  <input type="text" class="form-control" id="codigoBarrasInput" name="codigo_barras" value="<?= $caixa['codigo_barras'] ?? '' ?>" placeholder="Código de barras">
                  <label for="codigoBarrasInput">Código de barras</label>
                </div>
              </div>
              <div class="col-12 col-md-4">
                <div class="form-floating">
                  <input type="text" class="form-control" id="quantidadeInput" name="quantidade" value="<?= $caixa['quantity'] ?? '' ?>" placeholder="Quantidade">
                  <label for="quantidadeInput">Quantidade</label>
                </div>
              </div>
              <div class="col-12 col-md-2 d-flex justify-content-center">
                <button class="btn btn-outline-light w-100 h-100" type="submit" title="Buscar produto">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                  </svg>
                </button>
              </div>
            </form>
          </div>

          <div class="col-12 mt-3">
            <?php
            if(isset($caixa) && is_array($caixa) && count($caixa)>0){
              $ultimoProduto = end($caixa);
            } else {
    $ultimoProduto = null;
}
            ?>
  <div class="card">
    <div class="card-body">
      <?php if ($ultimoProduto): ?>
        <h6 class="text-dark"><?= htmlspecialchars($ultimoProduto['name']) ?></h6>
        <hr style="color: #3c8b52; width: 60%;">
        <div class="text-center mb-4">
          <img src="<?= BASE_URL . htmlspecialchars($ultimoProduto['image']) ?>" 
               alt="<?= htmlspecialchars($ultimoProduto['name']) ?>" 
               class="card-img-top imagem-big" style="max-width: 180px;">
        </div>
        <div class="d-flex align-items-end gap-5 justify-content-end">
          <h2 class="text-success">R$ <?= number_format($ultimoProduto['price'], 2, ',', '.') ?></h2>
        </div>
      <?php else: ?>
        <p class="text-center text-muted m-0">Nenhum produto selecionado</p>
      <?php endif; ?>
    </div>
  </div>
</div>


          <div class="col-12 mt-3">
            <h4 class="text-light">Valor Total</h4>
            <div class="card">
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
      </nav>
    </div>

    <!-- Conteúdo principal -->
    <div class="main-content">
      <div class="pdv-header d-flex flex-wrap justify-content-between align-items-center mb-3">
        <span>Caixa: <strong><?= $operador['caixa'] ?></strong></span>
        <span>Operador: <strong><?= $operador['nome'] ?></strong></span>
        <span>Data: <strong><?= $operador['data_abertura'] ?></strong></span>
      </div>

      <div class="pdv-products">
        <div class="tab-pane fade show active" id="todos-tab-pane" role="tabpanel" aria-labelledby="todos-tab" tabindex="0">
          <div class="row" id="row1">
            <?php foreach ($products as $produto): ?>
              <div class="col-lg-3 col-md-6 mb-3">
                <div class="card card-produto d-flex flex-row align-items-center shadow-sm" style="max-height: 100px;">
                  <div class="product_img mx-3">
                    <img src="<?= BASE_URL . $produto['imagem'] ?>" alt="<?= $produto['nome'] ?>" class="card-img-top" style="width: 70px; height: 100%; object-fit: cover;">
                  </div>
                  <div class="flex-grow-1">
                    <h6 class="mb-1"><?= $produto['nome'] ?></h6>
                    <div class="text-success mb-1">R$ <?= number_format($produto['valor'], 2, ',', '.') ?></div>
                    <p class="text-dark mb-1"><?= $produto['codigo_barras'] ?></p>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>

      <div class="pdv-footer d-flex justify-content-end mt-3">
        <button class="btn btn-danger btn-cancelar me-2">Cancelar Venda</button>
        <button class="btn btn-success btn-finalizar" data-bs-toggle="modal" data-bs-target="#ModalCaixa">Finalizar Venda</button>
        <buttton class="btn btn-danger  btn-cancelar mx-2">Fechar caixa</buttton>
      </div>
    </div>
  </div>

  <!-- Modal intacto -->
  <div class="modal fade" id="ModalCaixa" tabindex="-1" aria-labelledby="ModalCaixaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="ModalCaixaLabel">Dados para finalizar a compra</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <?php
$caixa = isset($operador['caixa']) ? $operador['caixa'] : '';
$name = isset($operador['nome']) ? $operador['nome'] : '';
$data_abertura = isset($operador['data_abertura']) 
    ? str_replace(['/', ':', ' '], ['-', '-', '_'], trim($operador['data_abertura'])) 
    : '';

    $total = 0;
if (isset($_SESSION['caixa']) && is_array($_SESSION['caixa'])) {
    foreach ($_SESSION['caixa'] as $item) {
        $total += $item['price'];
    }
}
    
?>
          <form id="formulario" method="get" action="<?=BASE_URL?>OperadorCaixa/CompraCaixa/<?= $caixa ?>/<?= $name ?>/<?= $data_abertura ?>">
            <div class="col-lg-6 m-3">
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
                   <input  type="text" id="nome" name="nome" class="form-control" onkeyup="mostrarSugestao(this.value)">
                  
                  </div>

                </div>

              </div>
            </div>

            <div class="col-lg-6 m-3">
              <div class="card shadow-sm w-100">
                <div class="card-body">
                  <div class="">
                     <?php $total = 0;
              foreach ($_SESSION['caixa'] as $item):
                $total += $item['price'];
              endforeach ?>

                    <div class="m-3 text-dark card-title">Valor total</div>
                    <h1 class="mb-3 text-primary text-center">R$<?= number_format($total, 2, '.', '.') ?></h1>
                  </div>
                     <div class="form-group m-2">
                       
                  <p>Sugestões: <span id="txtSugestao"></span></p> </div>
                </div>

              </div>
            </div>
 
              
              
              <div id="resposta"></div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" >Close</button>
          </div>
      </div>
      </form>
    </div>
  </div>

  <script>
    const toggleBtn = document.getElementById('toggleBtn');
    const sidebar = document.getElementById('sidebar');
    toggleBtn.addEventListener('click', () => {
      sidebar.classList.toggle('active');
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
  <script>
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
    function oi(){
   alert("oi");
}




function moeda(a, e, r, t) {
      let n = "",
         h = j = 0,
         u = tamanho2 = 0,
         l = ajd2 = "",
         o = window.Event ? t.which : t.keyCode;
      if (13 == o || 8 == o)
         return !0;
      if (n = String.fromCharCode(o),
         -1 == "0123456789".indexOf(n))
         return !1;
      for (u = a.value.length,
         h = 0; h < u && ("0" == a.value.charAt(h) || a.value.charAt(h) == r); h++);
      for (l = ""; h < u; h++) - 1 != "0123456789".indexOf(a.value.charAt(h)) && (l += a.value.charAt(h));
      if (l += n, 0 == (u = l.length) && (a.value = ""), 1 == u && (a.value = "0" + r + "0" + l), 2 == u && (a.value = "0" + r + l), u > 2) {
         for (ajd2 = "",
            j = 0,
            h = u - 3; h >= 0; h--)
            3 == j && (ajd2 += e,
               j = 0),
            ajd2 += l.charAt(h),
            j++;
         for (a.value = "",
            tamanho2 = ajd2.length,
            h = tamanho2 - 1; h >= 0; h--)
            a.value += ajd2.charAt(h);
         a.value += r + l.substr(u - 2, u)
      }
      return !1
   }

  </script>
</body>

</html>