<body class="d-flex flex-column min-vh-100 bg-body-primary">
    <?php
    require_once dirname(__DIR__, 3) . '/resources/views/partials/header.php';
    ?>
    <div class="d-flex flex-row flex-grow-1">
        <?php
        require_once dirname(__DIR__, 3) . '/resources/views/partials/nav.php';
        ?>

        <main class="flex-grow-1 p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0 text-dark fw-bold">Bem-vindo, professor!</h1>
                <!-- Adicionado data-bs-toggle e data-bs-target para acionar o modal -->
                <button class="btn btn-primary d-flex align-items-center gap-2 px-3 py-2 shadow-sm" data-bs-toggle="modal" data-bs-target="#qrCodeModal">
                    <span class="material-icons fs-5">qr_code</span>
                    <span>Gerar QR Code</span>
                </button>
            </div>

            <!-- Seção de Cards (Linha 1) com Grid e Espaçamento -->
            <div class="row g-4 mb-4">
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card border-0 shadow-sm bg-body-tertiary h-100">
                        <div class="card-body">
                            <h5 class="card-title text-muted fs-6 mb-2">Alunos Matriculados</h5>
                            <p class="card-text fs-4 fw-bold text-dark mb-0">28</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card border-0 shadow-sm bg-body-tertiary h-100">
                        <div class="card-body">
                            <h5 class="card-title text-muted fs-6 mb-2">Presenças Hoje</h5>
                            <p class="card-text fs-4 fw-bold text-success mb-0">14</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card border-0 shadow-sm bg-body-tertiary h-100">
                        <div class="card-body">
                            <h5 class="card-title text-muted fs-6 mb-2">Aulas no Mês</h5>
                            <p class="card-text fs-4 fw-bold text-primary mb-0">12</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Seção de Cards (Linha 2) -->
            <div class="row g-4">
                <div class="col-12 col-lg-6">
                    <div class="card border-0 shadow-sm bg-body-tertiary h-100">
                        <div class="card-body">
                            <h5 class="card-title fw-bold mb-3">Últimas Chamadas</h5>
                            <p class="text-muted mb-0">Nenhuma chamada registrada recentemente.</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="card border-0 shadow-sm bg-body-tertiary h-100">
                        <div class="card-body">
                            <h5 class="card-title fw-bold mb-3">Próximas Turmas</h5>
                            <p class="text-muted mb-0">Nenhuma aula agendada para hoje.</p>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <div class="modal fade" id="qrCodeModal" tabindex="-1" aria-labelledby="qrCodeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold text-dark" id="qrCodeModalLabel">QR Code da Chamada</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center py-4">
                    <p class="text-muted mb-3">Escaneie o código abaixo para registrar a presença:</p>

                    <div class="p-3 bg-light rounded d-inline-flex align-items-center justify-content-center shadow-sm" style="width: 280px; min-height: 280px;">
                        <div id="qrCodeLoading" class="d-flex flex-column align-items-center gap-2" role="status" aria-live="polite">
                            <span class="spinner-border text-primary" aria-hidden="true"></span>
                            <span class="text-muted">Gerando QR Code...</span>
                        </div>
                        <img id="qrCodeImage" alt="QR Code da chamada" class="img-fluid rounded d-none" style="max-width: 250px;" />
                        <p id="qrCodeError" class="text-danger mb-0 d-none" role="alert"></p>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0 justify-content-center">
                    <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Fechar</button>
                    <button id="refreshQrCode" type="button" class="btn btn-primary px-4">Atualizar QR Code</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Adicionar jquery no lugar do javascript normal
        
        (() => {
            const modal = document.getElementById('qrCodeModal');
            const image = document.getElementById('qrCodeImage');
            const loading = document.getElementById('qrCodeLoading');
            const error = document.getElementById('qrCodeError');
            const refreshButton = document.getElementById('refreshQrCode');
            let currentImageUrl = null;
            let requestController = null;

            async function generateQrCode() {
                requestController?.abort();
                requestController = new AbortController();
                loading.classList.remove('d-none');
                image.classList.add('d-none');
                error.classList.add('d-none');
                error.textContent = '';
                refreshButton.disabled = true;

                if (currentImageUrl) {
                    URL.revokeObjectURL(currentImageUrl);
                    currentImageUrl = null;
                }

                try {
                    const form = new URLSearchParams({
                        content: `VClass-Chamada-${new Date().toISOString().slice(0, 10)}`,
                        size: '300'
                    });
                    const serviceUrl = `${window.location.protocol}//${window.location.hostname}:8081/api/v1/qrcodes`;
                    const response = await fetch(serviceUrl, {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                        body: form,
                        signal: requestController.signal
                    });

                    if (!response.ok) {
                        throw new Error(`O serviço respondeu com status ${response.status}.`);
                    }

                    const imageBlob = await response.blob();
                    currentImageUrl = URL.createObjectURL(imageBlob);
                    image.onload = () => {
                        loading.classList.add('d-none');
                        image.classList.remove('d-none');
                    };
                    image.onerror = () => {
                        loading.classList.add('d-none');
                        error.textContent = 'Não foi possível carregar a imagem do QR Code.';
                        error.classList.remove('d-none');
                    };
                    image.src = currentImageUrl;
                } catch (requestError) {
                    if (requestError.name === 'AbortError') return;
                    loading.classList.add('d-none');
                    error.textContent = 'Falha ao gerar o QR Code. Verifique se o serviço Skynda está disponível.';
                    error.classList.remove('d-none');
                } finally {
                    refreshButton.disabled = false;
                }
            }

            modal.addEventListener('shown.bs.modal', generateQrCode);
            refreshButton.addEventListener('click', generateQrCode);
            modal.addEventListener('hidden.bs.modal', () => requestController?.abort());
        })();
    </script>
</body>