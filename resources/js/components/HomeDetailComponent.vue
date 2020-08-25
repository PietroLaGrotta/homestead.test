<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h1>Dettagli gruppo {{home.title}}</h1></div>

                    <div class="card-body">
                        <form name="update_group">
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <strong>Title</strong>
                                        <input type="text" class="form-control" placeholder="Enter Title" v-model="home.title">
                                        <!--<span class="text-danger">{{ $errors->first('title') }}</span>-->
                                    </div>
                                </div>
                                
                                 <div class="col-md-12">
                                    <div class="form-group">
                                        <strong>Gruppo di appartenenza</strong>
                                        <select v-model="home.group_id" class="form-control">
                                            <option v-for="option in groups" v-bind:value="option.value">
                                                {{ option.text }}
                                            </option>
                                        </select>

                                       
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <strong>Description</strong>
                                        <textarea class="form-control" placeholder="Enter Description" v-model="home.description"></textarea>
                                        <!--<span class="text-danger">{{ $errors->first('description') }}</span>-->
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <strong>Codice Immobile</strong>
                                        <input type="text" class="form-control" placeholder="Enter Property Code" v-model="home.property_code">
                                        <!--<span class="text-danger">{{ $errors->first('title') }}</span>-->
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <strong>Prezzo</strong>
                                        <input type="number" class="form-control" placeholder="Enter Price" v-model="home.price" step=".01" min="0">
                                        <!--<span class="text-danger">{{ $errors->first('title') }}</span>-->
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <strong>Stato</strong>
                                        <select v-model="home.visible" class="form-control">
                                            <option value="1">Visibile</option>
                                            <option value="0">Nascosto</option>
                                        </select>

                                        <!--<span class="text-danger">{{ $errors->first('description') }}</span>-->
                                    </div>
                                </div>
                               
                                <div class="col-md-12">
                                    <button type="button" @click="update" class="btn btn-primary">Submit</button>
                                    <button type="button" onclick="window.location.href='/homes'" class="btn btn-primary">Torna alla lista dei prodotti</button>
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
                home: {
                    id: 0,
                    group_id: 0,
                    title: '',
                    description: '',
                    img_file_name: 'default.jpg',
                    property_code: '',
                    price: 0,
                    address: '',
                    country: '',
                    zip_code: '',
                    visible: 0,
                },
                
                groups: [{
                    text: 'Selezionare un gruppo',
                    value: 0
                }] 
            }
        },
        
        props: ['homeid', 'userid'],

        mounted() {
            this.load();
        },
        
        methods: {
            load() {
                let api = '/homes/' + this.homeid;
                console.log(api);
                axios
                  .get(api)
                  .then( response => { 
                      this.home = response.data.home;
                      this.groups  = response.data.groups;
                      //console.log(response.data.subscriptions);
                });
            },

            update() {
                console.log(this.home);
                axios.patch('/homes', this.home )
                    .then(response => {
                        console.log(response);
                         if (response.data.success) {
                            alert('Il salvataggio della casa è andato a buon fine :-)');
                            window.location.href='/homes/' + response.data.homeid + '/template';
                         } else {
                            alert('Errori durante il salvataggio della casa :-(');
                         }
                    })
                    .catch(error => {
                        alert('Errori durante il salvataggio della casa :-( ... guarda la console');
                        console.log(error);
                    });
            }
        }
    }
</script>
