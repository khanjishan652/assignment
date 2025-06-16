@extends('layout.admin')
@section('title','Invite New Client')
@section('content')
<div class="pcoded-content">

    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                <!-- Page-body start -->
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- Default select start -->
                            <div class="card">
                                <div class="card-header">
                                    <h5>Invite New Client</h5>
                                </div>
                                <div class="card-block">
                                    <div class="row">
                                        <form class="row g-3 needs-validation ajaxForm" novalidate action="{{route('super-admin.client.store')}}" method="post">
                                           <div class="col-md-6">
                                                <label for="name" class="form-label">Client Name</label>
                                                <input type="text" class="form-control" name="name" required placeholder="Client Name">
                                                <div class="nameErr err"></div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="email" class="form-label">Client Email-Id</label>
                                                <input type="email" class="form-control" name="email" required placeholder="Client Email-Id">
                                                <div class="emailErr err"></div>
                                            </div>
                                           
                                            <div class="col-12">
                                                <button class="btn btn-primary" type="submit">Send Invitation</button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                            <!-- Default select end -->

                        </div>
                    </div>
                    <!-- Page-body end -->
                </div>
            </div>
        </div>
    </div>
@endsection