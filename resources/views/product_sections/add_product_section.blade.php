@include('layouts.header')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid p-5">
        
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Add New Product Section</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="{{ url('admin/productsections/store') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="card-body">
              <div class="form-group">
                <label>Name *</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" required>
                @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
              </div>
            
              <div class="form-group">
              <label for="exampleInputFile">Icon *</label>
              <div class="input-group">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" name="icon" accept="image/*" required>
                  <label class="custom-file-label">Choose img</label>
                </div>
                <div class="input-group-append">
                  <span class="input-group-text">Upload Image</span>
                </div>
              </div>
              @if ($errors->has('icon'))
                <span class="text-danger">{{ $errors->first('icon') }}</span>
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

      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@include('layouts.footer')