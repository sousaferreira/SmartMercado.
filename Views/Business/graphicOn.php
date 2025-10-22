<main class="content">
    <div class="container-fluid p-0">

        <div class="row mb-2 mb-xl-3">
            <div class="col-auto d-none d-sm-block">
                <h3 class="fw-bold text-primary"><strong>Disponível</strong></h3>
            </div>

            <div class="col-auto ms-auto text-end mt-n1">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                        <li class="breadcrumb-item">Gráficos</li>
                        <li class="breadcrumb-item active" aria-current="page">Disponível</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header ">
                        <div class="d-flex card-header justify-content-between align-items-center">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="mb-0">Produtos em estoque</h5>
                                </div>

                                <a class="" href="<?= BASE_URL ?>Business/Voltar"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#585858ff" class="bi bi-box-arrow-in-left" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M10 3.5a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 1 1 0v2A1.5 1.5 0 0 1 9.5 14h-8A1.5 1.5 0 0 1 0 12.5v-9A1.5 1.5 0 0 1 1.5 2h8A1.5 1.5 0 0 1 11 3.5v2a.5.5 0 0 1-1 0z" />
                                        <path fill-rule="evenodd" d="M4.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H14.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708z" />
                                    </svg></a>
                            </div>
                        <hr>
                    </div>
                    <div class="card-body">
                        <div class="row d-flex justify-content-center">
                            <div class="col-md-10">
                                <div class="card">
                                    <div class="card-header">

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





                        </div>
                    </div>

                </div>


</main>