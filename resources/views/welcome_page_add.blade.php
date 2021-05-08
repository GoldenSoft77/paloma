
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
          <form action="{{ url('admin/welcome_page/store') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="card-body">
              <div class="form-group">
                <label>Title (English)*</label>
                <input type="text" class="form-control @error('slide_title') is-invalid @enderror" name="slide_title_en" required>
                @if ($errors->has('slide_title'))
                    <span class="text-danger">{{ $errors->first('slide_title') }}</span>
                @endif
              </div>
              <div class="form-group">
                <label>Title (Arabic)*</label>
                <input type="text" class="form-control @error('slide_title') is-invalid @enderror" name="slide_title_ar" required>
                @if ($errors->has('slide_title'))
                    <span class="text-danger">{{ $errors->first('slide_title') }}</span>
                @endif
              </div>
              <div class="form-group">
                <label>Paragraph (English) *</label>
                <input type="text" class="form-control @error('slide_para') is-invalid @enderror" name="slide_paragraph_en" required>
                @if ($errors->has('slide_para'))
                    <span class="text-danger">{{ $errors->first('slide_para') }}</span>
                @endif
              </div>
              <div class="form-group">
                <label>Paragraph (Arabic) *</label>
                <input type="text" class="form-control @error('slide_para') is-invalid @enderror" name="slide_paragraph_ar" required>
                @if ($errors->has('slide_para'))
                    <span class="text-danger">{{ $errors->first('slide_para') }}</span>
                @endif
              </div>
              <div class="form-group">
                <label for="exampleInputFile">Slide Image *</label>
                <div class="input-group">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" name="slide_img" accept="image/*" required>
                    <label class="custom-file-label">Choose img</label>
                  </div>
                  <div class="input-group-append">
                    <span class="input-group-text">Upload Image</span>
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

      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@include('layouts.footer')