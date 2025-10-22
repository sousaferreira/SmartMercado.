<main class="container h-100">
    <div class=" card d-flex justify-content-center rounded-bottom">
        <h1 class="text-center p-2" style="font-family: 'Times New Roman', Times, serif;">Falta pouco para finalizar sua compra </h1>
        <p class="text-center">Preencha os campos abaixo</p>
    </div>
    <div class="row justify-content-center mt-5">
        <div class="col-6 col-md-4">
            <img class="card-img-top object-fit-cover image-fluid roudend" src="<?= BASE_URL . $products['imagem'] ?>" alt="image">

        </div>
        <div class="col-md-6">
            <h4 class="mt-3"><?= $products['nome'] ?></h4>
            <p><?= $products['descricao'] ?></p>
            <div class="form-floating mt-3">
                <input type="text" name="valor" class="form-control" id="floatingInput">
                <label for="floatingInput">Mensagem para o vendedor: </label>
            </div>
            <div class="form-floating mt-3">
                <input type="text" id="cpf" maxlength="14" class="form-control">
                <label for="floatingInput">Digite seu CPF:</label>
            </div>
            <div class="form-floating mt-3">

                <input type="text" id="phone" maxlength="14" class="form-control">
                <label for="floatingInput">Telefone</label>
            </div>
            
                <select class="form-select mt-3" aria-label="Default select example">
  <option selected>Forma de pagamento</option>
  <option value="1">Pix</option>
  <option value="2">Cartão</option>
  <option value="3">Boleto</option>
</select>


                <div class="d-flex align-items-center justify-content-between mt-3">
                    <p>Total da compra:</p>
                    <h4 class=""><?= $products['valor'] ?></h4>
                </div>
                <div class="d-flex justify-content-end mt-3 ">
                    <button type="button" class="btn btn-success w-100" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Comprar agora
                    </button>
                </div>

            </div>

          
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Sua compra foi realizada com sucesso!</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class=" d-flex modal-body justify-content-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="90" height="90" fill="#137a1bff" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                            </svg>


                        </div>
                        <div class="modal-footer">
                            <a href="<?= BASE_URL . 'Home/voltar' ?>"> <button type="button" class="btn btn-primary">Ótimo <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-emoji-smile-fill" viewBox="0 0 16 16">
                                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16M7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5M4.285 9.567a.5.5 0 0 1 .683.183A3.5 3.5 0 0 0 8 11.5a3.5 3.5 0 0 0 3.032-1.75.5.5 0 1 1 .866.5A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1-3.898-2.25.5.5 0 0 1 .183-.683M10 8c-.552 0-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5S10.552 8 10 8" />
                                    </svg></button></a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            document.getElementById('cpf').addEventListener('input', function(event) {
                let inputValue = event.target.value.replace(/\D/g, ''); // Remove caracteres não numéricos
                inputValue = inputValue.substring(0, 11); // Limita a 11 caracteres (9 dígitos + 2 pontos)

                if (inputValue.length > 9) {
                    inputValue = inputValue.replace(/(\d{3})(\d{3})(\d{3})/, '$1.$2.$3-');
                } else if (inputValue.length > 6) {
                    inputValue = inputValue.replace(/(\d{3})(\d{3})/, '$1.$2.');
                } else if (inputValue.length > 3) {
                    inputValue = inputValue.replace(/(\d{3})/, '$1.');
                }

                event.target.value = inputValue;
            });
            document.getElementById('phone').addEventListener('input', function(event) {
                let inputValue = event.target.value.replace(/\D/g, ''); // Remove caracteres não numéricos
                inputValue = inputValue.substring(0, 11); // Limita a 11 caracteres (9 dígitos + 2 pontos)

                if (inputValue.length > 10) {
                    inputValue = inputValue.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
                } else if (inputValue.length > 6) {
                    inputValue = inputValue.replace(/(\d{2})(\d{4})(\d{0,4})/, '($1) $2-$3');
                } else if (inputValue.length > 2) {
                    inputValue = inputValue.replace(/(\d{2})(\d{0,5})/, '($1) $2');
                }

                event.target.value = inputValue;
            });
        </script>
</main>