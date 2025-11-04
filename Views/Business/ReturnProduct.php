<main class="container h-100 w-50 mt-5">
    <div class="card">
        <div class="card-header">
            <div class="card-title">Atualize a quantidade</div>
        <hr>
        </div>
        <div class="card-body">
            <img src="<?= BASE_URL . $products['imagem'] ?>" alt="" height="200px">
           <h3><?= $products['nome'] ?></h3>
            <form class="" method="post" action="<?= BASE_URL; ?>Business/editAmount/<?= $products['hash'] ?>" enctype="multipart/form-data">
             
            <div class="form-floating">
                    <input type="text" name="quantidade" class="form-control" id="floatingInput" placeholder="Quantidade" value="">
                    <label for="floatingInput">Quantidade</label>
                </div>
                

                <button class="w-90 btn btn-lg btn-success mt-3" type="submit" onclick="alert()">Editar</button>

            </form>


<script>
    function alert() {
        return confirm('Você tem certeza que vai editar')
    }
</script>

</div>
</div>
<script src="../Assets/js/script.js"></script>



</main>