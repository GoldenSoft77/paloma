@include('layouts.header')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid p-5">

            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Add New Slide</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="POST" enctype="multipart/form-data" action="{{ route('admin.image.store')}}">
                    {{ csrf_field() }}
                    <div class="card-body">
                        <div class="form-group">
                            <label>URL</label>
                            <input type="text" class="form-control @error('sentence') is-invalid @enderror" name="url">
                            @if ($errors->has('sentence'))
                            <span class="text-danger">{{ $errors->first('sentence') }}</span>
                            @endif
                        </div>
                        <div class="form-group">

                            <label for="exampleInputFile">Slide Image *</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="slide_img" accept="image/*"
                                        id="image" required>
                                    <label class="custom-file-label">Choose img</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">Upload Image</span>
                                </div>
                            </div>
                            <div class="col-md-12 mb-2">
                                <div>
                                    <label for="exampleInputFile">Image Preview</label>
                                    <div class="input-group">
                                        <img src="{{ asset('/images/image-preview.jpg') }}" class="img-fluid small-img"
                                            id="image_preview_container">
                                    </div>
                                </div>
                            </div>
                            @if ($errors->has('slide_img'))
                            <span class="text-danger">{{ $errors->first('slide_img') }}</span>
                            @endif
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
            <!-- /.card -->

        </div>
        <!--/. container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@include('layouts.footer')