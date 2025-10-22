<main class="container mt-4 h-100">





    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header ">
                    <div class="d-flex card-header justify-content-between align-items-center">
                        <h1 class="card-title">Produtos</h1>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalProduto"> + Produto </button>

                    </div>
                    <hr>

                    <!-- Modal -->
                    <div class="modal fade" id="ModalProduto" tabindex="-1" aria-labelledby="ModalProdutoLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="ModalProdutoLabel">Adione um novo produto</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="mt-2" method="post" action="<?= BASE_URL; ?>Product/addProduct" enctype="multipart/form-data">
                                        <div class="form-floating">
                                            <input type="text" name="nome" class="form-control mt-3" id="floatingInput" placeholder="Produto">
                                            <label for="floatingInput">Nome do produto</label>
                                        </div>

                                        <div class="form-floating">

                                            <textarea id="descricao" name="descricao" rows="5" cols="40" class="form-control mt-3"></textarea>
                                            <label for="floatingInput">Descrição:</label>
                                        </div>

                                        <div class="form-floating">
                                            <input type="text" name="valor" class="form-control mt-3" id="floatingInput" placeholder="R$ 00.00" onkeypress="return(moeda(this,'.',',',event))">
                                            <label for="floatingInput">Valor:</label>
                                        </div>
                                        <div class="form-floating">
                                            <input type="text" name="quantidade" class="form-control mt-3" id="floatingInput" placeholder="R$ 00.00">
                                            <label for="floatingInput">Quantidade:</label>
                                        </div>
                                        <div class="">
                                            <label for="floatingInput">Selecione uma imagem</label>
                                            <input type="file" name="imagem" id="" accept="imagem/" class="form-control mt-3">
                                        </div>


                                        <label for="floatingInput">Categoria:</label>
                                        <select name="categoria_id" class="form-select" required>
                                            <option value="">Selecione uma categoria</option>
                                            <?php foreach ($categorias as $cat): ?>
                                                <option value="<?= $cat['id'] ?>"><?= $cat['nome'] ?></option>
                                            <?php endforeach; ?>
                                        </select>







                                </div>
                                <div class="modal-footer">
                                    <button class="w-90 btn btn-lg btn-primary mt-3" type="submit">Salvar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

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

                                <?php foreach ($products as $produto): ?>

                                    <tr>
                                        <?php $id = $produto['hash'] ?>
                                        <td><?= htmlspecialchars($produto['nome']) ?></td>
                                        <td><?= htmlspecialchars($produto['valor']) ?></td>
                                        <td><?= htmlspecialchars($produto['categoria_id']) ?></td>
                                        <td><?= htmlspecialchars($produto['quantidade']) ?></td>
                                        <td>
                                            <a href="<?= BASE_URL . "Product/editPage/$id" ?>"></a>

                                            <a data-bs-toggle="modal" data-bs-target="#modal-<?= $id ?>"> <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'>
                                                    <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z' />
                                                    <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z' />
                                                </svg></a>

                                            <a href="<?= BASE_URL . "Product/delete/$id" ?>" onclick="return confirm('Você tem certeza que vai deletar?')"><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'>
                                                    <path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z' />
                                                    <path d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z' />
                                                </svg>
                                        </td></a>


                                    </tr>


                                    <div class="modal fade" id="modal-<?= $id ?>" tabindex="-1" aria-labelledby="label-<?= $id ?>" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="label-<?= $id ?>">Produto: <?= htmlspecialchars($produto['nome']) ?></h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <form class="mt-5" method="post" action="<?= BASE_URL; ?>Product/edit/<?= $produto['hash'] ?>" enctype="multipart/form-data">
                                                        <div class="form-floating">
                                                            <input type="text" name="nome" class="form-control" id="floatingInput" placeholder="Produto" value="<?= $produto['nome'] ?>">
                                                            <label for="floatingInput">Nome do produto</label>
                                                        </div>
                                                        <div class="form-floating">

                                                            <textarea id="descricao" name="descricao" rows="5" cols="40" class="form-control"><?= $produto['descricao'] ?></textarea>
                                                            <label for="floatingInput">Descricao</label>
                                                        </div>

                                                        <div class="form-floating">
                                                            <input type="text" name="valor" class="form-control" id="floatingInput" placeholder="R$ 00.00" onkeypress="return(moeda(this,'.',',',event))" value="<?= $produto['valor'] ?>">
                                                            <label for="floatingInput">Valor:</label>
                                                        </div>
                                                        <div class="">
                                                            <label for="floatingInput">Selecione uma imagem</label>
                                                            <input type="file" name="imagem" id="imagem" accept="imagem/" class="form-control">
                                                        </div>
                                                        <label for="floatingInput">Categoria:</label>
                                                        <select name="categoria_id" class="form-select" required>
                                                            <option value="">Selecione uma categoria</option>
                                                            <?php foreach ($categorias as $cat): ?>
                                                                <option value="<?= $cat['id'] ?>"><?= $cat['nome'] ?></option>
                                                            <?php endforeach; ?>
                                                        </select>

                                                        <button class="w-90 btn btn-lg btn-success mt-3" type="submit" onclick="alert()">Editar</button>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>