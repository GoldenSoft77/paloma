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
                    <h5> Water Pending Orders:
                    </h5>

                    <!-- ./Add New Slide Btn -->

                    @if (count($billorders) > 0)
                    <table class="MakeDataTable display">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>City</th>
                                <th>Counter Number</th>
                                <th>User</th>
                                <th>Date</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($billorders as $billorder)
                            <tr>
                                <td>{{ $billorder->id }}</td>
                                <td>{{ $billorder->name }}</td>
                                <td>{{ $billorder->city }}</td>
                                <td>{{ $billorder->counter_number }}</td>
                                @php
                                $first_name = $billorder->user->first_name;
                                $last_name = $billorder->user->last_name;
                                $full_name = $first_name." ".$last_name;
                                @endphp
                                <td>
                                    {{  $full_name }}
                                </td>
                                <td>{{ $billorder->created_at->format('Y-m-d') }}</td>
                                <td>

                                    <a href="{{ url('admin/billorders/approve/'.$billorder->id) }}">
                                        <i class="fas fa-check"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>


                    @else
                    <div class="col-12">
                        <div class="alert alert-primary" role="alert">
                            There is no Pending Water Orders right now!
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



@include('layouts.footer')