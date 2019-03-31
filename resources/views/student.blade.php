<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Student</title>
<meta name="csrf-token" content="{{ csrf_token() }}"> 
<meta name="author" content="">
<script> var base_url = "{{ url('/').'/' }}"; </script>
<script src="https://unpkg.com/vue/dist/vue.js"></script>
<script src="https://unpkg.com/vue-toastr-2/dist/vue-toastr-2.js"></script>
<link rel="stylesheet" href="https://unpkg.com/vue-toastr-2/dist/vue-toastr-2.min.css">
{{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!-- Nav -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body>
<div id="student">
  <navbar></navbar>
    <div class='container'>
            <section class="student-section">
                    <div class="row" style="margin-top: 20px;">
                        <div class="pull-right col-md-4 col-12">
                            <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
                                    <a href="javascript:void(0)" class="btn btn-social width-150 mb-1 mr-1 btn-primary" id="addBtn">
                                        <span class="ft-plus-circle font-medium-5"></span><b> Add New </b></a>
                            </div>
                
                            <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown" style="display: none" id="listBtn">
                                <a href="javascript:void(0)" class="btn btn-social width-150 mb-1 mr-1 btn-primary">
                                    <span class="ft-list font-medium-5"></span><b>View List</b></a>
                            </div>
                        </div>
                    </div>
                </section>
        <student-list></student-list>
    </div>
</div>
</body>
<script src="{{ asset('js/student.js') }}"></script>
</html>                            