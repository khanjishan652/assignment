@extends('layout.admin')
@section('title','Invite New Member')
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
                                    <h5>Generate Short URL</h5>
                                </div>
                                <div class="card-block">
                                    <div class="row">
                                        <form class="row g-3 needs-validation ajaxForm" novalidate action="{{route(auth()->user()?->role.'.short-url.store')}}" method="post">
                                           <div class="col-md-12">
                                                <label for="long_url" class="form-label">Long URL</label>
                                                <input type="text" class="form-control" name="long_url" required placeholder="http://www.google.com/">
                                                <div class="long_urlErr err"></div>
                                            </div>
                                            <div class="col-12">
                                                <button class="btn btn-primary" type="submit">Generate</button>
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