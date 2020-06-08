<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>kamartamu.com</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  <link href="{{ asset('themes/additionals/receipt/bootstrap.min.css') }}" rel="stylesheet">
  <style type="text/css">
		body{
			margin-top:20px;
			background:#eee;
		}
		.invoice {
		    padding: 30px;
		}

		.invoice h2 {
			margin-top: 0px;
			line-height: 0.8em;
		}

		.invoice .small {
			font-weight: 300;
		}

		.invoice hr {
			margin-top: 10px;
			border-color: #ddd;
		}

		.invoice .table tr.line {
			border-bottom: 1px solid #ccc;
		}

		.invoice .table td {
			border: none;
		}

		.invoice .identity {
			margin-top: 10px;
			font-size: 1.1em;
			font-weight: 300;
		}

		.invoice .identity strong {
			font-weight: 600;
		}


		.grid {
		    position: relative;
			width: 100%;
			background: #fff;
			color: #666666;
			border-radius: 2px;
			margin-bottom: 25px;
			box-shadow: 0px 1px 4px rgba(0, 0, 0, 0.1);
		}
	</style>
</head>
<body>
<div class="container">
	<div class="row">
		<!-- BEGIN INVOICE -->
		<div class="col-xs-12">
			<div class="grid invoice">
				<div class="grid-body">
					<div class="invoice-title">
						<div class="row">
							<div class="col-xs-12">
								<h1>KAMARTAMU</h1>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-xs-12">
								<h2>invoice<br>
							</div>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-xs-6">
							<address>
								<strong>Billed To:</strong><br>
								{{ $book->customer->name }}<br>
								{{ $book->customer->email }}<br>
								<abbr title="Phone">P:</abbr> {{ $book->customer->phone }}
							</address>
						</div>
						<div class="col-xs-6 text-right">
							<strong>Booking Room:</strong><br>
							{{ $book->room->name }}<br>
							{{ $book->room->location->name }}<br>
						</div>

					</div>
					<div class="row">
						<div class="col-xs-6">
							<address>
								<strong>Order Date:</strong><br>
								{{ date('d F Y', strtotime($book->created_at)) }}
							</address>
						</div>
						
					</div>
					<div class="row">
						<div class="col-md-12">
							<h3>ORDER SUMMARY</h3>
							<table class="table table-striped">
								<thead>
									<tr class="line">
										<td><strong>#</strong></td>
										<td><strong>Details</strong></td>
										<td class="text-right"><strong>Total</strong></td>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>1</td>
										<td><strong>Booking Room</strong>
											<br>{{ date('d F Y', strtotime($book->date_checkin)) }} - {{ date('d F Y', strtotime($book->date_checkout)) }}
											<br>{{ $book->rooms }} room - {{ $book->guests }} persons
										</td>
										<td class="text-right">Rp {{ number_format($book->total, 0, ',', '.') }}</td>
									</tr>
									<tr>
										<td></td>
										<td class="text-right"><strong>Service</strong></td>
										<td class="text-right"><strong>Rp {{ number_format($book->service, 0, ',', '.') }}</strong></td>
									</tr>
									<tr>
										<td></td>
										<td class="text-right"><strong>Total</strong></td>
										<td class="text-right"><strong>Rp {{ number_format($book->grand_total, 0, ',', '.') }}</strong></td>
									</tr>
								</tbody>
							</table>
						</div>									
					</div>
					<div class="row">
						<div class="col-md-12 text-right identity">
							<p>Best regards,<br><strong>kamartamu.com</strong></p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- END INVOICE -->
	</div>
</div>

<script src="{{ asset('themes/additionals/receipt/bootstrap.min.js') }}"></script>
<script type="text/javascript">
	
</script>
</body>
</html>