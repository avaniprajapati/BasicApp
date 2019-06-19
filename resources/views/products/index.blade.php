@extends('layouts.app')

@section('content')
    <div class="card-header">
        <h3>Products List</h3>
        @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
        @endif
    </div>

    <div class="card-body">
        <div class="table-responsive">
          	<table class="table" id="sample_1">
            	<thead class=" text-primary">
               		<th><input type="checkbox" class="checkbox_all"></th>
                    <th class="center">#</th>
                    <th>Category</th>
					<th>Title</th>
					<th>Description</th>
					<th>Created Date</th>
                    <!--<th>IsActive</th>-->
                    <th>Options</th>
                </thead>
                <tbody>
                    @php
                        $i = 1
                    @endphp
                    @forelse($products as $product)
						<tr>
							<td><input type="checkbox" class="checkbox_delete" name="entries_to_delete[]" value="{{ $product->id }}" /></td>
							<td class="center">{{ $i }}</td>
                            <td>{{ $product->category->title }}</td>
                            <td>{{ $product->title }}</td>
                            <td>{{ $product->description }}</td>
							<td>{{ date('d-m-Y H:i:s', strtotime($product->created_at)) }}</td>
                            <td class="center">
                             	<div>
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning tooltips" data-placement="top" data-original-title="Edit"><i class="now-ui-icons design-2_ruler-pencil"></i></a>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                        style="display: inline"
                                        onsubmit="return confirm('Delete this product?');">
                                        <input type="hidden" name="_method" value="DELETE">
                                        {{ csrf_field() }}
                                        <button class="btn btn-danger tooltips" data-placement="top" data-original-title="Delete"><i class="now-ui-icons ui-1_simple-remove"></i></button>
                                    </form>
                                </div>
                            </td>
						</tr>
                        @php
                            $i++;
                        @endphp
                    @empty
                        <tr>
							<td class="center" colspan="10">
                              	<div class="alert alert-info">
                           	        <strong>No Record Found!</strong>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                    
                    @if (!$products->isEmpty())
                    <tr>
						<td colspan="3">
                            <form action="{{ route('products.mass_destroy') }}" method="post"
                                onsubmit="return confirm('Delete selected products?');">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="ids" id="ids" value="" />
                                <input type="submit" value="Delete selected" class="btn btn-danger" />
                            </form>
                        </td>
                        <td colspan="4">
                            {{ $products->links() }}
                        </td>
                    </tr>
                    @endif
				</tbody>
			</table>
        </div>
    </div>

    <!--<div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Products</div>
                    <hr/>
                    @if (session('message'))
                        <div class="alert alert-info">{{ session('message') }}</div>
                    @endif 
                    <a href="{{ route('products.create') }}" class="btn btn-default">Add New Product</a>

                    <div class="panel-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" class="checkbox_all"></th>
                                    <th>Category</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($products as $product)
                                <tr>
                                    <td><input type="checkbox" class="checkbox_delete" name="entries_to_delete[]" value="{{ $product->id }}" /></td>
                                    <td>{{ $product->category->title }}</td>
                                    <td>{{ $product->title }}</td>
                                    <td>{{ $product->description }}</td>
                                    <td>
                                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-default">Edit</a>
                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                              style="display: inline"
                                              onsubmit="return confirm('Are you sure?');">
                                            <input type="hidden" name="_method" value="DELETE">
                                            {{ csrf_field() }}
                                            <button class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">No entries found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <form action="{{ route('products.mass_destroy') }}" method="post"
                            onsubmit="return confirm('Are you sure?');">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="ids" id="ids" value="" />
                            <input type="submit" value="Delete selected" class="btn btn-danger" />
                        </form>
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>-->
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            function getIDs() {
                var ids = [];
                $('.checkbox_delete').each(function () {
                    if($(this).is(":checked")) {
                        ids.push($(this).val());
                    }
                });
                $('#ids').val(ids.join());
            }

            $(".checkbox_all").click(function(){
                $('input.checkbox_delete').prop('checked', this.checked);
                getIDs();
            });

            $('.checkbox_delete').change(function() {
                getIDs();
            });
        });
    </script>
@endsection