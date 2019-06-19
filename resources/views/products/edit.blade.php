@extends('layouts.app')

@section('content')
    <div class="card-header">
       	<div class="row">
           	<div class="col-md-9">
       			<h3>Product Details</h3>
          	</div>
            <div class="col-md-3 align_right">
              	<a href="/admin/products" class="btn btn-primary" data-placement="top" data-original-title="Manage Products">Manage Products</a>
            </div>
        </div>
        @if ($errors->count() > 0)
            <ul class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
    </div>
    <div class="card-body page-error">
        <div class="row">
           	<div class="col-md-12">
               	<form name="editProductForm" id="editProductForm" action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data">
                   <input type="hidden" name="_method" value="PUT">
                   {{ csrf_field() }}
                   <div class="row">
                        <div class="col-md-3">
                        	<label class="pull-right">Category <span class="required">*</span></label>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <select class="form-control" name="categoryId" id="categoryId">
                                    <option value="">-- Select Category --</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}" @if($category->id == $product->categoryId) selected @endif>{{ $category->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                        	<a href="{{ route('categories.create') }}" class="add_new_btn"><input type="button" name="add_new_category" id="add_new_category" value="Add New Category" class="btn btn-warning nomargin" /></a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                          	<label class="pull-right">Title <span class="required">*</span></label>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" placeholder="Title" name="title" id="title" class="form-control" value="{{ $product->title }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                          	<label class="pull-right">Description <span class="required">*</span></label>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <textarea placeholder="Description" name="description" id="description" class="form-control tinymceEditor">{{ $product->description }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                        	<label class="pull-right">Image <span class="required">*</span></label>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                               	<input type="file" name="image" id="image" accept="image/jpeg, image/png">
                                @if ($product->image)
                                  	<img class="imageThumb image_thumb" src="{{ URL::to('/') }}/product_images/{{ $product->image }}" title="{{ $product->image }}" alt="" />
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <input type="submit" name="submit" value="Edit Product" class="btn btn-primary btn-block" >
                            </div>
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--<div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit Product</div>

                    <div class="panel-body">
                        @if ($errors->count() > 0)
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <form action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="_method" value="PUT">
                            {{ csrf_field() }}
                            Category:
                            <br/>
                            <select name="categoryId">
                                <option value="">--Select Category--</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}" @if($category->id == $product->categoryId) selected @endif>{{ $category->title }}</option>
                                @endforeach
                            </select>
                            <br /><br />
                            Title:
                            <br />
                            <input type="text" name="title" value="{{ $product->title }}" />
                            <br /><br />
                            Description:
                            <br />
                            <textarea name="description">{{ $product->description }}</textarea>
                            <br /><br />
                            Image:
                            <br />
                            <input type="file" name="image">
                            <br /><br />
                            <input type="submit" value="Submit" class="btn btn-default" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>-->
@endsection