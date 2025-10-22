<main class="content">
	<div class="container-fluid p-0">

		<div class="row mb-2 mb-xl-3">
			<div class="col-auto d-none d-sm-block">
				<h3 class="fw-bold text-primary"><strong>Dashboards</strong></h3>
			</div>

			<div class="col-auto ms-auto text-end mt-n1">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
						<li class="breadcrumb-item">Dashboards</li>
						<li class="breadcrumb-item active" aria-current="page">Index</li>
					</ol>
				</nav>
			</div>
		</div>

		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header ">
						<div class="d-flex card-header justify-content-between align-items-center">
							<form method="post" action="<?= BASE_URL; ?>Product/Filter">
								<div class="d-flex ">

									<select name="filter" class="form-select">
										<option value="">Todos</option>
										<option value="estoque">Em estoque</option>
										<option value="Indisponivel">Indisponivel</option>
										
									</select>
									<button class="btn" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="#143e74" class="bi bi-funnel" viewBox="0 0 16 16">
											<path d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5zm1 .5v1.308l4.372 4.858A.5.5 0 0 1 7 8.5v5.306l2-.666V8.5a.5.5 0 0 1 .128-.334L13.5 3.308V2z" />
										</svg></button>


								</div>
							</form>


						</div>
						<hr>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-md-6">
								<div class="card">
									<div class="card-header">
										<div class="card-header bg-primary text-light">
								<h5 class="mb-0">Produtos em estoque</h5>
							</div>
									</div>
									<div class="card-body">
										<canvas id="meuGrafico"> </canvas>

										<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
										<script>
											document.addEventListener("DOMContentLoaded", () => {
												const ctx = document.getElementById('meuGrafico').getContext('2d');

												const nomes = <?= $nomes ?>;
												const totais = <?= $totais ?>;

												const meuGrafico = new Chart(ctx, {
													type: 'pie',
													data: {
														labels: nomes,
														datasets: [{
															label: 'Vendas',
															data: totais,
															backgroundColor: [
																'#4e73df',
																'#6f42c1',
																'#1cc88a',
																'#36b9cc',
																'#f6c23e',
																'#e74a3b',
																'#fd7e14',
																'#20c997',
																'#845ef7'
															],
															borderColor: '#fff',
															borderWidth: 2

														}]
													},
													options: {
														plugins: {
															tooltip: {
																callbacks: {
																	label: context => {
																		return ' R$ ' + context.parsed.toLocaleString('pt-BR', {
																			minimumFractionDigits: 2,
																			maximumFractionDigits: 2
																		});
																	}
																}
															},
															legend: {
																position: 'left',
																labels: {
																	font: {
																		size: 18
																	}
																}
															},

														},
														responsive: true,
														maintainAspectRatio: true
													}
												});
											});
										</script>

									</div>
								</div>
							</div>


							<div class="col-md-6">
								<div class="card">
									<div class="card-header">
										<div class="card-header bg-danger text-white">
								<h5 class="mb-0">Produtos em falta</h5>
							</div>
									</div>
									<div class="card-body">
										<canvas id="GráficoSemEstoque"> </canvas>

										<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
										<script>
											document.addEventListener("DOMContentLoaded", () => {
												const ctx = document.getElementById('GráficoSemEstoque').getContext('2d');

												const nomes = <?= $n_falta ?>;
												const totais = <?= $t_falta ?>;

												const meuGrafico = new Chart(ctx, {
													type: 'pie',
													data: {
														labels: nomes,
														datasets: [{
															label: 'Vendas',
															data: totais,
															backgroundColor: [
																'#ff4d4f', 
																'#ff7875', 
																'#ffa940', 
																'#ffc069', 
																'#595959',
																'#8c8c8c', 
																'#d9d9d9',
																'#a8071a', 
																'#ffec3d' 
															],

															borderColor: '#fff',
															borderWidth: 2

														}]
													},
													options: {
														plugins: {
															tooltip: {
																callbacks: {
																	label: context => {
																		return ' R$ ' + context.parsed.toLocaleString('pt-BR', {
																			minimumFractionDigits: 2,
																			maximumFractionDigits: 2
																		});
																	}
																}
															},
															legend: {
																position: 'left',
																labels: {
																	font: {
																		size: 18
																	}
																}
															},

														},
														responsive: true,
														maintainAspectRatio: true
													}
												});
											});
										</script>

									</div>
								</div>
							</div>
						</div>


					</div>
				</div>

			</div>


</main>