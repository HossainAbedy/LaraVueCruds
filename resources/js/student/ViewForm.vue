<template>
     <div class="card">
    	<div class="container">
            <div class="row">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Roll</th>
                            <th>Section</th>
                            <th>Class</th>
                            <th>Department</th>
                            <th>Email</th>
                            <th>Mobile</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td> {{ form.id }} </td>
                            <td> {{ form.fname }} </td>
                            <td> {{ form.lname }} </td>
                            <td> {{ form.roll }} </td>
                            <td> {{ form.section }} </td>
                            <td> {{ form.class }} </td>
                            <td> {{ form.dept }} </td>
                            <td> {{ form.email }} </td>
                            <td> {{ form.mobile }} </td>
                        </tr>
                    </tbody>
                </table>
            </div>   
        </div>
    </div>
</template>

<script>
    import { EventBus } from './../vue-assets';
    export default {

        components: {  },

        props:['viewId'],

        data:function(){
            return {
                list:false,
                add_form:false,
                edit_form:false,
                view_form:true,

                form:{
                     name: '',
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

            show(id) {
                var _this = this;
                axios.get(base_url+'student/'+id).then( (response) => {
                    var responseData = response.data;
                    _this.form  = responseData;
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
            _this.show(_this.viewId);
        }

    }
</script>