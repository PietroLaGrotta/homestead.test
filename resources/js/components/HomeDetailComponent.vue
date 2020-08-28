<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h1>Dettagli dell'immobile {{home.title}}</h1></div>

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
                                        <strong>Indirizzo</strong>
                                        <textarea class="form-control" placeholder="Indirizzo immobile" v-model="home.address"></textarea>
                                        <!--<span class="text-danger">{{ $errors->first('title') }}</span>-->
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <strong>Nazione</strong>
                                        <input type="text" class="form-control" placeholder="Enter country" v-model="home.country">
                                        <!--<span class="text-danger">{{ $errors->first('title') }}</span>-->
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <strong>Codice postale</strong>
                                        <input type="text" class="form-control" placeholder="Enter zip code" v-model="home.zip_code" maxlength="5">
                                        <!--<span class="text-danger">{{ $errors->first('title') }}</span>-->
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <strong>Latitudine</strong>
                                        <input type="text" class="form-control" placeholder="Enter latitude. Es.: 41.33656284478" v-model="home.latitude" pattern="^(-?\d+(\.\d+)?)$">
                                        <!--<span class="text-danger">{{ $errors->first('title') }}</span>-->
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <strong>Longitudine</strong>
                                        <input type="text" class="form-control" placeholder="Enter longitude. Es.: 41.33656284478" v-model="home.longitude" pattern="^(-?\d+(\.\d+)?)$">
                                        <!--<span class="text-danger">{{ $errors->first('title') }}</span>-->
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <strong>Stato</strong>
                                        <select v-model="home.status" class="form-control">
                                            <option value="1">Visibile</option>
                                            <option value="0">Nascosto</option>
                                        </select>

                                        <!--<span class="text-danger">{{ $errors->first('description') }}</span>-->
                                    </div>
                                </div>
                               
                                <div class="col-md-12">
                                    <button type="button" @click="update" class="btn btn-primary">Submit</button>
                                    <button type="button" onclick="window.location.href='/homes'" class="btn btn-primary">Torna alla lista delle case</button>
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
                    status: 0,
                    latitude: 0,
                    longitude: 0
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
                      console.log(response);
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
