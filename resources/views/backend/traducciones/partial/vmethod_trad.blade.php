setInicialTrad: function () {
this.traduccion = {
// group: "categoria-faq",
// key: "",
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
$("#tradModalTitle").text("Traducción del " + campo);
$("#tradModal").modal("show");
},