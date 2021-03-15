<!DOCTYPE html>
<html>
<head>
	<title>EPT UNIVERSITY - PDF</title>
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
	<h3>EPT UNIVERSITY LEVEL DOCUMENT</h3>
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
	<br>
	<input type="hidden" id="jumlah_batch" value="{{ $jumlah_batch }}">
	<input type="hidden" id="jumlah_batch_s2" value="{{ $jumlah_batch_s2 }}">
	<h4>D3 / S1</h4>
    <!-- <div id="s1_ept" style="height: 280px; width: 1500px"></div> -->
		<?php foreach ($batch as $key => $value): ?>
	        <div id="morris-bar-{{ $key }}" style="height: 280px; width: 1500px;"></div>
	        <br>
	    <?php endforeach ?>

			<!-- PERCENTAGE S1 BEGIN -->

			<br>
			<br>
			<table style="height:90px; width:1500px; border-collapse:separate; border-spacing:15px;">
				<tr>
					<td width="10%" style="background-color:#34c73b"></td>
					<td>Highest Score</td>
					<td>{{ $latest_pass_percentage}}%  All EPT Participants S1/D3</td>
				</tr>
				<tr>
					<td width="10%" style="background-color:#3960d1"></td>
					<td>Average Score</td>
					<td><?php if (isset($ket)): ?>
							<?php if ($ket["searchscore"] != ""): ?>
									With Score Range {{ $ket["searchscore"] }}
							<?php endif ?>
					<?php endif ?></td>
				</tr>
				<tr>
					<td width="10%" style="background-color:#ff7979"></td>
					<td>Lowest Score</td>
					</td>
				</tr>
			</table>
			<!-- PERCENTAGE ENDED -->

			<div class="page-break">
			</div>

    <h4>Post Graduate/Public</h4>
		<?php foreach ($batch_s2 as $key => $value): ?>
	        <div id="morris-bar-s2-{{ $key }}" style="height: 280px; width: 1500px;"></div>
	        <br>
				<?php endforeach ?>

				<!-- PERCENTAGE S2 BEGIN -->

				<br>
				<br>
				<table style="height:90px; width:1500px; border-collapse:separate; border-spacing:15px;">
					<tr>
						<td width="10%" style="background-color:#34c73b"></td>
						<td>Highest Score</td>
						<td>{{ $latest_pass_percentage_s2}}%  All EPT Participants Post Graduate/Public</td>
					</tr>
					<tr>
						<td width="10%" style="background-color:#3960d1"></td>
						<td>Average Score</td>
						<td><?php if (isset($ket)): ?>
								<?php if ($ket["searchscore"] != ""): ?>
										With Score Range {{ $ket["searchscore"] }}
								<?php endif ?>
						<?php endif ?></td>
					</tr>
					<tr>
						<td width="10%" style="background-color:#ff7979"></td>
						<td>Lowest Score</td>
						</td>
					</tr>
				</table>
				<!-- PERCENTAGE ENDED -->

		<div class="page-break">
		</div>

    <h4>D3 / S1</h4>
		<p>Each two rows contain <b>Highest Score</b> on the first row and <b>Lowest Score</b> on the second row</p>
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
						<td>{{ $value->fakultas}}</td>
						<td>{{ $value->jurusan}}</td>
						<td>{{ $value->a}}</td>
						<td>{{ $value->y }}</td>
					</tr>
					<tr>
						<td>{{ $no++ }}</td>
						<td>{{ $value->c_id }}</td>
						<td>{{ $value->name2 }}</td>
						<td>{{ $value->fakultas2}}</td>
						<td>{{ $value->jurusan2}}</td>
						<td>{{ $value->c}}</td>
						<td>{{ $value->y }}</td>
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
    <br>
		<div class="page-break">
		</div>


    <h4>Post Graduate/Public</h4>
		<p>Each two rows contain <b>Highest Score</b> on the first row and <b>Lowest Score</b> on the second row</p>

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
									<td>{{ $value->fakultas}}</td>
									<td>{{ $value->jurusan}}</td>
									<td>{{ $value->a}}</td>
									<td>{{ $value->y }}</td>
								</tr>
								<tr>
									<td>{{ $no++ }}</td>
									<td>{{ $value->c_id }}</td>
									<td>{{ $value->name2 }}</td>
									<td>{{ $value->fakultas2}}</td>
									<td>{{ $value->jurusan2}}</td>
									<td>{{ $value->c}}</td>
									<td>{{ $value->y }}</td>
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


				var jumlah_batch_s2 = $("#jumlah_batch_s2").val();
				<?php for ($i = 0; $i < $jumlah_batch_s2; $i++) { $data_bar_s2 = json_encode($batch_s2[$i], JSON_NUMERIC_CHECK); ?>
					var i = "{{ $i }}";
					var data_s2 = {!! $data_bar_s2 !!};
        Morris.Bar({
						element: 'morris-bar-s2-'+i,
						data: data_s2,
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
