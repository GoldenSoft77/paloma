
@include('layouts.header')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid p-5">

        <!-- Message -->
        @if(session()->has('message'))
          <p class="message-box done">
            {{ session()->get('message') }}
          </p>
        @endif
        <!-- ./Message -->
        
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Edit Slide Information</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="{{ url('/welcome_page/update/'.$welcome->id) }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="card-body">
              <div class="form-group">
                <label>Title *</label>
                <input type="text" class="form-control @error('slide_title') is-invalid @enderror" name="slide_title" value="{{ $welcome->title }}" required>
                @if ($errors->has('slide_title'))
                    <span class="text-danger">{{ $errors->first('slide_title') }}</span>
                @endif
              </div>
              <div class="form-group">
                <label>Paragraph *</label>
                <input type="text" class="form-control @error('slide_para') is-invalid @enderror" name="slide_para" value="{{ $welcome->paragraph }}" required>
                @if ($errors->has('slide_para'))
                    <span class="text-danger">{{ $errors->first('slide_para') }}</span>
                @endif
              </div>
              <div class="form-group">
                <label for="exampleInputFile">Slide Image</label>
                <div class="input-group">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" name="slide_img" accept="image/*">
                    <label class="custom-file-label">Upload image if you want to change it</label>
                  </div>
                  <div class="input-group-append">
                    <span class="input-group-text">Upload Image</span>
                  </div>
                </div>
                <div>
                  <img src="{{ asset($welcome->img) }}" class="img-fluid small-img">
                </div>
                  @if ($errors->has('slide_img'))
                    <span class="text-danger">{{ $errors->first('slide_img') }}</span>
                  @endif
              </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Save</button>
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