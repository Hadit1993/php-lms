@extends('admin.admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="page-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Manage Categories</li>
                    <li class="breadcrumb-item active" aria-current="page">Add Category</li>
                </ol>
            </nav>
        </div>

    </div>

    <div class="card">
        <div class="card-body p-4">
            <h5 class="mb-4">Edit Category</h5>
            <form class="row g-3" method="POST" action="{{route('update.category', $category->id)}}" id="myForm" enctype="multipart/form-data">
                @csrf
               
                <div class="col-md-6 form-group">
                    <label for="category_name" class="form-label">Category Name</label>
                    <input class="form-control" name="category_name" type="text" id="category_name" value="{{$category->category_name}}">
                </div>
                <div class="col-md-6"></div>

                <div class="col-md-6 form-group">
                    <label for="image" class="form-label">Category Image</label>
                    <input class="form-control" type="file" id="image" name="image" >
                </div>

                <div class="col-md-6">
                    <img src="{{(!empty($category->image)) ? url($category->image) : url('upload/no_image.png')}}" alt="category image" class="rounded-circle p-1 bg-primary" width="80" id="show_image">
                </div>

                <div class="col-md-12">
                    <div class="d-md-flex d-grid align-items-center gap-3">
                        <button type="submit" class="btn btn-primary px-4">Save Changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                category_name: {
                    required : true,
                }, 

                // image: {
                //     required: true
                // }
                
            },
            messages :{
                category_name: {
                    required : 'Please Enter Category Name',
                }, 
                image: {
                    required: 'Please Select Category Image'
                }
                 

            },
            errorElement : 'span', 
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    });
    
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#image').change(function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#show_image').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0'])
        })
    })
</script>
@endsection
