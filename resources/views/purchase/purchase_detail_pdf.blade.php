<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Detailed Purchase Report</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>

  <style type="text/css">
    .my-table {
      padding-left: 4px;
      padding-right: 4px;
    }
  </style>

	<div class="h4">Detailed Purchase Report</div>

  <table class="mt-4">
		<tbody>
			<tr>
				<td class="my-table">User</td>
				<td class="my-table">: {{ Auth::user()->name }}</td>
			</tr>
			<tr>
				<td class="my-table">User Email</td>
				<td class="my-table">: {{ Auth::user()->email }}</td>
			</tr>
			<tr>
				<td class="my-table">Date Created</td>
				<td class="my-table">: {{ date('d-m-Y') }}</td>
			</tr>
		</tbody>
	</table>
  
  <table class="table table-borderless mt-5">
    <tbody>
      <tr>
        <td>Date</td>
        <td>: {{ date('d-m-Y', strtotime($purchase->created_at)) }}</td>
      </tr>
      <tr>
        <td>Supplier</td>
        <td>: {{ $purchase->supplier->name }}</td>
      </tr>
      <tr>
        <td>Total</td>
        <td>: Rp {{ number_format($purchase->total) }}</td>
      </tr>
    </tbody>
  </table>
  
  <table class="table table-bordered mt-5">
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
			@foreach($purchase->detail as $detail)
      <tr>
        <td>{{ $detail->product->name }}</td>
        <td>Rp {{ number_format($detail->price) }}</td>
        <td>{{ $detail->qty }}</td>
        <td>Rp {{ number_format($detail->subtotal) }}</td>
      </tr>
			@endforeach
		</tbody>
	</table>
  
</body>
</html>