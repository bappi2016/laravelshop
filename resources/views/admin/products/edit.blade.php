@extends('admin.layouts.master')

@section('pagename')
    Edit Product
@endsection

@section('content')

<div class="row">
    <div class="col-lg-10 col-md-10">
        @include('admin.layouts.messages')
        <div class="card">
            <div class="header">
                <h4 class="title">Edit Product</h4>
            </div>    
            <div class="content">
                {{-- Laravel collective form component --}}
                 {!! Form::open(['url' => ['admin/products',$product->id], 'files'=>'true','method'=>'put']) !!} 
                  {{-- files=> true makes the enctype = multipart/form data --}}
                    <div class="row">
                        <div class="col-md-12">
                            @include('admin.products._fields')

                        </div>

                    </div>
                    <div class="form-group">
                        {!! Form::submit('Update Product', ['class'=>'btn btn-info btn-fill btn-wd']) !!}
                    </div>
                    <div class="clearfix"></div>
                    {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
    
@endsection