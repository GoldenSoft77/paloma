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
                    <h5> Balance Packages:
                        <a href="{{ url('admin/balancepackages/add') }}" class="custom-link text-right">
                            <i class="fas fa-plus"></i> Add New Balance Package:
                        </a>
                    </h5>
                
                <!-- ./Add New Slide Btn -->

                @if (count($balancepackages) > 0)
                <table class="MakeDataTable display">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Units</th>
                            <th>Company</th>
                            <th>Cost</th>
                            <th>Action</th>


                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($balancepackages as $balancepackage)
                        <tr>
                            <td>{{ $balancepackage->id }}</td>
                            <td>{{ $balancepackage->units }}</td>
                            <td>{{ $balancepackage->company }}</td>
                            <td>{{ $balancepackage->cost }}</td>

                            <td>
                                <a href="{{ url('admin/balancepackages/edit/'.$balancepackage->id) }}">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>

                                <button data-toggle="modal" data-target="{{'#exampleModal'.$balancepackage->id }}">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>

                        @else
                        <div class="col-12">
                            <div class="alert alert-primary" role="alert">
                                There is no Balance Packages right now!
                            </div>
                        </div>
                        @endif
                        </div>
            </div>
        </div>
        <!--/. container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@foreach ($balancepackages as $balancepackage)
<!-- Delete Modal -->
<div class="modal fade" id="{{'exampleModal'.$balancepackage->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Balance Package </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{url('admin/balancepackages/delete/'.$balancepackage->id)}}">
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