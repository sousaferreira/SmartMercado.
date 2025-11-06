<main class="content">
	<div class="container-fluid p-0">

        
         <a href="<?=BASE_URL?>Voltar/Compras" class="mb-3 btn d-flex align-items-center justify-content-center btn btn-outline-secondary rounded-circle" style="width: 38px; height: 38px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
            </svg></a>
        <div class="col">
            <div class="card">
                <div class="card-header d-flex align-items-center gap-2"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                        <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z" />
                    </svg> Compras realizadas com sucesso</div>



                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>

                                <th scope="col">Nome </th>
                                <th scope="col">Whatsapp</th>
                                <th scope="col">Endereço</th>
                                <th scope="col">Forma de pagamento</th>
                                <th scope="col">...</th>

                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach ($compras as $produto): ?>

                                <tr>
                                    <?php $id = $produto['id_compra'] ?>

                                    <td><?= htmlspecialchars($produto['nome_cliente']) ?></td>
                                    <td><?= htmlspecialchars($produto['whatsapp']) ?></td>
                                    <td> <a class="btn  btn-outline-secondary btn-sm p-2 rounded" data-bs-toggle="modal" data-bs-target="#modal-<?= $id ?>">Ver tudo</td>
                                    <td><?= htmlspecialchars($produto['Radio']) ?></td>
                                    <td>
                                       
                                        <a href="<?=BASE_URL?>Business/CompraRealizadas/<?=$id?>" class="btn btn-outline-success btn-sm p-2 rounded"> Ver compras</a>
                                        
                                    </td>



                                </tr>


                                <!-- INICIO DE MODAL ENDEREÇO -->
                                
                                    <div class="modal fade" id="modal-<?= $id ?>" tabindex="-1" aria-labelledby="label-<?= $id ?>" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="label-<?= $id ?>">Cliente: <?= htmlspecialchars($produto['nome_cliente']) ?></h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body mt-3 mb-4">
                                                <h6 class="mt-2">Rua:</h6>
                                                <input class="form-control mt-2" type="text" placeholder="<?=$produto['rua']?>" readonly>

                                                <h6 class="mt-2">Bairro</h6>
                                                 <input class="form-control mt-2" type="text" placeholder="<?=$produto['bairro']?>" readonly>
                                                
                                                <h6 class="mt-2">Número</h6>
                                                <input class="form-control mt-2" type="text" placeholder="<?=$produto['numero_casa']?>" readonly>

                                                <h6 class="mt-2">Ponto de referência</h6>
                                                <input class="form-control mt-2" type="text" placeholder="<?=$produto['ponto_de_referencia']?>" readonly>                                                   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <!-- FIM DO MODAL ENDEREÇO -->




                            <?php endforeach ?>
                        </tbody>
                    </table>
         

                </div>

            </div>
        </div>
</main>