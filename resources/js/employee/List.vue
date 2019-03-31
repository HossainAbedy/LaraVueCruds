<template>
    <div class="card" v-if="list">
    	<div class="container">
            <div class="row">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody v-if="resultData !=''">
                        <tr v-for="(getdata, index) in resultData.data">
                            <td> {{ index+1 }} </td>
                            <td> {{ getdata.fname }} </td>
                            <td> {{ getdata.lname }} </td>
                            <td> {{ getdata.email }} </td>
                            <td> {{ getdata.mobile }} </td>
                                 <td class="text-center">
                                         <a class="btn btn-danger btn-sm" @click="deleteData(getdata.id)"><i aria-hidden="true" class="fa fa-trash-o btnColor"></i>D</a>
                                         <!-- <a class="btn btn-warning btn-sm" @click="editData(getdata.id)"><i aria-hidden="true" class="fa fa-trash-o btnColor"></i>E</a> -->
                                         <a class="btn btn-warning btn-sm" @click="editData(getdata.id)"><i aria-hidden="true" class="fa fa-pencil-square-o btnColor"></i>E</a>
                                         <a class="btn btn-primary btn-sm" @click="viewData(getdata.id)"><i aria-hidden="true" class="fa fa-pencil-square-o btnColor"></i>V</a>
                                 </td>
                        </tr>
                    </tbody>
                </table>
            </div>   
        </div>
    </div>

    <AddForm  v-else-if="add_form"></AddForm>
    <EditForm  v-else-if="edit_form" :edit-id="edit_id"></EditForm>
    <ViewForm  v-else-if="view_form" :view-id="view_id"></ViewForm>

</template>

<script>  
    import { EventBus } from './../vue-assets';
    import AddForm from './AddForm.vue';
    import EditForm from './EditForm.vue';
    import ViewForm from './ViewForm.vue';
    import Pagination from  './../components/Pagination.vue';
    // import Navbar from  './../components/Navbar.vue';

    export default {
        components: {
            AddForm,
            Pagination,
            EditForm,
            ViewForm,
        },

        data(){
            return {
                list:true,
                add_form:false,
                edit_form:false,
                view_form:false,
                resultData: {},
                perPage: 10,
                base_url: base_url,
            };
        },
        methods: {
            index(pageNo,perPage)
            {
                if(pageNo){ pageNo = pageNo; }else{pageNo = this.resultData.current_page; }
                if(perPage){ perPage = perPage;}else{ perPage = this.perPage;}
                 axios.get(base_url+"employee/?page="+pageNo+"&perPage="+perPage).then((response) => {
                    // this.resultData = response; eita kaj korbe sudhu matro direct object theke value dhorar jonno
                    this.resultData = response.data; // ar eta kaj korbe jokhon custom pagination use korbe ..... 
                });
            },
            changePerPage(){
                var _this = this;
                _this.index(1,_this.perPage);
            },
            editData(id){
                var _this = this;
                _this.list = _this.add_form = _this.view_form = false;
                _this.edit_form = true;
                _this.edit_id = id;
                $('#addBtn').hide();
                $('#listBtn').show();
            },
            viewData(id){
                var _this = this;
                _this.list = _this.add_form = _this.edit_form = false;
                _this.view_form = true;
                _this.view_id = id;
                $('#addBtn').hide();
                $('#listBtn').show();
            },
   
            deleteData: function(id){
                var _this = this;
                axios.delete(base_url+'employee/'+id).then((response) => {
                    _this.index(1);
                    _this.showMassage(response.data);
                }).catch((error)=>{
                    _this.showMassage(error);
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

        created() {
            var _this = this;
            $('body').on('click', '#addBtn', function() {
                _this.add_form = true;
                _this.list = _this.edit_form = _this.view_form = false;
                $('#addBtn').hide();
                $('#listBtn').show();
            });
            $('body').on('click', '#listBtn', function() {
                _this.list = true;
                _this.add_form = _this.edit_form = _this.view_form = false;
                $('#addBtn').show();
                $('#listBtn').hide();
            });
            EventBus.$on('data-changed', () => {
                _this.add_form = _this.edit_form =  _this.view_form = false;
                _this.list = true;
                $('#addBtn').show();
                $('#listBtn').hide();
                _this.index(1);
            });
             _this.index(1);
        }

    }; 

</script>
