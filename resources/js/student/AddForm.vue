<template>
    <div class="container">
        <div class="row well" style="margin-top: 40px;">
            <form method="post" v-on:submit.prevent="store" class="form-horizontal col-sm-12" id="addComponent" role="form">

                <div class="form-group">
                    <label for="name" class="col-sm-3 control-label"> First Name </label>
                    <div class="col-sm-9">
                      <input type="text" v-model="form.fname" class="form-control" placeholder="First Name">
                       <small class="help-block" v-if="(errors.hasOwnProperty('fname'))" style="color: red;"> {{ (errors.hasOwnProperty('fname')) ? errors.fname[0] :'' }} </small>
                    </div>
                </div> 

                <div class="form-group">
                    <label for="name" class="col-sm-3 control-label"> Last Name </label>
                    <div class="col-sm-9">
                      <input type="text" v-model="form.lname" class="form-control" placeholder="Last Name">
                       <small class="help-block" v-if="(errors.hasOwnProperty('lname'))" style="color: red;"> {{ (errors.hasOwnProperty('lname')) ? errors.lname[0] :'' }} </small>
                    </div>
                </div> 

                <div class="form-group">
                    <label for="name" class="col-sm-3 control-label"> Roll No </label>
                    <div class="col-sm-9">
                      <input type="text" v-model="form.roll" class="form-control" placeholder="Roll">
                       <small class="help-block" v-if="(errors.hasOwnProperty('roll'))" style="color: red;"> {{ (errors.hasOwnProperty('roll')) ? errors.roll[0] :'' }} </small>
                    </div>
                </div> 

                <div class="form-group">
                     <label for="name" class="col-sm-3 control-label"> Section </label>
                    <div class="col-sm-9">
                      <input type="text" v-model="form.section" class="form-control" placeholder="Section">
                       <small class="help-block" v-if="(errors.hasOwnProperty('section'))" style="color: red;"> {{ (errors.hasOwnProperty('section')) ? errors.section[0] :'' }} </small>
                    </div>
                </div>

                <div class="form-group">
                     <label for="name" class="col-sm-3 control-label"> Class </label>
                    <div class="col-sm-9">
                      <input type="text" v-model="form.class" class="form-control" placeholder="Class">
                       <small class="help-block" v-if="(errors.hasOwnProperty('class'))" style="color: red;"> {{ (errors.hasOwnProperty('class')) ? errors.class[0] :'' }} </small>
                    </div>
                </div>

                <div class="form-group">
                     <label for="name" class="col-sm-3 control-label"> Department </label>
                    <div class="col-sm-9">
                      <input type="text" v-model="form.dept" class="form-control" placeholder="Department">
                       <small class="help-block" v-if="(errors.hasOwnProperty('dept'))" style="color: red;"> {{ (errors.hasOwnProperty('dept')) ? errors.dept[0] :'' }} </small>
                    </div>
                </div>    

                 <div class="form-group">
                    <label for="about" class="col-sm-3 control-label"> Email </label>
                    <div class="col-sm-9">
                        <input type="text" v-model="form.email" class="form-control" placeholder="Email">
                         <small class="help-block" v-if="(errors.hasOwnProperty('email'))" style="color: red;"> {{ (errors.hasOwnProperty('email')) ? errors.email[0] :'' }} </small>
                    </div>
                </div>

                  <div class="form-group">
                    <label for="about" class="col-sm-3 control-label"> Mobile </label>
                    <div class="col-sm-9">
                        <input type="text" v-model="form.mobile" class="form-control" placeholder="Mobile">
                         <small class="help-block" v-if="(errors.hasOwnProperty('mobile'))" style="color: red;"> {{ (errors.hasOwnProperty('mobile')) ? errors.mobile[0] :'' }} </small>
                    </div>
                </div> 

                  <div class="form-group">
                    <div class="col-sm-6 col-sm-offset-3">
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
                     roll: '',
                  section: '',
                    class: '',
                     dept: '',
                    email: '',
                   mobile: '',
                    
                },
                errors: {},
            };
        },

        methods:{
            store:function() {
                var _this = this;
                axios.post(base_url+'student', _this.form).then( (response) => {
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