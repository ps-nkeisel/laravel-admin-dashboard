<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ $title }}</title>

    <!-- Styles -->
    <style>
		html, body {
			font-family: Helvetica;
		}

		.text-center {
			text-align: center !important;
		}

		table {
			border-collapse: collapse;
		}
		.table {
			width: 100%;
			margin-bottom: 1rem;
			color: #495057;
			background-color: transparent;

			color: #000;
    		background-color: #fff;
		}
		.table-bordered {
			border: 1px solid #000;
		}
		.table thead th {
			font-weight: 600;
		}
		.table th, .table td {
			padding: 0.75rem;
			vertical-align: top;
			border-top: 1px solid #000;
		}
		.table thead th {
			vertical-align: bottom;
			border-bottom: 2px solid #000;
		}
		.table-bordered th, .table-bordered td {
			border: 1px solid #000;
		}
		.table-bordered thead th, .table-bordered thead td {
			border-bottom-width: 2px;
		}
		.table th, .table td {
			padding: 0.75rem;
			vertical-align: top;
			border-top: 1px solid #000;
		}
		.table-bordered th, .table-bordered td {
			border: 1px solid #000;
		}

		.text-success {
			color: #82b54b !important;
		}
		.text-danger {
			color: #e04f1a !important;
		}
    </style>
</head>

<body>
	{!! $content !!}
</body>
</html>
