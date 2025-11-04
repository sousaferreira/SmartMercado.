<main class="container h-100 mt-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header px-2">
                    <div class="d-flex card-header justify-content-between align-items-center">
                        <h1 class="card-title">Indisponíveis</h1>
                        <a class="btn btn-primary" href="<?= BASE_URL ?>Business/ExportarCSV">
                            <i class="bi bi-download"></i> Gerar planilha
                        </a>
                    </div>
                    <hr>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Valor</th>
                                    <th scope="col">Categoria</th>
                                    <th scope="col">Quantidade</th>
                                    <th scope="col">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($missing as $produto): ?>
                                    <?php $id = $produto['hash']; ?>
                                    <tr>
                                        <td><?= htmlspecialchars($produto['nome']) ?></td>
                                        <td><?= htmlspecialchars($produto['valor']) ?></td>
                                        <td><?= htmlspecialchars($produto['categoria_id']) ?></td>
                                        <td><?= htmlspecialchars($produto['quantidade']) ?></td>
                                        <td>
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-<?= $id ?>">
                                                Retornou
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Modal de cada produto -->
                                    <div class="modal fade" id="modal-<?= $id ?>" tabindex="-1" aria-labelledby="label-<?= $id ?>" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="label-<?= $id ?>">Produto: <?= htmlspecialchars($produto['nome']) ?></h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <img src="<?= BASE_URL . $produto['imagem'] ?>" alt="<?= htmlspecialchars($produto['nome']) ?>" height="200">
                                                    <form method="get" action="<?= BASE_URL; ?>Business/editAmount/<?= $produto['hash'] ?>" class="mt-3">
                                                        <div class="form-floating mb-3">
                                                            <input type="number" name="quantidade" class="form-control" id="quantidade-<?= $id ?>" placeholder="Quantidade" required>
                                                            <label for="quantidade-<?= $id ?>">Quantidade</label>
                                                        </div>

                                                        <div class="form-floating mb-3 mt-3">
                                                            <input type="text" name="valor" class="form-control" id="floatingInput" placeholder="R$ 00.00" onkeypress="return(moeda(this,'.',',',event))" value="<?= $produto['valor'] ?>">
                                                            <label for="floatingInput">Valor:</label>
                                                        </div>
                                                        <div class="form-floating mt-3 mb-3">

                                                            <textarea id="descricao" name="descricao" rows="5" cols="40" class="form-control mt-3"></textarea>
                                                            <label for="floatingInput">Observação</label>
                                                        </div>
                                                        <button class="btn btn-success w-100" type="submit">Atualizar</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>