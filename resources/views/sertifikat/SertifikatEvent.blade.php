<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;800&display=swap" rel="stylesheet">
    <style type="text/css">
		/* To remove margin while generating PDF. */
        * {
            margin:0;
            padding:0
        }

    	body {
    		margin: 0;
    		height: 8.27in;
    		width: 11.69in;
    		background-image: url({{ public_path('background-sertifikat/template.png') }});
    		background-size: 11.69in 8.27in; /* Not sure whether it works with DOMPDF. So, using a background of actual size. */
    		background-repeat: no-repeat;
    	}

    	.name {
			position: absolute;
			left: 30.11%;
			top: 26.00%;
			
			font-family: 'Poppins';
			font-style: normal;
			font-weight: 800;
			font-size: 36px;
			line-height: 54px;
			/* identical to box height */

			letter-spacing: -0.01em;

			color: #EC2F5D;

			text-shadow: 5px 3px 0px rgba(0, 0, 0, 0.1);
    	}

		.desc {
			position: absolute;
			left: 30.34%;
			right: 15.76%;
			top: 49.04%;
			
			font-family: 'Poppins';
			font-style: normal;
			font-weight: 400;
			font-size: 13pt;
			line-height: 1;

			text-align: justify;

			color: #2D2D2D;
		}
		.tebal {
			font-weight: 800;
		}
    </style>
</head>
<body>
	<div class="name">{{ Str::upper($nama) }}</div>
	@if (\Carbon\Carbon::parse($event->tanggal_mulai)->format('j F Y') === \Carbon\Carbon::parse($event->tanggal_berakhir)->format('j F Y'))
		<div class="desc">Kegiatan <strong class="tebal">{{ $event->kategori . ' ' . $event->nama_event }}</strong> yang diselenggarakan oleh Dinas Perpustakaan dan Arsip Kabupaten Indramayu pada tanggal <strong class="tebal">{{ \Carbon\Carbon::parse($event->tanggal_mulai)->locale('id')->settings(['formatFunction' => 'translatedFormat'])->format('j F Y') }}</strong></div>
	@else
		<div class="desc">Kegiatan <strong class="tebal">{{ $event->kategori . ' ' . $event->nama_event }}</strong> yang diselenggarakan oleh Dinas Perpustakaan dan Arsip Kabupaten Indramayu pada tanggal <strong class="tebal">{{ \Carbon\Carbon::parse($event->tanggal_mulai)->locale('id')->settings(['formatFunction' => 'translatedFormat'])->format('j F Y') }}</strong> sampai <strong class="tebal">{{ \Carbon\Carbon::parse($event->tanggal_berakhir)->locale('id')->settings(['formatFunction' => 'translatedFormat'])->format('j F Y') }}</strong></div>
	@endif
</body>
</html>