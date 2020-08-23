<template>
    <input type="checkbox" v-model="checkvalue" @change="onChange">
</template>

<script>
    
    export default {

        props: ['app', 'checked', 'memberid'],
        
        data() {
            return {
                checkvalue: false
            }
        },

        mounted() {
            this.checkvalue = this.checked == 1;
        },
        
        methods: {
            onChange() {
                axios.patch('/members/', {
                    app: this.app,
                    checked: this.checkvalue ? 1 : 0,
                    memberid: this.memberid
                })
                .then(response => {

                    if (!response.data.success) {
                       alert('Errori durante il salvataggio delle impostazioni :-(');
                       console.log(response);
                    } 
                })
                .catch(error => {
                    alert('Errori durante il salvataggio del gruppo :-( ... guarda la console');
                    console.log(error);
                });
            }
        }
    }
    
</script>
