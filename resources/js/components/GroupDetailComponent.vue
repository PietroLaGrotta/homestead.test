<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h1>Dettagli gruppo {{group.title}}</h1></div>

                    <div class="card-body">


                        <form name="update_group">
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <strong>Title</strong>
                                        <input type="text" class="form-control" placeholder="Enter Title" v-model="group.title">
                                        <!--<span class="text-danger">{{ $errors->first('title') }}</span>-->
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <strong>Description</strong>
                                        <textarea class="form-control" placeholder="Enter Description" v-model="group.description"></textarea>
                                        <!--<span class="text-danger">{{ $errors->first('description') }}</span>-->
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <strong>Stato</strong>
                                        <select v-model="group.visible" class="form-control">
                                            <option>Visibile</option>
                                            <option>Nascosto</option>
                                        </select>

                                        <!--<span class="text-danger">{{ $errors->first('description') }}</span>-->
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <strong>Abbonamento</strong>
                                        <select v-model="group.subscription_id" class="form-control">
                                            <option v-for="option in subscriptions" v-bind:value="option.value">
                                                {{ option.text }}
                                            </option>
                                        </select>

                                        <!--<span class="text-danger">{{ $errors->first('description') }}</span>-->
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <button type="button" @click="update" class="btn btn-primary">Submit</button>
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
                group: {
                    id: 0,
                    howner_id: this.userid,
                    title: '',
                    description: '',
                    img_file_name: '',
                    visible: '',
                    subscription_id: 0,
                },
                
                subscriptions: [{
                    text: 'Selezionare un abbonamento',
                    value: 0
                }] 
            }
        },
        
        props: ['groupid', 'userid'],

        mounted() {
            this.load();
        },
        
        methods: {
            load() {
                let api = '/groups/' + this.groupid;
                console.log(api);
                axios
                  .get(api)
                  .then( response => { 
                      this.group = response.data.group;
                      this.subscriptions = response.data.subscriptions;
                      console.log(response.data.subscriptions);
                });
            },

            update() {
                axios.patch('/groups', this.group )
                    .then(response => {
                        console.log(response);
                         if (response.data.success) {
                             alert('Il salvataggio del gruppo è andato a buon fine :-)');
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
