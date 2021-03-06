
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
            <h5> Welcome page slides:          
              <a href="{{ url('admin/welcome_page/create') }}" class="custom-link text-right">
                <i class="fas fa-plus"></i> Add New Slide
              </a>
            </h5>
          </div>
          <!-- ./Add New Slide Btn -->

          @if (count($welcome) > 0)

          @foreach ($welcome as $wel)
          <div class="col-md-4 col-sm-6 col-12 mb-3">
            <div class="single-box">
              <img src="{{ asset($wel->img) }}" class="img-fluid">
              @php
              $en_title = $wel->translate('en')->title;
              $ar_title = $wel->translate('ar')->title;

              $en_para=$wel->translate('en')->paragraph;
              $ar_para=$wel->translate('ar')->paragraph;

              @endphp
              <h2>{{substr($en_title,0,50)}} </h2>
              <h2>{{substr($ar_title,0,50)}} </h2>
              
              <p>{{ substr($en_para, 0, 100) }}</p>
              <p>{{ substr($ar_para, 0, 100) }}</p>
              <ul>
                <li>
                  <a href="{{ url('admin/welcome_page/edit/'.$wel->id) }}">
                    <i class="fas fa-pencil-alt"></i>
                  </a>
                </li>
                <li>
                  <button data-toggle="modal" data-target="{{'#exampleModal'.$wel->id }}">
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
              There is no sliders right now!
            </div>
          </div>  
          @endif

        </div>
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  @foreach ($welcome as $wel)
	<!-- Delete Modal -->
	<div class="modal fade" id="{{'exampleModal'.$wel->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Delete Slide </h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form method="POST" action="{{url('admin/welcome_page/delete/'.$wel->id)}}">
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