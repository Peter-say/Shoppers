@extends('dashboard.admin.layouts.app')

@section('contents')
    <!-- MAIN CONTENT-->

 

    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="d-flex justify-content-between">
                            <h2 class="title-1 m-b-25">Brand Lists</h2>
                            <span><a href="" class="btn btn-primary">Add
                                    New</a></span>
                        </div>

                        <div class="table-responsive table--no-card m-b-40">
                            <table class="table table-borderless table-striped table-earning">
                                <thead>
                                    <tr>
                                        <th>Date Created</th>
                                        <th>Name</th>
                                        <th>Logo</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   

                                </tbody>
                            </table>

                        </div>
                    </div>

                </div>
            </div>
          
        </div>
        @if (session()->has('success_message'))
            <div class="popup-message success" id="popup-message">
                <p class="text-white">{{ session('success_message') }}</p>
            </div>
        @endif

    </div>
    <!-- END MAIN CONTENT-->
@endsection
