<div id="AgentOperacionModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel2">Autorizar Agencia @{{ agencia.name }}</h4>
            </div>
            <div class="modal-body" id="show_modal_content">
                <p>Al dar clic en <b>Aceptar</b>, dará de alta en el sistema a la agencia @{{ agencia.name }} con un descuento del <b>10%</b>. Además se le enviará un email a la agencia con los siguientes datos de importancia:</p>
                <br>
                <p>Usuario: <b>@{{ agencia.name }}</b></p>
                <p>Email: <b>@{{ agencia.email }}</b></p>
                <p>Contraseña: <b>@{{ agencia.password }}</b></p>
                <br>
                <p>Los usuarios los podrá gestionar en el apartado de <b>Usuarios</b> en el menu <b>Agencia de Viajes</b>.</p>
            </div>
            <div class="modal-footer" id="show_footer">
                <button type="button" class="btn btn-success" data-dismiss="modal" id="actionModal" @click="autorizaAgencia()">Aceptar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>