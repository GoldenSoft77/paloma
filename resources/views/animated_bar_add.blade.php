
@include('layouts.header')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid p-5">
        
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Add New Sentence</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="{{ url('admin/animated_bar/store') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="card-body">
              <div class="form-group">
                <label>The Sentence (English) *</label>
                <input type="text" class="form-control @error('sentence') is-invalid @enderror" name="sentence_en" required>
                @if ($errors->has('sentence'))
                    <span class="text-danger">{{ $errors->first('sentence') }}</span>
                @endif
              </div>
              <div class="form-group">
                <label>The Sentence (Arabic) *</label>
                <input type="text" class="form-control @error('sentence') is-invalid @enderror" name="sentence_ar" required>
                @if ($errors->has('sentence'))
                    <span class="text-danger">{{ $errors->first('sentence') }}</span>
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