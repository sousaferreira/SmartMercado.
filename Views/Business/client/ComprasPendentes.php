<main class="content">
	<div class="container-fluid p-0">

        <div class="card">
            <div class="card-header"> Compras Realizadas</div>
            <div class="card-body">
                <div class="row">
                  
                    <div class="col-lg-12">
                        <div class="card overflow-auto" style="height: 250px;">
                            <div class="card-header d-flex align-items-center gap-2"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                    <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z" />
                                </svg> Compras para fazer entrega </div>
                            <div class="card-body ">


                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Id da compra</th>
                                            <th scope="col">Nome do Cliente</th>
                                            <th scope="col">Whatsapp</th>
                                            <th scope="col">Entregue?</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($pendentes as $compra): ?>
                                            <tr>

                                                <th scope="row"><?= $compra['id_compra'] ?></th>
                                                <td><?= $compra['nome_cliente'] ?></td>
                                                <td><?= $compra['whatsapp'] ?></td>
                                                <td class="mx-3">
                                                    <a href="<?= BASE_URL ?>Business/Delivered/<?= $compra['id_compra'] ?>" class="btn btn-success"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-circle" viewBox="0 0 16 16">
                                                            <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0" />
                                                            <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z" />
                                                        </svg></a>
                                                </td>

                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>

                                </table>


                            </div>
                            <div class="d-flex justify-content-end">
                               
                            </div>
                        </div>  
                        <div class="d-flex justify-content-end">
                            
                         <a href="<?= BASE_URL ?>Business/Delivery" class="btn btn-primary w-20 m-3">Ver detalhes</a>
                            
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>