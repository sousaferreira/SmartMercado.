<main class="content">
	<div class="container-fluid p-0">
		<div class="row mb-2 mb-xl-3">
			<div class="col-auto d-none d-sm-block">
				<h3 class="fw-bold text-primary"><strong>Vendas</strong></h3>
			</div>

			<div class="col-auto ms-auto text-end mt-n1">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
						<li class="breadcrumb-item">Vendas</li>
						<li class="breadcrumb-item active" aria-current="page">Mensais</li>
					</ol>
				</nav>
			</div>
		</div>

		<div class="row">
			<div class="col-12">
				<div class="card shadow-sm border-0">
					<div class="card-header bg-primary text-light d-flex justify-content-between align-items-center">
						<h5 class="mb-0">Vendas Mensais</h5>
					</div>

					<div class="card-body">
						<div class="chart-container" style="position: relative; height:400px; width:100%;">
							<canvas id="graficoVendas"></canvas>
						</div>

						<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
						<script>
							document.addEventListener("DOMContentLoaded", () => {
								const ctx = document.getElementById('graficoVendas').getContext('2d');

								// Dados vindos do backend
								const meses = <?= $nomes ?>; // ["Janeiro", "Fevereiro", ...]
								const valores = <?= $totais ?>; // [1200, 1400, 1800, ...]

								// Criando um gradiente bonito
								const gradiente = ctx.createLinearGradient(0, 0, 0, 400);
								gradiente.addColorStop(0, 'rgba(93, 120, 255, 0.8)');
								gradiente.addColorStop(1, 'rgba(93, 120, 255, 0.1)');

								new Chart(ctx, {
									type: 'line',
									data: {
										labels: meses,
										datasets: [{
											label: 'Total de Vendas (R$)',
											data: valores,
											fill: true,
											backgroundColor: gradiente,
											borderColor: '#3550ff',
											borderWidth: 3,
											pointBackgroundColor: '#3550ff',
											pointBorderColor: '#fff',
											pointHoverRadius: 8,
											pointRadius: 5,
											tension: 0.4 // Deixa o gráfico mais curvado
										}]
									},
									options: {
										responsive: true,
										maintainAspectRatio: false,
										plugins: {
											legend: {
												display: true,
												position: 'top',
												labels: {
													color: '#333',
													font: { size: 16, weight: 'bold' }
												}
											},
											tooltip: {
												backgroundColor: 'rgba(0,0,0,0.8)',
												titleFont: { size: 14, weight: 'bold' },
												bodyFont: { size: 13 },
												callbacks: {
													label: context => {
														return ' R$ ' + context.parsed.y.toLocaleString('pt-BR', {
															minimumFractionDigits: 2,
															maximumFractionDigits: 2
														});
													}
												}
											}
										},
										scales: {
											x: {
												grid: { display: false },
												ticks: { color: '#555', font: { size: 13 } }
											},
											y: {
												beginAtZero: true,
												grid: { color: '#e6e6e6' },
												ticks: {
													color: '#555',
													font: { size: 13 },
													callback: value => 'R$ ' + value.toLocaleString('pt-BR')
												}
											}
										}
									}
								});
							});
						</script>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
