@extends('web.layouts.app')

@section('contents')
    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-0"><strong
                        class="text-black">Welcome to your dashboard <span class="text-primary">{{Auth::user()->full_name}}</span></strong>
                </div>
            </div>
        </div>
    </div>
    <div class="site-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-4">
                    <div class="border p-4 rounded" role="alert">
                        Cart Lists
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="border p-4 rounded" role="alert">
                       Your Orders
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="border p-4 rounded" role="alert">
                        Cart Lists
                    </div>
                </div>
                
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div  class="border p-4 rounded" role="alert">
                        <h4>Transaction Details</h4>
                        <div  style="overflow: auto; width:100%">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Item</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Item 1</td>
                                        <td>$10</td>
                                        <td>Pending</td>
                                        <td>06-07-2023</td>
                                        
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>Item 1</td>
                                        <td>$10</td>
                                        <td>Pending</td>
                                        <td>06-07-2023</td>
                                        
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>Item 1</td>
                                        <td>$10</td>
                                        <td>Pending</td>
                                        <td>06-07-2023</td>
                                        
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>Item 1</td>
                                        <td>$10</td>
                                        <td>Pending</td>
                                        <td>06-07-2023</td>
                                        
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>Item 1</td>
                                        <td>$10</td>
                                        <td>Pending</td>
                                        <td>06-07-2023</td>
                                        
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
