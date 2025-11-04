<main class="content">
    <div class="container-fluid">
         <a href="<?= BASE_URL ?>Business/VoltarProducts" class="mb-3 btn d-flex align-items-center justify-content-center btn btn-outline-secondary rounded-circle" style="width: 38px; height: 38px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
            </svg>
        </a>
        <div class="row mb-2 mb-xl-3">
            <div class="col-auto d-none d-sm-block">
                <h3><strong>Pix</strong></h3>
            </div>

            <div class="col-auto ms-auto text-end mt-n1">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                        <li class="breadcrumb-item">Pix</li>
                        <li class="breadcrumb-item active" aria-current="page">Index</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="card">
            <div class="card header">
                <div class="pt-3 px-3">
                    <h5 class="card-title mb-0">Finalizar Compra</h5>
                    <hr>
                </div>

            </div>
            <div class="card-body">
                <div class="row d-flex justify-content-between">
                   

                    <div class="col-md-7 ">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Escaneie para pagar com Pix</div>
                            </div>

                            <div class="card-body d-flex">
                                <img alt="QR Code Pix" src="../Assets/img/qrcode-pix.png" height="250px" >

                                <div class="mt-3 w-100">
                                    <div class="">
                                        <h3 class="card-title">Informações</h3>
                                    </div>
                                    <div class="">
                                        <div class="shadow-lg p-3 mb-4 bg-white rounded">Priscila Sousa Ferreira</div>
                                        <div class="shadow-lg p-3 mb-4 bg-white rounded">(88) 981088722</div>
                                        <div class="shadow-lg p-3 mb-4 bg-white rounded">Nubank</div>
                                    
                                    </div>
                                </div>
                            </div>
                       <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content text-center p-2">
                                    <div class="mb-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="#40cc63ff" class="bi bi-patch-check-fill" viewBox="0 0 16 16">
                                            <path d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01zm.287 5.984-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708.708" />
                                        </svg>
                                    </div>
                                    <h5 class="modal-title mb-2" id="exampleModalLabel">Compra Finalizada!</h5>

                                    <p class="mb-4">Obrigado por sua compra. Seu pedido foi processado com sucesso.</p>

                                    <a href="<?= BASE_URL ?>Business/Comprar/<?=$forma_de_pagamento .'/'. $soma[0]?>" class="btn btn-success">Fechar</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                 <div class="col-md-5">
                        <div class="card rounded">
                            <div class="card-header"></div>
                            <div class="card-body">
                                <div class="p-2">
                                    <h3>Valor Total:</h3>
                                    <div class="shadow-lg p-3 mb-4 bg-white rounded" style="font-size: 20px;">R$ <?= $soma[0] ? $soma[0] : '00.00' ?></div>
                                </div>

                                <div class="p-2">
                                    <h3>Forma de pagamento: </h3>
                                    <div class="shadow-lg p-3 mb-4 bg-white rounded" style="font-size: 20px;"><?= $forma_de_pagamento = 'Pix'?></div>
                                </div>
                               <div class="actions">
                            <a href="<?= BASE_URL ?>Business/Recomeçar" onclick="return confirm('Você tem certeza que vai cancelar a compra?')" class="btn btn-danger px-4 py-2">Cancelar</a>
                          
                                <button type="button" class="btn btn-success px-2 py-2" data-toggle="modal" data-target="#exampleModal">
                                Finalizar Compra
                            </button></div>

                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</main>