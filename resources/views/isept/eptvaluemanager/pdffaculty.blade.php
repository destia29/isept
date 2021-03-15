<!DOCTYPE html>
<html>
<head>
	<title>PDF FACULTY EPT</title>
	<link rel="stylesheet" href="{{ asset ('assets/isept/morris/morris.css') }}">
	<link href="{{ asset ('css/isept/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset ('css/isept/bootstrap-reset.css') }}" rel="stylesheet">
</head>
<body>
	<h3>PDF DOKUMEN MENU FACULTY EPT</h3>
	<table class="table" width="900px">
		<tr>
			<td><h5>Tanggal</h5></td>
			<td><h5>{{ $ket["date"] }}</h5></td>
		</tr>
		<tr>
			<td><h5>Range Score Score</h5></td>
			<td><h5>{{ $ket["searchscore"] }}</h5></td>
		</tr>
	</table>
	<br>
	<h4>D3 / S1</h4>
    <div id="s1_ept" style="height: 280px; width: 900px"></div>
    <h4>S2 / S3</h4>
    <div id="s2_ept" style="height: 280px; width: 900px"></div>
    <br>
    <h4>D3 / S1</h4>
    <div id="table">
    	<table class="table table-bordered table-striped" width="900px">
    		<thead>
    			<tr>
    				<td>No</td>
    				<td>Tanggal</td>
    				<td>Faculty Name</td>
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
    						<td>{{ $value->tanggal }}</td>
    						<td>{{ $value->y }}</td>
    						<td>{{ $value->a }}</td>
    						<td>{{ $value->a_id }}</td>
    					</tr>
    					<tr>
    						<td>{{ $no++ }}</td>
    						<td>{{ $value->tanggal2 }}</td>
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
    <br>
    <h4>S2 / S3</h4>
    <div id="table">
        <table class="table table-bordered table-striped" width="900px">
            <thead>
                <tr>
                    <td>No</td>
                    <td>Tanggal</td>
                    <td>Faculty Name</td>
                    <td>Score</td>
                    <td>Username</td>
                </tr>
            </thead>
            <tbody>
                <?php
                    $no = 1;
                    foreach ($ept_s2_raw as $key => $value){
                ?>
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $value->tanggal }}</td>
                            <td>{{ $value->y }}</td>
                            <td>{{ $value->a }}</td>
                            <td>{{ $value->a_id }}</td>
                        </tr>
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $value->tanggal2 }}</td>
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
        Morris.Bar({
            element: 's1_ept',
            data: {!! $ept_s1 !!},
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

        Morris.Bar({
            element: 's2_ept',
            data: {!! $ept_s2 !!},
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
    </script>
</body>
</html>
