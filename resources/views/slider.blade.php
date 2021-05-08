
@include('layouts.header')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid p-5">
        <div class="row">


          <!-- Message -->
          @if(session()->has('message'))
          <p class="message-box done">
            {{ session()->get('message') }}
          </p>
          @endif
          <!-- ./Message -->

          <!-- Add New Slide Btn -->
          <div class="col-12 mb-3">
            <h5> Slider images:          
              <a href="{{ url('admin/slider/create') }}" class="custom-link text-right">
                <i class="fas fa-plus"></i> Add New Slide
              </a>
            </h5>
          </div>
          <!-- ./Add New Slide Btn -->

          @if (count($slides) > 0)

          @foreach ($slides as $slide)
          <div class="col-md-4 col-sm-6 col-12 mb-3">
            <div class="single-box">
              <img src="{{ asset($slide->img) }}" class="img-fluid">
              <ul>
                <li>
                  <button data-toggle="modal" data-target="{{'#exampleModal'.$slide->id }}">
                    <i class="fas fa-trash-alt"></i>
                  </button>
                </li>
              </ul>
            </div>
          </div>
          @endforeach

          @else
          <div class="col-12">
            <div class="alert alert-primary" role="alert">
              There is no slides right now!
            </div>
          </div>  
          @endif

        </div>
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  @foreach ($slides as $slide)
	<!-- Delete Modal -->
	<div class="modal fade" id="{{'exampleModal'.$slide->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Delete Slider </h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form method="POST" action="{{url('/slider/delete/'.$slide->id)}}">
						@csrf
						@method('DELETE')
						<p>Are you sure you want to delete?</p>
						<button type="submit">Yes</button>
						<button type="button" data-dismiss="modal" aria-label="Close">
							No
						</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- ./Delete Modal -->
	@endforeach

@include('layouts.footer')