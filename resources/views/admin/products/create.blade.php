@extends('admin.layouts.master')

@section('pagename')
    Add Product
@endsection

@section('content')

<div class="row">
    <div class="col-lg-10 col-md-10">
        @include('admin.layouts.messages')
        <div class="card">
            <div class="header">
                <h4 class="title">Add Product</h4>
            </div>  
            <div class="content">
                {{-- Laravel collective form component --}}
                 {!! Form::open(['url' => 'admin/products', 'files'=>'true']) !!} 
                  {{-- files=> true makes the enctype = multipart/form data --}}
                    <div class="row">
                        <div class="col-md-12">
                            @include('admin.products._fields')

                        </div>

                    </div>
                    <div class="form-group">
                        {!! Form::submit('Add Product', ['class'=>'btn btn-info btn-fill btn-wd']) !!}
                    </div>
                    <div class="clearfix"></div>
                    {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
    
@endsection