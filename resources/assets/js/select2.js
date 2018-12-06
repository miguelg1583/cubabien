Vue.component('select2', {
    template: `<select class="form-control"></select>`,
    props: {
        value: {
            default: null,
            required: true,
            validator(value) {
                // console.log(value);
                return value === null || typeof value === 'string' || value instanceof String;
            }
        },
        options: {
            type: Array
        },
        allowclear: {
            type: Boolean
        }
    },
    data() {
        return {
            elem: null
        };
    },
    mounted() {
        let vm = this;
        this.elem = jQuery(this.$el);
        this.elem.select2({
            allowClear: this.allowclear,
            data: this.options,
            placeholder: "Seleccione..."
        }).val(this.value).trigger('change').on('change', function () {
            if(vm.value != this.value){
                console.log('Componente select2 vm.value',vm.value);
                console.log('Componente select2 this.value',this.value);
                // vm.value=this.value;
                vm.$emit('input', this.value);
            }

        });
    },
    watch: {
        value(nv) {
            this.elem.val(nv).trigger('change');
        },
        options(no) {
            this.elem.empty().select2({data: no, allowClear: this.allowclear, placeholder: "Seleccione..."}).val(this.value).trigger("change");        }
    },
    beforeDestroy() {
        if (this.elem) {
            this.elem.off().select2('destroy');
            this.elem = null;
        }
    },
});