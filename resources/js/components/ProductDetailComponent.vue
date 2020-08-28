<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h1>Dettagli prodotto {{product.title}}</h1></div>

                    <div class="card-body">
                        <form name="update_group">
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <strong>Title</strong>
                                        <input type="text" class="form-control" placeholder="Enter Title" v-model="product.title">
                                        <!--<span class="text-danger">{{ $errors->first('title') }}</span>-->
                                    </div>
                                </div>
                                
                                 <div class="col-md-12">
                                    <div class="form-group">
                                        <strong>Gruppo di appartenenza</strong>
                                        <select v-model="product.group_id" class="form-control">
                                            <option v-for="option in groups" v-bind:value="option.value">
                                                {{ option.text }}
                                            </option>
                                        </select>

                                       
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <strong>Description</strong>
                                        <textarea class="form-control" placeholder="Enter Description" v-model="product.description"></textarea>
                                        <!--<span class="text-danger">{{ $errors->first('description') }}</span>-->
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <strong>Barcode</strong>
                                        <input type="text" class="form-control" placeholder="Enter Barcode" v-model="product.barcode">
                                        <!--<span class="text-danger">{{ $errors->first('title') }}</span>-->
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <strong>Prezzo</strong>
                                        <input type="number" class="form-control" placeholder="Enter Price" v-model="product.price" step=".01" min="0">
                                        <!--<span class="text-danger">{{ $errors->first('title') }}</span>-->
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <strong>Stato</strong>
                                        <select v-model="product.status" class="form-control">
                                            <option value="1">Visibile</option>
                                            <option value="0">Nascosto</option>
                                        </select>

                                        <!--<span class="text-danger">{{ $errors->first('description') }}</span>-->
                                    </div>
                                </div>
                               
                                <div class="col-md-12">
                                    <button type="button" @click="update" class="btn btn-primary">Submit</button>
                                    <button type="button" onclick="window.location.href='/products'" class="btn btn-primary">Torna alla lista dei prodotti</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

        data(){
            return {
                product: {
                    id: 0,
                    group_id: 0,
                    title: '',
                    description: '',
                    img_file_name: 'default.jpg',
                    barcode: '',
                    price: 0,
                    status: 0,
                },
                
                groups: [{
                    text: 'Selezionare un gruppo',
                    value: 0
                }] 
            }
        },
        
        props: ['productid', 'userid'],

        mounted() {
            this.load();
        },
        
        methods: {
            load() {
                let api = '/products/' + this.productid;
                console.log(api);
                axios
                  .get(api)
                  .then( response => { 
                      this.product = response.data.product;
                      this.groups  = response.data.groups;
                      //console.log(response.data.subscriptions);
                });
            },

            update() {
                console.log(this.product);
                axios.patch('/products', this.product )
                    .then(response => {
                        console.log(response);
                         if (response.data.success) {
                            alert('Il salvataggio del prodotto è andato a buon fine :-)');
                            window.location.href='/products/' + response.data.productid + '/template';
                         } else {
                            alert('Errori durante il salvataggio del gruppo :-(');
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
