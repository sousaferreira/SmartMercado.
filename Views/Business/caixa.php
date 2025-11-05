<main class="container mt-4 h-100">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h1 class="card-title mb-0">Gerenciar Caixa</h1>
                </div>

                <div class="card-body">
                    <!-- 🔹 TABELA RESPONSIVA -->
                    <div class="table-responsive">
                        <table class="table table-striped align-middle">
                            <thead class="table-secondary">
                                <tr>
                                    <th>Id operador</th>
                                    <th>Abertura do caixa</th>
                                    <th>Fechamento de caixa</th>
                                    <th>Valor Inicial</th>
                                    <th>Valor final</th>
                                    <th>Status</th>
                                    <th>Caixa</th>
                                    <th>Valor final</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
          
                                <?php 
                                
                                
                                foreach ($caixa as $produto): 
                                    $id = $produto['id'];
                                ?>
                                <tr>
                                    <td><?= htmlspecialchars($produto['id_operador']) ?></td>
                                    <td><?= htmlspecialchars($produto['data_abertura']) ?></td>
                                    <td><?= htmlspecialchars($produto['data_fechamento']) ?></td>
                                    <td><?= htmlspecialchars($produto['valor_inicial']) ?></td>
                                    <td><?= htmlspecialchars($produto['valor_final']) ?></td>
                                    <td>
                                        <?php if($produto['status'] == 'aberto'): ?>
                                            <span class="badge bg-success"><?= $produto['status'] ?></span>
                                        <?php else: ?>
                                            <span class="badge bg-danger"><?= $produto['status'] ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= htmlspecialchars($produto['caixa']) ?></td>
                                    <td><?= htmlspecialchars($_SESSION['valor_compras']['valorCompra'])?></td>
                                    <td>
                                        <a data-bs-toggle="modal" data-bs-target="#modal-<?= $id ?>" class="me-2" title="Adicionar valor inicial">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-plus text-primary" viewBox="0 0 16 16">
                                                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                                            </svg>
                                        </a>
                                    </td>
                                </tr>

                                <!-- Modal individual -->
                                <div class="modal fade" id="modal-<?= $id ?>" tabindex="-1" aria-labelledby="label-<?= $id ?>" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5 text-primary" id="label-<?= $id ?>">Adicione Valor Inicial</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <?php
                                            $data_abertura = isset($operador['data_abertura']) 
                                                ? str_replace(['/', ':', ' '], ['-', '-', '_'], trim($operador['data_abertura'])) 
                                                : '';
                                            ?>
                                            <div class="modal-body">
                                                <form method="post" action="<?= BASE_URL; ?>Business/AddValorInicial/<?= $produto['id'] ?>/<?= $data_abertura?>" enctype="multipart/form-data">
                                                    <div class="form-floating mt-3">
                                                        <input type="text" name="valor_inicial" class="form-control" id="valor_inicial" placeholder="R$ 00.00" >
                                                        <label for="valor_inicial">Valor inicial</label>
                                                    </div>
                                                    <div class="mt-3 text-end">
                                                        <button type="submit" class="btn btn-primary">Enviar</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- 🔹 FIM DA TABELA RESPONSIVA -->
                </div>
            </div>
        </div>
    </div>

    <script src="<?= BASE_URL; ?>Assets/js/script.js"></script>
</main>
