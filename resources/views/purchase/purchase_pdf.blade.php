<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Export PDF</title>
	<link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
</head>
<body>

  <style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
  </style>
  
  <table class='table table-bordered'>
		<thead>
			<tr>
				<th>No</th>
				<th>Date</th>
				<th>Supplier</th>
				<th>Total</th>
			</tr>
		</thead>
		<tbody>
			@php $i = 1 @endphp
			@foreach($purchases as $purchase)
			<tr>
				<td>{{ $i++ }}</td>
        <td>{{ $purchase->created_at }}</td>
        <td>{{ $purchase->supplier->name }}</td>
        <td>{{ $purchase->total }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
  
</body>
</html>