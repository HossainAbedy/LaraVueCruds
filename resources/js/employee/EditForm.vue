<template>
    <div class="container">
        <div class="row well" style="margin-top: 40px;">
            <form method="post" v-on:submit.prevent="update(form.id)" class="form-horizontal col-sm-12" id="editComponent" role="form">

                 <div class="form-group">
                    <label for="name" class="col-sm-4 control-label"> First Name </label>
                    <div class="col-sm-4">
                      <input type="text" v-model="form.fname" class="form-control" placeholder="First name">
                       <small class="help-block" v-if="(errors.hasOwnProperty('fname'))" style="color: red;"> {{ (errors.hasOwnProperty('fname')) ? errors.fname[0] :'' }} </small>
                    </div>
                  </div> 

                <div class="form-group">
                    <label for="name" class="col-sm-4 control-label"> Last Name </label>
                    <div class="col-sm-4">
                      <input type="text" v-model="form.lname" class="form-control" placeholder="Last name">
                       <small class="help-block" v-if="(errors.hasOwnProperty('lname'))" style="color: red;"> {{ (errors.hasOwnProperty('lname')) ? errors.lname[0] :'' }} </small>
                    </div>
                  </div> 

                <div class="form-group">
                    <label for="about" class="col-sm-4 control-label"> Mobile </label>
                    <div class="col-sm-4">
                        <input type="text" v-model="form.mobile" class="form-control" placeholder="Mobile">
                         <small class="help-block" v-if="(errors.hasOwnProperty('mobile'))" style="color: red;"> {{ (errors.hasOwnProperty('mobile')) ? errors.mobile[0] :'' }} </small>
                    </div>
                </div> 

                 <div class="form-group">
                    <label for="about" class="col-sm-4 control-label"> Email </label>
                    <div class="col-sm-4">
                        <input type="text" v-model="form.email" class="form-control" placeholder="Email">
                         <small class="help-block" v-if="(errors.hasOwnProperty('email'))" style="color: red;"> {{ (errors.hasOwnProperty('email')) ? errors.email[0] :'' }} </small>
                    </div>
                </div>     


                  <div class="form-group">
                    <div class="col-sm-6">
                        <button class="btn btn-success btn-block" type="submit"> Update </button>
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

        props:['editId'],

        data:function(){
            return {
                list:false,
                add_form:false,
                edit_form:true,
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

            edit(id) {
                var _this = this;
                axios.get(base_url+'employee/'+id+'/edit').then( (response) => {
                    var responseData = response.data;
                    _this.form  = responseData;
                });
            },

            update(id){
                axios.put(base_url+'employee/'+id, this.form).then( (response) => {
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

        created(){
            var _this = this;
            _this.edit(_this.editId);
            console.log(_this.editId);
        }

    }
</script>