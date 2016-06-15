@extends('admin.templates.admin')
@section('head')
<link rel="stylesheet" type="text/css" href="{{ url('/css/datatables.min.css') }}" />
@stop
@section('content-header')
    <h1>Sign Ups</h1>
@stop
@section('body')
    <div class="row">
        <div class="col-lg-10">
            <div class="box">
                <div class="box-header">
                    <h2 class="box-title">Equipment Totals for {{date('Y')}}</h2>
                </div>
                <div class="box-body">
                    @if(count($categories) > 0)
                    @foreach($categories as $category)
                        <h3>{{$category->name}}</h3>
                        @if($category->category_count > 0)
                        <div class="table-responsive">
                            <table class="table table-striped orders">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($category->items as $item)
                                        @if($item->is_one_size)
                                        <tr class="{{($item->count == 0)?'hidden':''}}">
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->count}}</td>
                                        </tr>
                                        @else
                                            @foreach($item->children as $child)
                                            <tr class="{{($child->count == 0)?'hidden':''}}">
                                                <td>{{$child->name}}</td>
                                                <td>{{$child->count}}</td>
                                            </tr>
                                            @endforeach
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <p>No {{$category->name}} has been ordered.</p>
                        @endif
                    @endforeach
                    @else
                    <p>There is no equipment added yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop
@section('scripts')
<script type="text/javascript" src="{{url('/')}}/js/datatables.min.js"></script>
<script type="text/javascript" src="{{url('/')}}/js/jQuery.print.js"></script>
<script>
    $(document).ready(function()
    {
        $('.orders').DataTable({
            paging: false,
            info: false,
            /* Disable initial sort */
            "aaSorting": []
        });
    });
</script>
@stop