Vue.component('autocomplete', {
    template: `<input type="text" class="form-control"/>`,
    props: {
        value: {
            default: null,
            required: true,
            validator(value) {
                return value === null || typeof value === 'string' || value instanceof String
            }
        },
        options: {
            type: Array
        },
    },
    data() {
        return {
            elem: null
        };
    },
    mounted() {
        let self = this;
        this.elem = $(this.$el);
        this.elem.autocomplete({
            lookup: (q, callerSuggest) => {
                let res = _.filter(self.options, function (sq) {
                    return sq.value.toLowerCase().indexOf(q) !== -1 || q.length === 0;
                });
                callerSuggest({suggestions: res});
            },
            onSelect: function (suggestion) {
                self.$emit("input", suggestion.value);
            },
            minChars: 0
        }).on("input",function(evt){
            self.$emit("input", evt.target.value);
        });
    },
    watch: {
        value(nv) {
            this.elem.val(nv).trigger('change.autocomplete');
        }
    },
});