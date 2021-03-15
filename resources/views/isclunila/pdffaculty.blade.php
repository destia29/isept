<!DOCTYPE html>
<html>
<head>
	<title>EPT FACULTY - PDF</title>
	<link rel="stylesheet" href="{{ asset ('assets/isept/morris/morris.css') }}">
	<link href="{{ asset ('css/isept/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset ('css/isept/bootstrap-reset.css') }}" rel="stylesheet">
	<style media="screen">
		.page-break{
			page-break-after: always;
		}
	</style>
</head>
<body>
	<h3>EPT FACULTY LEVEL DOCUMENT</h3>
	<table class="table" width="900px">
		<tr>
			<td><h5>Date</h5></td>
			<td><h5>{{ $ket["date"] }}</h5></td>
		</tr>
		<tr>
			<td><h5>Score Range</h5></td>
			<td><h5>{{ $ket["searchscore"] }}</h5></td>
		</tr>
	</table>
    <?php if ($ket["ept_type"] == "" || $ket["ept_type"] == 1): ?>
        <h4>D3 / S1</h4>
        <div id="s1_ept" style="height: 280px; width: 1500px"></div>
    <?php endif ?>
    <?php if ($ket["ept_type"] == "" || $ket["ept_type"] == 2): ?>
        <h4>Post Graduate/Public</h4>
        <div id="s2_ept" style="height: 280px; width: 1500px"></div>
    <?php endif ?>

		<!-- PERCENTAGE AND INFO BEGIN -->

		<br>
		<br>
		<table style="height:90px; width:1500px; border-collapse:separate; border-spacing:15px;">
			<tr>
				<td width="10%" style="background-color:#34c73b"></td>
				<td>Highest Score</td>
				<td>{{ $latest_pass_percentage}}%  All EPT Participants D3/S1</td>
			</tr>
			<tr>
				<td width="10%" style="background-color:#3960d1"></td>
				<td>Average Score</td>
				<td>{{ $latest_pass_percentage_s2}}%  All EPT Participants Post Graduate/Public</td>
			</tr>
			<tr>
				<td width="10%" style="background-color:#ff7979"></td>
				<td>Lowest Score</td>
				<td colspan="2"><?php if (isset($ket)): ?>
						<?php if ($ket["searchscore"] != ""): ?>
								With Score Range {{ $ket["searchscore"] }}
						<?php endif ?>
				<?php endif ?></td>
			</tr>
		</table>
		<!-- PERCENTAGE ENDED -->
		<br>


		<div class="page-break">
		</div>
    <?php if ($ket["ept_type"] == "" || $ket["ept_type"] == 1): ?>
        <br>
        <h4>D3 / S1</h4>
        <div id="table">
        	<table class="table table-bordered table-striped" width="900px">
        		<thead>
        			<tr>
								<td>No</td>
        				<td>Username</td>
								<td>Name</td>
        				<td>Faculty Name</td>
        				<td>Department</td>
								<td>Score</td>
        				<td>EPT Date</td>
        			</tr>
        		</thead>
        		<tbody>
        			<?php
        				$no = 1;
        				foreach ($ept_s1_raw as $key => $value){
        			?>
							<tr>
								<td>{{ $no++ }}</td>
								<td>{{ $value->a_id }}</td>
								<td>{{ $value->name }}</td>
								<td>{{ $value->y }}</td>
								<td>{{ $value->jurusan }}</td>
								<td>{{ $value->a }}</td>
								<td>{{ $value->tanggal }}</td>
							</tr>
							<tr>
								<td>{{ $no++ }}</td>
								<td>{{ $value->c_id }}</td>
								<td>{{ $value->name2 }}</td>
								<td>{{ $value->y }}</td>
								<td>{{ $value->jurusan2 }}</td>
								<td>{{ $value->c }}</td>
								<td>{{ $value->tanggal2 }}</td>
							</tr>
							<tr>
								<td colspan="7"></td>
							</tr>
        			<?php
        				}
        			?>
        		</tbody>
        	</table>
        </div>
    <?php endif ?>
		<div class="page-break">
		</div>
    <?php if ($ket["ept_type"] == "" || $ket["ept_type"] == 2): ?>
        <br>
        <h4>Post Graduate/Public</h4>
        <div id="table">
            <table class="table table-bordered table-striped" width="900px">
                <thead>
									<tr>
										<td>No</td>
										<td>Username</td>
										<td>Name</td>
										<td>Faculty Name</td>
										<td>Department</td>
										<td>Score</td>
										<td>EPT Date</td>
									</tr>
                </thead>
                <tbody>
                    <?php
                        $no = 1;
                        foreach ($ept_s2_raw as $key => $value){
                    ?>
										<tr>
											<td>{{ $no++ }}</td>
											<td>{{ $value->a_id }}</td>
											<td>{{ $value->name }}</td>
											<td>{{ $value->y }}</td>
											<td>{{ $value->jurusan }}</td>
											<td>{{ $value->a }}</td>
											<td>{{ $value->tanggal }}</td>
										</tr>
										<tr>
											<td>{{ $no++ }}</td>
											<td>{{ $value->c_id }}</td>
											<td>{{ $value->name2 }}</td>
											<td>{{ $value->y }}</td>
											<td>{{ $value->jurusan2 }}</td>
											<td>{{ $value->c }}</td>
											<td>{{ $value->tanggal2 }}</td>
										</tr>
										<tr>
											<td colspan="7"></td>
										</tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    <?php endif ?>

    <script src="{{ asset ('js/isept/bootstrap.min.js') }}"></script>
    <script src="{{ asset ('js/isept/jquery.js') }}"></script>
	<script src="{{ asset ('assets/isept/morris/morris.min.js') }}"></script>
    <script src="{{ asset ('assets/isept/morris/raphael.min.js') }}"></script>
    <script type="text/javascript">
        var epttype = "{{ $ket['ept_type'] }}";

        if (epttype == "" || epttype == 1) {
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
        }

        if (epttype == "" || epttype == 2) {
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
        }
    </script>
</body>
</html>
