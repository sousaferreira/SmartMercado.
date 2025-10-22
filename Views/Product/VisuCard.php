<main class="d-flex container h-100">
    <div class="row justify-content-center mt-5">
        <div class="col-sm-5">
            <img class="card-img-top object-fit-cover image-fluid roudend" src="<?= BASE_URL . $products['imagem'] ?>" alt="image">

        </div>
        <div class="col-md- mb-5 mt-5">
            <div class="">
            <h1><?= $products['nome'] ?></h1>
            <p><?= $products['descricao'] ?></p>
            <h2 class="card-text">R$ <?= $products['valor'] ?></h2>
            </div>
            <div class="mt-5">
            <a href="<?= BASE_URL; ?>Product/cartSave/<?= $products['hash'] ?>" class="btn btn-primary align-self-end p-2 mt-2">Adicionar ao carrinho <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-cart-check-fill" viewBox="0 0 16 16">
                    <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0m-1.646-7.646-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L8 8.293l2.646-2.647a.5.5 0 0 1 .708.708" />
                </svg></a>
                
            <a href="<?= BASE_URL; ?>Product/BuyProduct/<?= $products['hash'] ?>" class="btn btn-success align-self-end p-2 mt-2">Comprar agora <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-bag" viewBox="0 0 16 16">
                    <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z" />
                </svg></a>
                </div>
        </div>

</main>