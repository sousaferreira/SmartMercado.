<main class="container h-100">
    <div class="content">
        <div class="card">
            <div class="card-header"> Compras Realizadas</div>
            <div class="card-body">
                <div class="row">
                  
                      <div class="col-lg-12">
                        <div class="card overflow-auto" style="height: 250px;">
                            <div class="card-header d-flex align-items-center gap-2"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-circle" viewBox="0 0 16 16">
                                    <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0" />
                                    <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z" />
                                </svg> Compras 100% finalizadas</div>
                            <div class="card-body">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Id da compra</th>
                                            <th scope="col">Nome do Cliente</th>
                                            <th scope="col">Whatsapp</th>
                                          

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($finalizadas as $compra): ?>
                                            <tr>

                                                <th scope="row"><?= $compra['id_compra'] ?></th>
                                                <td><?= $compra['nome_cliente'] ?></td>
                                                <td><?= $compra['whatsapp'] ?></td>
                                               

                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>

                                </table>
                                             <div class="d-flex justify-content-end">
                               </div>
                            </div>
                        </div> 
                         <div class="d-flex justify-content-end">
                        <a href="<?= BASE_URL ?>Business/ComprasRealizadas" class="btn btn-primary w-20 m-3">Ver detalhes</a>
                         </div> 

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>