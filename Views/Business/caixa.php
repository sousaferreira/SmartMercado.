<main class="content">

    <style>
        .produto-card {
            display: flex;
            flex-direction: column;
            height: 90%;
            width: 100%;
        }

        .card-img-top{
            padding: 10px;
            width: 60%;
            height: 50%;
            object-fit: contain;
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

        .produto-card {
            height: 400px;
            display: flex;
            align-items: center;
            justify-content: start;
            padding: 10px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }
    
    </style>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header"></div>

            <div class="card-body">
                <div class="row">

                    <div class="col-12 col-md-8">
                        <div class="row">
                            <?php foreach ($products as $produto): ?>
                                <div class="col-sm-6 col-lg-4 mb-4">
                                    <div class="card produto-card">
                                        <div class="card-header">
                                            <h4 class="card-title"><?= htmlspecialchars($produto['nome']) ?></h4>
                                        </div>
                                        <img src="<?= BASE_URL . $produto['imagem'] ?>" class="card-img-top" alt="<?= htmlspecialchars($produto['nome']) ?>" style="max-width: 300px;">
                                        <div class="card-body d-flex flex-column">
                                            <form action="<?= BASE_URL ?>Business/AddItemVenda/<?= $produto['hash'] ?>" method="get" class="mt-auto">
                                            
                                            <p><?= htmlspecialchars($produto['descricao']) ?></p>
                                            <h4><?= htmlspecialchars($produto['valor']) ?></h4>
                                            <h6>Quantidade em estoque</h6>
                                            <?php 
                                                if ($produto['quantidade'] <=0){
                                                    echo '<button class="btn btn-danger m-1"> Indisponivel </button>';
                                                    echo '<td><a href='. BASE_URL . 'Business/Return/'.$produto['hash'].' class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5" />
                                            </svg> Retornou</a></td>';
                                                }
                                                else{
                                                    echo '<div class="d-flex align-items-center">';
                                                    echo '<button class="btn btn-light m-2">'.htmlspecialchars($produto['quantidade']) .'</button>';
                                                    echo '<button type="submit" class="btn btn-primary m-2 ">Adicionar</button>';
                                                    echo '</div>';
                                                }
                                            ?>
                                            

                                                <input type="hidden" name="nome" value="<?= htmlspecialchars($produto['nome']) ?>">
                                                <input type="hidden" name="valor" value="<?= $produto['valor'] ?>">
                                                <input type="hidden" name="categoria_id" value="<?= $produto['categoria_id'] ?>">
                                                <input type="hidden" name="descricao" value="<?= $produto['descricao'] ?>">
                                                <input type="hidden" name="imagem" value="<?= $produto['imagem'] ?>">
                                                
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>


                    <div class="col-12 col-md-4">
                        <div class="card p-3" style="position: sticky; top: 20px;">
                            <h4>Seu Carrinho</h4>
                            <p><?= $soma[0] ?></p>

                            <form action="<?= BASE_URL ?>Business/FinishBuy" method="post">
                                <select name="forma_de_pagamento" class="form-select mb-3" required>
                                    <option value="Cartão">Cartão</option>
                                    <option value="Pix">Pix</option>
                                    <option value="Especie">Espécie</option>
                                </select>
                                <input type="hidden" name="total" id="total-input" value="0">

                                <a href="<?= BASE_URL ?>Business/Recomeçar" class="btn btn-danger w-100 mb-2">Cancelar Compra</a>
                                <button type="submit" class="btn btn-success w-100 ">Realizar Compra</button>

                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>



</main>