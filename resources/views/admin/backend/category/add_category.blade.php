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
            <h5 class="mb-4">Add Category</h5>
            <form class="row g-3">
                <div class="col-md-6">
                    <label for="category_name" class="form-label">Category Name</label>
                    <input class="form-control" name="category_name" type="text" id="category_name">
                </div>
                <div class="col-md-6"></div>

                <div class="col-md-6">
                    <label for="" class="form-label">Category Image</label>
                    <input class="form-control" type="file" id="category_image" >
                </div>

                <div class="col-md-6">
                    <img src="{{ url('upload/no_image.png')}}" alt="category image" class="rounded-circle p-1 bg-primary" width="80" id="show_image">
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#category_image').change(function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#show_image').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0'])
        })
    })
</script>
@endsection
