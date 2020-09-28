export default {
    data(){
        return {
            valid: true,
            dialog: false,
            num1:'',
            num2:'',
            soma1:'',
            soma2:'',
            subitacao1:'',
            subitacao2:'',
            multiplicacao1:'',
            multiplicacao2:'',
            divisao1:'',
            divisao2:'',
            nameRules: [
                v => !!v || 'Preencha digitando um Valor Numérico',
              ],
        }
    },
        beforeCreate() {
            console.log('beforeCreate');
        } ,
        created() {
            console.log('created');
            this.carregar_dialog();
        },
        beforeMount(){
            console.log('beforeMount');
        },
        mounted(){
            console.log('mounted');
        },
        beforeDestroy(){
            console.log('beforeDestroy');
        },
        destroyed(){
            console.log('destroyed');
        },
        
        methods: {
            calcular() {
                //this.$refs.form.validate();
                console.log('chegou aqui. CALCULAR');
                let data = {
                    num1: parseFloat(this.num1),
                    num2: parseFloat(this.num2),
                    soma1: parseFloat(this.num1) + parseFloat(this.num2),
                    soma2: parseFloat(this.num2) + parseFloat(this.num1),
                    subitacao1: parseFloat(this.num1) - parseFloat(this.num2),
                    subitacao2: parseFloat(this.num2) - parseFloat(this.num1),
                    multiplicacao1: parseFloat(this.num1) * parseFloat(this.num2),
                    multiplicacao2: parseFloat(this.num2) * parseFloat(this.num1),
                    divisao1: parseFloat(this.num1) / parseFloat(this.num2),
                    divisao2: parseFloat(this.num2) / parseFloat(this.num1),
                };
                console.log(data);
                this.num1=data.num1;
                this.num2=data.num2;
                this.soma1=data.soma1;
                this.soma2=data.soma2;
                this.subitacao1=data.subitacao1;
                this.subitacao2=data.subitacao2;
                this.multiplicacao1=data.multiplicacao1;
                this.multiplicacao2=data.multiplicacao2;
                this.divisao1=data.divisao1;
                this.divisao2=data.divisao2;
            },

            carregar_dialog(){
                this.dialog = false;
                this.num1 = '';
                this.num2 = '';
                this.soma1 = '';
                this.soma2 = '';
                this.subitacao1 = '';
                this.subitacao2 = '';
                this.multiplicacao1 = '';
                this.multiplicacao2 = '';
                this.divisao1 = '';
                this.divisao2 = '';
            }
                      
        },
}