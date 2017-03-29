@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Administração de produtos</h3>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-12">
							<a href="{{ route('admin.products.create') }}" class="btn btn-default">
								<span class="glyphicon glyphicon-plus"></span>
							</a>
						</div>
					</div>
					<br/>
					<div class="row">
						<div class="col-md-12">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th style="width: 10px">#</th>
										<th>Nome</th>
										<th>Valor</th>
										<th>Ações</th>
									</tr>
								</thead>
								<tbody>
								@foreach($products as $product)
							        <tr>
							        	<td>{{ $product->id }}</td>
							        	<td>{{ $product->name }}</td>
							        	<td>R$ {{ number_format($product->value,2, ',', '.') }}</td>
							        	<td></td>
							        </tr>
                                @endforeach
								</tbody>
							</table>
							{{ $products->links() }}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection