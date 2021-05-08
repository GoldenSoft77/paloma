@include('layouts.header')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid p-5">
        
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Edit Balance Package</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="{{ url('admin/balancepackages/update/'. $balance_package->id) }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="card-body">
              <div class="form-group">
                <label>Units *</label>
                <input type="text" class="form-control @error('slide_title') is-invalid @enderror" name="units" value="{{ $balance_package->units}}" required>
                @if ($errors->has('slide_title'))
                    <span class="text-danger">{{ $errors->first('slide_title') }}</span>
                @endif
              </div>
              <div class="form-group">
                <label>Cost *</label>
                <input type="text" class="form-control @error('slide_para') is-invalid @enderror" name="cost" value="{{ $balance_package->cost}}" required>
                @if ($errors->has('slide_para'))
                    <span class="text-danger">{{ $errors->first('slide_para') }}</span>
                @endif
              </div>
              <div class="form-group">
                <label>Company *</label>
				<select name="company" class="form-control">
					<option value="MTN">MTN</option>
					<option value="Syriatel">Syriatel</option>
					</select>
                @if ($errors->has('slide_para'))
                    <span class="text-danger">{{ $errors->first('slide_para') }}</span>
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