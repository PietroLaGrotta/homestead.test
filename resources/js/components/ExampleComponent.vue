<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h1>Dettagli gruppo {{username}} </h1></div>

                    <div class="card-body">

                        {{username}} 
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

        props: ['username'],

        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
