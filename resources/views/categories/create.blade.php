@extends('layouts.app')

@section('content')
    <div class="card-header">
       	<div class="row">
           	<div class="col-md-9">
       			<h3>Category Details</h3>
          	</div>
            <div class="col-md-3 align_right">
              	<a href="/admin/categories" class="btn btn-primary" data-placement="top" data-original-title="Manage Categories">Manage Categories</a>
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
               	<form name="addCategoryForm" id="addCategoryForm" action="{{ route('categories.store') }}" method="post">
                   {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-3">
                          	<label class="pull-right">Title <span class="required">*</span></label>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" placeholder="Title" name="title" id="title" class="form-control" value="{{ old('title') }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                          	<label class="pull-right">Description <span class="required">*</span></label>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <textarea placeholder="Description" name="description" id="description" class="form-control tinymceEditor">{{ old('description') }}</textarea>
                            </div>
                        </div>
                    </div>
                    <!--<div class="row">
                        <div class="col-md-3">
                          	<label class="pull-right">IsActive </label>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="radio-inline">
				    				<input type="radio" value="1" name="isActive" id="isActive_yes" <?php //echo ($isActive == '1') ? 'checked="checked"' : ''; ?>> Yes
								</label>
								<label class="radio-inline">
									<input type="radio" value="0" name="isActive"  id="isActive_no" <?php //echo ($isActive == '0') ? 'checked="checked"' : ''; ?>> No
								</label>
                            </div>
                        </div>
                    </div>-->
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <input type="submit" name="submit" value="Add Category" class="btn btn-primary btn-block" >
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
                    <div class="panel-heading">Add New Category</div>

                    <div class="panel-body">
                        @if ($errors->count() > 0)
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <form action="{{ route('categories.store') }}" method="post">
                            {{ csrf_field() }}
                            Title:
                            <br />
                            <input type="text" name="title" value="{{ old('title') }}" />
                            <br /><br />
                            Description:
                            <br />
                            <textarea name="description">{{ old('description') }}</textarea>
                            <br /><br />
                            <input type="submit" value="Submit" class="btn btn-default" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>-->
@endsection