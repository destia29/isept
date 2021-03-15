<!DOCTYPE html>
<html>
<head>
	<title>PDF Departmen EPT</title>
	<link rel="stylesheet" href="{{ asset ('assets/isept/morris/morris.css') }}">
	<link href="{{ asset ('css/isept/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset ('css/isept/bootstrap-reset.css') }}" rel="stylesheet">
</head>
<body>
	<h3>PDF DOKUMEN MENU DEPARTMENT EPT</h3>
	<table class="table" width="900px">
		<tr>
			<td><h5>Fakultas</h5></td>
			<td><h5>{{ $ket["faculty"] }}</h5></td>
		</tr>
		<tr>
			<td><h5>Tanggal</h5></td>
			<td><h5>{{ $ket["date"] }}</h5></td>
		</tr>
		<tr>
			<td><h5>Grade</h5></td>
			<td><h5>{{ $ket["epttype"] }}</h5></td>
		</tr>
		<tr>
			<td><h5>Range Score Score</h5></td>
			<td><h5>{{ $ket["searchscore_data"] }}</h5></td>
		</tr>
	</table>
	<br>
	<input type="hidden" id="jumlah_batch" value="{{ $jumlah_batch }}">
	<?php foreach ($batch as $key => $value): ?>
        <div id="morris-bar-{{ $key }}" style="height: 280px; width: 900px;"></div>
        <br>
    <?php endforeach ?>
    <br>
    <br>
    <div id="table">
    	<table class="table table-bordered table-striped" width="900px">
    		<thead>
    			<tr>
    				<td>No</td>
    				<td>Date</td>
    				<td>Department</td>
    				<td>Score</td>
    				<td>Username</td>
    			</tr>
    		</thead>
    		<tbody>
    			<?php
    				$no = 1;
    				foreach ($ept_s1_raw as $key => $value){
    			?>
    					<tr>
    						<td>{{ $no++ }}</td>
    						<td>{{ $value->a_date }}</td>
    						<td>{{ $value->y }}</td>
    						<td>{{ $value->a }}</td>
    						<td>{{ $value->a_id }}</td>
    					</tr>
    					<tr>
    						<td>{{ $no++ }}</td>
    						<td>{{ $value->c_date }}</td>
    						<td>{{ $value->y }}</td>
    						<td>{{ $value->c }}</td>
    						<td>{{ $value->c_id }}</td>
    					</tr>
    			<?php
    				}
    			?>
    		</tbody>
    	</table>
    </div>

    <script src="{{ asset ('js/isept/bootstrap.min.js') }}"></script>
    <script src="{{ asset ('js/isept/jquery.js') }}"></script>
	<script src="{{ asset ('assets/isept/morris/morris.min.js') }}"></script>
    <script src="{{ asset ('assets/isept/morris/raphael.min.js') }}"></script>
    <script type="text/javascript">
    	var jumlah_batch = $("#jumlah_batch").val();
		<?php for ($i = 0; $i < $jumlah_batch; $i++) { $data_bar = json_encode($batch[$i], JSON_NUMERIC_CHECK); ?>
		    var i = "{{ $i }}";
		    var data = {!! $data_bar !!};
		    Morris.Bar({
		        element: 'morris-bar-'+i,
		        data: data,
		        xkey: 'y',
		        ykeys: ['a', 'b', 'c'],
		        labels: ['Highest Score', 'Average Score', 'Lowest Score'],
		        gridLineColor: '#eef0f2',
		        barSizeRatio: 0.3,
		        numLines: 6,
		        barGap: 4,
		        resize: true,
		        hideHover: 'auto',
		        barColors: ['#34c73b', '#3960d1', '#ff7979']
		    });
		<?php } ?>
    </script>
</body>
</html>
