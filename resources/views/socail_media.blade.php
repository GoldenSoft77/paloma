
@include('layouts.header')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid p-5">
        
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Socail Media Links</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="{{ url('admin/socail_media/update') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="card-body">
              <div class="form-group">
                <label>Facebook Link</label>
                <input type="text" class="form-control" value="{{ $socailmedia->facebook }}" name="facebook">
              </div>
              <div class="form-group">
                <label>Twitter Link</label>
                <input type="text" class="form-control" value="{{ $socailmedia->twitter }}" name="twitter">
              </div>
              <div class="form-group">
                <label>Youtube Link</label>
                <input type="text" class="form-control" value="{{ $socailmedia->youtube }}" name="youtube">
              </div>
              <div class="form-group">
                <label>Telegram Channel</label>
                <input type="text" class="form-control" value="{{ $socailmedia->telegram }}" name="telegram" required>
              </div>
              <div class="form-group">
                <label>Instagram Channel</label>
                <input type="text" class="form-control" value="{{ $socailmedia->instagram }}" name="instagram" required>
              </div>
              <div class="form-group">
                <label>Whatsapp Phone</label>
                <input type="tel" class="form-control" value="{{ $socailmedia->whatsapp }}" name="whatsapp" required>
                <small>Write without (+ or 00) <u>Like</u> <i>963967148288</i></small>
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