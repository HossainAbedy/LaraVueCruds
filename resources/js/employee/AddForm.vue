<template>
    <div class="container">
        <div class="row">
            <form method="post" v-on:submit.prevent="store" class="form-horizontal col-sm-12" id="addComponent" role="form">
                 <div class="row">
                    <div class="col-sm-4">
                      <label for="name" class="col-sm-4 control-label"> First Name </label>
                      <input type="text" v-model="form.fname" class="form-control" placeholder="First Name">
                       <small class="help-block" v-if="(errors.hasOwnProperty('fname'))" style="color: red;"> {{ (errors.hasOwnProperty('fname')) ? errors.fname[0] :'' }} </small>
                    </div>
                  </div> 

                <div class="row">
                    <div class="col-sm-4">
                      <label for="name" class="col-sm-4 control-label"> Last Name </label>
                      <input type="text" v-model="form.lname" class="form-control" placeholder="Last Name">
                       <small class="help-block" v-if="(errors.hasOwnProperty('lname'))" style="color: red;"> {{ (errors.hasOwnProperty('lname')) ? errors.lname[0] :'' }} </small>
                    </div>
                  </div> 

                <div class="row">
                    <div class="col-sm-4">
                        <label for="about" class="col-sm-4 control-label"> Mobile </label>
                        <input type="text" v-model="form.mobile" class="form-control" placeholder="Mobile">
                         <small class="help-block" v-if="(errors.hasOwnProperty('mobile'))" style="color: red;"> {{ (errors.hasOwnProperty('mobile')) ? errors.mobile[0] :'' }} </small>
                    </div>
                </div> 

                 <div class="row">
                    <div class="col-sm-4">
                        <label for="about" class="col-sm-4 control-label"> Email </label>
                        <input type="text" v-model="form.email" class="form-control" placeholder="Email">
                         <small class="help-block" v-if="(errors.hasOwnProperty('email'))" style="color: red;"> {{ (errors.hasOwnProperty('email')) ? errors.email[0] :'' }} </small>
                    </div>
                </div>

                  <div class="row">
                    <div class="col-sm-2">
                        <button class="btn btn-success btn-block" type="submit"> Save </button>
                    </div>
                  </div>

            </form>
        </div>
    </div>
</template>

<script>
    import { EventBus } from './../vue-assets';
    export default {

        components: {  },

        // props:[''],

        data:function(){
            return {
                list:false,
                add_form:true,
                edit_form:false,
                view_form:false,

                form:{
                    fname: '',
                    lname: '',
                    email: '',
                    mobile: '',
                    
                },
                errors: {},
            };
        },

        methods:{
            store:function() {
                var _this = this;
                axios.post(base_url+'employee', _this.form).then( (response) => {
                    this.showMassage(response.data);
                    EventBus.$emit('data-changed');
                }).catch(error => {
                    if(error.response.status == 422){
                        this.errors = error.response.data.errors;
                    }else{
                        this.showMassage(error);
                    }
                });
            },

            showMassage(data){
                if(data.status == 'success'){
                    toastr.success(data.message, 'Success Alert');
                }else if(data.status == 'error'){
                    toastr.error(data.message, 'Error Alert');
                }else{
                    toastr.error(data.message, 'Error Alert');
                }
            },
        },

    }
</script>
<style scoped>
    img{
        max-height: 66px;
    }
</style>