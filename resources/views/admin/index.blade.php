@extends('layouts.admin')

@section('title')
    Admin Page
@endsection

@section('content')
                                <div class="panel">
                                    <div class="panel-heading ">
                                        <span class="panel-title ptn">Price</span>
                                    </div>
                                    <div class="panel-body pn mt15">
                                        <div class="table-responsive">
                                            <table class="table allcp-form theme-warning tc-checkbox-1 table-style-2 btn-gradient-grey fs13">
                                                <thead>
                                                <tr class="">
                                                    <th class="">Image</th>
                                                    <th class="">Product Title</th>
                                                    <th class="">SKU</th>
                                                    <th class="">Price</th>
                                                    <th class="">Stock</th>
                                                    <th class="">Status</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach ($orders as $order)
                                                <input type="hidden" value="{{$product = keranjang($order->prod_id)}}">
                                                <tr>
                                                    <td class="">
                                                        <img class="img-responsive mw40 ib" alt="" title="user" src="{{productImages($product->images)}}">
                                                    </td>
                                                    <td class="">
                                                        <span>{{$product->nama_product}}</span>
                                                    </td>
                                                    <td class=""><span>#123</span></td>
                                                    <td class="">
                                                        <div class="btn-group text-right">
                                                            <button type="button"
                                                                    class="btn btn-info br2 btn-xs fs10 fw700 dropdown-toggle"
                                                                    data-toggle="dropdown" aria-expanded="false"> Active
                                                                <span class="caret"></span>
                                                            </button>
                                                            <ul class="dropdown-menu" role="menu">
                                                                <li>
                                                                    <a href="#">Edit</a>
                                                                </li>
                                                                <li>
                                                                    <a href="#">Delete</a>
                                                                </li>
                                                                <li>
                                                                    <a href="#">Archive</a>
                                                                </li>
                                                                <li class="divider"></li>
                                                                <li class="active">
                                                                    <a href="#">Active</a>
                                                                </li>
                                                                <li>
                                                                    <a href="#">Inactive</a>
                                                                </li>
                                                                <li>
                                                                    <a href="#">Low Stock</a>
                                                                </li>
                                                                <li>
                                                                    <a href="#">Out of Stock</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
@endsection