<main class="container h-100 ">
    <div class="content">
        <div class="card">
            <div class="card-header d-flex align-items-center gap-3">
                <?php
                foreach ($client as $user): ?>
                
                    <a href="<?=BASE_URL?>Voltar/TableDelivery" class="mb-4"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                        </svg></a>
                    <div class="card-title mt-3">
                        Compras realizadas por <?= $user['nome_cliente'] ?>
                        <hr>
                    </div>
                <?php endforeach ?>
            </div>
            <div class="card-body">
                <div class="row">
                    <table class="table">
                        <thead>
                            <tr>

                                <th scope="col">#</th>
                                <th scope="col">Produto</th>
                                <th scope="col">Quantidade</th>


                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach ($compra_user as $compra): ?>

                                <tr>
                                    <td> <img src="<?= BASE_URL . $compra['imagem'] ?>" alt="<?= htmlspecialchars($compra['nome']) ?>" height="60"></td>
                                    <td><?= htmlspecialchars($compra['nome']) ?></td>
                                    <td><?= htmlspecialchars($compra['quantidade']) ?></td>

                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</main>