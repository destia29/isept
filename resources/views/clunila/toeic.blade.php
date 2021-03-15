@extends('templateclunila')

@section('title')
  LCUnila | TOEIC
@endsection

@section('main')
	<!-- PAGE HEADER -->
	<div class="page_header">
		<div class="page_header_parallax4">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h3><span>TOEIC®</span>Shape our students' futures<br>with the TOEIC® tests</h3>
					</div>
				</div>
			</div>
		</div>
		<div class="bcrumb-wrap">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<ul class="bcrumbs">
							<li><a href="#"><i class="fa fa-home"></i> Home</a></li>
							<li>TOEIC®</li>
						</ul>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<div class="inner-content">
		<div class="container">

			<!-- ABOUT -->
			<div class="section-about space100">
				<div class="row">
					<div class="col-md-6">
						<div>
							<img src="images/other/ets_toeic_pic.png" class="img-responsive" alt="">
						</div>
					</div>
					<div class="col-md-6">
						<div>
							<h3>What is the TOEIC®?</h3>
							<p align="justify">The Test of English for International Communication® (TOEIC) is "an English language test designed
                specifically to measure the everyday English skills of people working in an international environment."<br><br>

                The TOEIC Listening & Reading Test lasts two hours [45 minutes for Listening, and 75 minutes for Reading].
                It consists of 200 multiple-choice items evenly divided between the listening and reading comprehension section.
                Each candidate receives independent scores for listening and reading comprehension on a scale from 5 to 495 points.
                The total score adds up to a scale from 10 to 990 points.
            </div>
					</div>
				</div>
			</div>

			<!-- SERVICES -->
			<div class="section-services2 space40">
				<div class="row">
					<div class="col-md-4">
						<h3>A Reliable Assessment<br> of English</h3>
						<p class="space30" align="justify">The TOEIC L&R is an objective test using an optically-scanned answer sheet.
              There are 200 questions to answer in two hours in Listening (approximately 45 minutes, 100 questions) and
              Reading (75 minutes, 100 questions). The test format is same each time, and the answers are all filled
              in on a separate answer sheet.
						</p>
						<a href="{{ url('contactus') }}" class="button color2 btn-md">Contact Us!</a>
					</div>
					<!-- end section -->
					<div class="col-md-8">
						<div class="row">
							<div class="col-md-6 ss2-content">
								<i class="fa fa-headphones"></i>
								<h4>Listening Section</h4>
								<p>Listening Comprehension measures the ability to understand spoken English as it is used in colleges and universities.</p>
							</div>
							<!-- end section -->
							<div class="col-md-6 ss2-content">
								<i class="fa fa-book"></i>
								<h4>Reading Section</h4>
								<p>Reading Comprehension measures the ability to read and understand academic reading material in English.</p>
							</div>
							<!-- end section -->
						</div>
					</div>
				</div>
			</div>
				<div class="col-md-6">
					<h4>The TOEIC® Tests at a Glance</h4>
					<div class="space20"></div>
					<div class="space-top">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>Section</th>
									<th>Questions</th>
									<th>Test time</th>
									<th>Score Scale</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>Listening Section</td>
									<td align="center">100</td>
									<td>45 Minutes</td>
									<td align="center">5 - 495</td>
								</tr>
								<tr>
									<td>Reading Section</td>
									<td align="center">100</td>
									<td>75 minutes</td>
									<td align="center">5 - 495</td>
								</tr>
								<tr>
									<td>Total</td>
									<td align="center">140</td>
									<td>120 minutes</td>
									<td align="center">10 – 990</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="col-md-6">
					<h4>Give Your Organization a Global Advantage with the TOEIC® Tests</h4>
					<div class="space30"></div>
					<div class="panel-group" id="accordion-e1">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-e1" href="#collapseOne">
									Business Organizations
									<span class="fa fa-chevron-right"></span>
									</a>
								</h4>
							</div>
							<div id="collapseOne" class="panel-collapse collapse">
								<div class="panel-body">
									<p align="justify">
                    <b>Build a more skilled team for your business</b>
                    <ul class="fa-ul">
                      <li><span class="fa-li"><i class="fa fa-circle" style="font-size:10px"></i></span>Make more informed decisions on hiring, training and promoting the best candidates to roles where English skills matter the most.</li>
                    </ul>
								</div>
							</div>
						</div>
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-e1" href="#collapseTwo">
									Academic Institutions
									<span class="fa fa-chevron-right"></span>
									</a>
								</h4>
							</div>
							<div id="collapseTwo" class="panel-collapse collapse">
								<div class="panel-body">
									<p align="justify">
                    <b>Prepare work-ready graduates for success</b>
                    <ul class="fa-ul">
                      <li><span class="fa-li"><i class="fa fa-circle" style="font-size:10px"></i></span>Make more informed decisions on student admissions, placement and exiting.</li>
                      <li><span class="fa-li"><i class="fa fa-circle" style="font-size:10px"></i></span>Demonstrate the effectiveness of your English-language programs.</li>
                      <li><span class="fa-li"><i class="fa fa-circle" style="font-size:10px"></i></span>Enhance the global reputation of your institution.</li>
                    </ul>
                </div>
							</div>
						</div>
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-e1" href="#collapseTheree">
									Government Agencies
									<span class="fa fa-chevron-right"></span>
									</a>
								</h4>
							</div>
							<div id="collapseTheree" class="panel-collapse collapse">
								<div class="panel-body">
									<p align="justify">
                    <b>Cultivate stronger global talent for your government</b>
                    <ul class="fa-ul">
                      <li><span class="fa-li"><i class="fa fa-circle" style="font-size:10px"></i></span>Make more informed decisions within your government entity and for your country.</li>
                      <li><span class="fa-li"><i class="fa fa-circle" style="font-size:10px"></i></span>Bolster your international reputation.</li>
                    </ul>
                  </div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
  @stop

  @section('footer')
    @include('footer-top')
    @include('footer')
    @include('style-switcher')
  @stop
