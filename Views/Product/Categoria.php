<main>
         <div class="card-body">
						<div class="row">
							    <?php foreach ($buscar as $item): ?>
								<div class="col-sm-4 pb-5">
									<div class="card h-100">


										<img src="<?= BASE_URL . $item['imagem'] ?>" class="card-img-top" alt="<?= htmlspecialchars($item['nome']) ?>" style="max-width: 300px;">

										<div class="card-body">
											<h3 class="card-title"><?= htmlspecialchars($item['nome']) ?></h3>
											<p class="card-text"><?= htmlspecialchars($item['descricao']) ?></p>
											<a href="<?= BASE_URL; ?>Product/CardSelect/<?= $item['hash'] ? $item['hash'] : $item['id'] ?>" class="btn btn-primary">Ver mais</a>
										
                                        </div>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
</main>