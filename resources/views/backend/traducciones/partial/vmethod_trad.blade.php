setInicialTrad: function () {
self = this;
this.traduccion = {
text: []
};
this.idiomas.forEach(function (item) {
self.traduccion.text.push({
lengua: item.sigla,
text: ''
});
});
this.$nextTick()
.then(() => {
this.$validator.reset('modal_trad.*');
// this.errors.;
});
},
showTradModal: function (campo) {
if(typeof this.campo_trad !== 'undefined'){
this.$nextTick().then(()=>{this.campo_trad=campo;});
$("#tradModalTitle").text("Traducción de " + campo);
$("#tradModal").modal("show");
}else{
$("#tradModalTitle").text("Traducción de " + campo);
$("#tradModal").modal("show");}
},