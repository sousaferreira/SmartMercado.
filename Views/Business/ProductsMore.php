<main class="container mt-4 h-100">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header ">
                    <div class="d-flex card-header justify-content-between align-items-center">
                        <h1 class="card-title">Produtos Mais Vendidos</h1>
                       </div>
                    <hr>

        

                    <div class="card-body">
                        <div class="table-responsive mt-3">
    <table class="table align-middle table-striped table-hover mb-0">
        <thead class="table-primary text-center">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Produto</th>
                
                <th scope="col">Total Vendido</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($MaisVendidos)): ?>
                <?php $rank = 1; ?>
                <?php foreach ($MaisVendidos as $produto): ?>
                    <tr class="text-center">
                        <td class="fw-bold text-primary"><?= $rank++; ?></td>
                        <td class="text-start">
                            <div class="d-flex align-items-center">
                                <?php if (!empty($produto['imagem'])): ?>
                                    <img  src="<?= BASE_URL . $produto['imagem'] ?>" 
                                         alt="<?= htmlspecialchars($produto['nome']) ?>" 
                                         class="rounded me-2" width="60" height="60">
                                <?php else: ?>
                                    <img src="<?= BASE_URL ?>Assets/img/sem-imagem.png" 
                                         alt="Sem imagem" class="rounded me-2" width="60" height="60">
                                <?php endif; ?>
                                <div>
                                    <span class="fw-semibold"><?= htmlspecialchars($produto['nome']) ?></span>
                                </div>
                            </div>
                        </td>

                        <td class="fw-bold text-success"><?= htmlspecialchars($produto['total_vendido']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center text-muted py-4">
                        Nenhum produto vendido ainda.
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

                    </div>
                </div>
            </div>
        </div>

        <script src="<?= BASE_URL; ?>Assets/js/script.js"></script>
    </div>
</main>
