
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
          <h5> Pending Vendors         
            
          </h5>
        </div>
        <!-- ./Add New Slide Btn -->

        @if (count($pending_vendors) > 0)

        @foreach ($pending_vendors as $vendor)
        <div class="col-12 mb-3">
          <div class="single-box">
            <p>Request from: {{ $vendor->email }}</p>
            <ul>
              <li>
                <a href="{{ url('/vendors/approve/'.$vendor->id) }}">
                  <i class="fas fa-check"></i>
                </a>
              </li>
          
            </ul>
          </div>
        </div>
        @endforeach

        @else
        <div class="col-12">
          <div class="alert alert-primary" role="alert">
            There is no vendors right now!
          </div>
        </div>  
        @endif

      </div>
    </div><!--/. container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@foreach ($pending_vendors as $vendor)
<!-- Delete Modal -->
<div class="modal fade" id="" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Delete Sentence </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="">
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