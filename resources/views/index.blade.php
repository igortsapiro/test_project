<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', '') }}</title>

        <!-- Bootstrap core CSS -->
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    </head>

    <body id="page-top">

        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark " id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="">Some Header</a>
            </div>
        </nav>


        <!-- Filter form -->
        <div class="container mt-5 mb-5">

            <form action="/" method="get" id="filter">
                <table class="table table-condensed table-bordered table-hover table-sm">
                    <tr>
                        <th>Name</th>
                        <th>Value</th>
                        <th>Name</th>
                        <th>Value</th>
                    </tr>

                    <tr>
                        <td>Id</td>
                        <td>
                            <input type="text" class="form-control" name="id" value="{{$inputs['id'] ?? ''}}">
                        </td>
                        <td>String Field</td>
                        <td>
                            <input type="text" class="form-control" name="string_field" value="{{$inputs['string_field'] ?? ''}}">
                        </td>
                    </tr>

                    <tr>
                        <td>Boolean Field</td>
                        <td>
                            <select name="boolean_field" id="boolean_field" class="form-control">
                                <option value="">Select type</option>
                                <option @if(!empty($inputs['string_field']) && $inputs['boolean_field'] == 1) selected @endif value="1">True</option>
                                <option @if(!empty($inputs['string_field']) && $inputs['boolean_field'] == 2) selected @endif value="2">False</option>
                            </select>
                        </td>
                        <td>Decimal Field</td>
                        <td>
                            <input type="text" class="form-control" name="decimal_field" value="{{$inputs['string_field'] ?? ''}}">
                        </td>
                    </tr>

                    <tr>
                        <td>Timestamp Field From</td>
                        <td>
                            <input type="datetime-local" class="form-control" name="timestamp_field_from" value="{{$inputs['timestamp_field_from'] ?? ''}}">
                        </td>
                        <td>Timestamp Field To</td>
                        <td>
                            <input type="datetime-local" class="form-control" name="timestamp_field_to" value="{{$inputs['timestamp_field_to'] ?? ''}}">
                        </td>
                    </tr>

                    <tr>
                        <td>Sort By</td>
                        <td>
                            <select name="order_by" id="order_by" class="form-control">
                                <option selected value="id">Id</option>
                                <option @if(!empty($inputs['order_by']) && $inputs['order_by'] == 'string_field') selected @endif value="string_field">String Field</option>
                                <option @if(!empty($inputs['order_by']) && $inputs['order_by'] == 'boolean_field') selected @endif value="boolean_field">Boolean Field</option>
                                <option @if(!empty($inputs['order_by']) && $inputs['order_by'] == 'decimal_field') selected @endif value="decimal_field">Decimal Field</option>
                                <option @if(!empty($inputs['order_by']) && $inputs['order_by'] == 'timestamp_field') selected @endif value="timestamp_field">Timestamp Field</option>
                            </select>
                        </td>
                        <td>Sort Order</td>
                        <td>
                            <select name="sort_order" id="sort_order" class="form-control">
                                <option @if(!empty($inputs['sort_order']) && $inputs['sort_order'] == 'desc') selected @endif value="desc">Descending</option>
                                <option @if(!empty($inputs['sort_order']) && $inputs['sort_order'] == 'asc') selected @endif value="asc">Ascending</option>
                            </select>
                        </td>
                    </tr>


                </table>
                <input type="submit" class="btn btn-success" name="filter" value="Filter">
            </form>
        </div>


        <!-- Block where loads data from ajax response -->
        <div class="container fields-container">
            <div class="for-ajax">
                @include('fields')
            </div>

        <!-- Pagination -->
            <ul class="pagination" role="navigation">
                <li class="page-item">
                    <a class="page-link first-link" id="pag-link" @if($currentPage == 1) style="pointer-events: none" @endif data-field="{{1}}" aria-label="« Назад">‹‹</a>
                </li>
                <li class="page-item">
                    <a class="page-link prev-link" id="pag-link" @if($currentPage == 1) style="pointer-events: none" @endif data-field="{{$currentPage - 1}}" aria-label="« Назад">‹</a>
                </li>
                <li class="page-item active" aria-current="page"><span class="page-link current-link" style="pointer-events: none">{{$currentPage}}</span></li>

                <li class="page-item next-link">
                    <a class="page-link next-link" id="pag-link" @if($currentPage >= $allPages) style="pointer-events: none" @endif data-field="{{$currentPage + 1}}" aria-label="Вперёд »">›</a>
                </li>
                <li class="page-item next-link">
                    <a class="page-link last-link" id="pag-link" @if($currentPage >= $allPages) style="pointer-events: none" @endif data-field="{{$allPages}}" aria-label="Вперёд »">››</a>
                </li>
            </ul>
        </div>


        <!-- Footer -->
        <footer class="footer py-5 bg-dark">
            <div class="container">
                <p class="m-0 text-center text-white">Some Footer</p>
            </div>

        </footer>

        <!-- Bootstrap core JavaScript -->
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

        <!-- Custom JavaScript for this theme -->
        <script src="{{ asset('js/app.js') }}"></script>

    </body>

</html>