Vue.component('fe-summernote', {
    template: `<textarea class="form-control"></textarea>`,
    props: {
        value: {
            default: null,
            required: true,
            validator(value) {
                return value === null || typeof value === 'string' || value instanceof String
            }
        },
        height: {
            type: String,
            default: "300"
        }
    },
    data() {
        return {
            elem: null
        }
    },
    mounted() {
        let vm = this,
            config = {
                height: this.height,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link']],
                    ['misc', ['codeview']],
                ],
                dialogsInBody: true
            };
        this.elem = $(this.$el);
        this.changing = false;
        config.callbacks = {
            onInit: function () {
                vm.elem.summernote("code", vm.value);
            }
        };
        vm.$nextTick().then(()=> {
            vm.elem.summernote(config).on("summernote.change",()=>{
                if (!vm.changing){
                    vm.changing = true;
                    vm.$emit("input", vm.elem.summernote("code"));
                    vm.$nextTick(()=>{
                        vm.changing = false;
                    })
                }
            });
        });
        // $(document).ready(function(){
        //
        // });
    },
    watch: {
        value(nv) {
            if (!this.changing) {
                this.changing = true;
                this.elem.summernote("code", (nv === null ? "" : nv));
                this.changing = false;
            }
        }
    },
    beforeDestroy() {
        if (this.elem) {
            this.elem.summernote('destroy');
            this.elem = null;
        }
    }
});