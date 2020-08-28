<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h1>Dettagli automobile {{car.title}}</h1></div>

                    <div class="card-body">
                        <form name="update_group">
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <strong>Title</strong>
                                        <input type="text" class="form-control" placeholder="Enter Title" v-model="car.title">
                                        <!--<span class="text-danger">{{ $errors->first('title') }}</span>-->
                                    </div>
                                </div>
                                
                                 <div class="col-md-12">
                                    <div class="form-group">
                                        <strong>Gruppo di appartenenza</strong>
                                        <select v-model="car.group_id" class="form-control">
                                            <option v-for="option in groups" v-bind:value="option.value">
                                                {{ option.text }}
                                            </option>
                                        </select>

                                       
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <strong>Description</strong>
                                        <textarea class="form-control" placeholder="Enter Description" v-model="car.description"></textarea>
                                        <!--<span class="text-danger">{{ $errors->first('description') }}</span>-->
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <strong>Matricola</strong>
                                        <input type="text" class="form-control" placeholder="Enter Registration Number" v-model="car.registration_number">
                                        <!--<span class="text-danger">{{ $errors->first('title') }}</span>-->
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <strong>Prezzo</strong>
                                        <input type="number" class="form-control" placeholder="Enter Price" v-model="car.price" step=".01" min="0">
                                        <!--<span class="text-danger">{{ $errors->first('title') }}</span>-->
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <strong>Anno di registrazione</strong>
                                        <input type="text" class="form-control" placeholder="Enter Registration Year" v-model="car.registration_year">
                                        <!--<span class="text-danger">{{ $errors->first('title') }}</span>-->
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <strong>Chilometri percorsi</strong>
                                        <input type="number" class="form-control" placeholder="Enter Kilometers" v-model="car.kilometres" step=".1" min="0">
                                        <!--<span class="text-danger">{{ $errors->first('title') }}</span>-->
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <strong>Stato</strong>
                                        <select v-model="car.status" class="form-control">
                                            <option value="1">Visibile</option>
                                            <option value="0">Nascosta</option>
                                        </select>

                                        <!--<span class="text-danger">{{ $errors->first('description') }}</span>-->
                                    </div>
                                </div>
                               
                                <div class="col-md-12">
                                    <button type="button" @click="update" class="btn btn-primary">Submit</button>
                                    <button type="button" onclick="window.location.href='/cars'" class="btn btn-primary">Torna alla lista delle automobili</button>
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
                car: {
                    id: 0,
                    group_id: 0,
                    title: '',
                    description: '',
                    img_file_name: 'default.jpg',
                    registration_number: '',
                    price: 0,
                    kilometres: 0,
                    registration_year: '',
                    status: 0,
                },
                
                groups: [{
                    text: 'Selezionare un gruppo',
                    value: 0
                }] 
            }
        },
        
        props: ['carid', 'userid'],

        mounted() {
            this.load();
        },
        
        methods: {
            load() {
                let api = '/cars/' + this.carid;
                console.log(api);
                axios
                  .get(api)
                  .then( response => { 
                      this.car = response.data.car;
                      this.groups  = response.data.groups;
                      //console.log(response.data.subscriptions);
                });
            },

            update() {
                console.log(this.car);
                axios.patch('/cars', this.car )
                    .then(response => {
                        console.log(response);
                         if (response.data.success) {
                            alert('Il salvataggio automobile è andato a buon fine :-)');
                            window.location.href='/cars/' + response.data.carid + '/template';
                         } else {
                            alert('Errori durante il salvataggio automobile :-(');
                         }
                    })
                    .catch(error => {
                        alert('Errori durante il salvataggio automobile :-( ... guarda la console');
                        console.log(error);
                    });
            }
        }
    }
</script>
