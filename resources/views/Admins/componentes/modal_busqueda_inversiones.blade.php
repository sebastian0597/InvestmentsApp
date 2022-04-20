<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalInversiones">
    Editar inversión
</button>
<div class="modal fade" id="modalInversiones" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Búsqueda de inversiones.</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form class="needs-validation" novalidate="" accept-charset="UTF-8" enctype="multipart/form-data">
                <div class="mb-3">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control"
                        placeholder="N° de documento del cliente o de contrato"
                            id="busqueda_inversiones">
                        <button onclick="buscarInversionesPorParametros()"
                            style="display: flex; align-items: center"
                            class="btn btn-outline-primary" type="button"><span
                                class="material-icons-outlined">
                                search
                            </span>
                        </button>
                    </div>
                </div>
            </form>
            <div id="investments_container">

            </div>
        </div>
    </div>
</div>