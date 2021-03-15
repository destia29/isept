@extends('templateclunila')

@section('title')
  LCUnila | IELTS&trade;
@endsection

@section('main')
	<!-- PAGE HEADER -->
	<div class="page_header">
		<div class="page_header_parallax4">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h3><span>IELTS&trade;</span>English for<br>International Oppurtunity</h3>
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
							<li>IELTS&trade;</li>
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
							<img src="images/other/ieltspic.png" class="img-responsive" alt="">
						</div>
					</div>
					<div class="col-md-6">
						<div>
							<h3>What is the IELTS&trade;?</h3>
							<p align="justify">The International English Language Testing System (IELTS&trade;) is the world’s most popular English language proficiency test for higher
                education and global migration, with over 3 million tests taken in the last year. IELTS&trade; assesses all of your English skills — reading, writing,
                listening and speaking, and is designed to reflect how you will use English at study, at work, and at play, in your new life abroad.<br><br>

                The IELTS&trade; test is developed by some of the world’s leading experts in language assessment. It has an excellent international reputation,
                and is accepted by over 10,000 organisations worldwide, including schools, universities, employers, immigration authorities and professional bodies.
            </div>
					</div>
				</div>
			</div>

			<!-- SERVICES -->
			<div class="section-services2 space40">
				<div class="row">
					<div class="col-md-4">
						<h3>English for International<br> Oppurtunity</h3>
						<p class="space30" align="justify">IELTS&trade; is the most widely accepted English language test that uses a one-on-one speaking test to assess your English communication skills.
              This means that you are assessed by having a real-life conversation with a real person. This is the most effective and natural way of testing your English conversation skills.
              <br>You can take <b>IELTS&trade; Academic or IELTS&trade; General Training</b> – depending on the organisation you are applying to and your plans for the future.
						</p>
						<a href="{{ url('contactus') }}" class="button color2 btn-md">Contact Us!</a>
					</div>
					<!-- end section -->
					<div class="col-md-8">
						<div class="row">
							<div class="col-md-3 ss2-content">
								<i class="fa fa-headphones"></i>
								<h4>Listening</h4>
								<p>The Listening module has four sections, with around ten questions in each section.</p>
							</div>
							<!-- end section -->
							<div class="col-md-3 ss2-content">
								<i class="fa fa-book"></i>
								<h4>Reading</h4>
								<p>Reading measures the ability to read and understand academic reading material in English.</p>
							</div>
							<!-- end section -->
							<div class="col-md-3 ss2-content">
								<i class="fa fa-pencil"></i>
								<h4>Writing</h4>
								<p>Write clearly, organise your ideas and use a varied vocabulary.</p>
							</div>
							<div class="col-md-3 ss2-content">
								<i class="fa fa-comment"></i>
								<h4>Speaking</h4>
								<p>The speaking test is a face-to-face interview between the test taker and an examiner.The speaking test contains three sections.</p>
							</div>
							<!-- end section -->
						</div>
					</div>
				</div>
			</div>
				<div class="col-md-6">
					<h4>The IELTS&trade; Tests at a Glance</h4>
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
									<td>Listening</td>
									<td align="center">40</td>
									<td>30 Minutes</td>
									<td align="center">0 - 9</td>
								</tr>
								<tr>
									<td>Reading</td>
									<td align="center">Variable</td>
									<td>60 Minutes</td>
									<td align="center">0 - 9</td>
								</tr>
								<tr>
									<td>Writing</td>
									<td align="center">150 | 250 words</td>
									<td>60 Minutes</td>
									<td align="center">0 - 9</td>
								</tr>
								<tr>
									<td>Speaking</td>
									<td align="center">3 sections</td>
									<td>11-14 minutes</td>
									<td align="center">0 - 9</td>
								</tr>
								<tr>
									<td colspan="2">Total</td>
									<td>165 minutes</td>
									<td align="center">0 – 9</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="col-md-6">
					<h4>Topics which are usually appear in the IELTS&trade; Tests</h4>
					<div class="space30"></div>
					<div class="panel-group" id="accordion-e1">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-e1" href="#collapseOne">
									Academic Topics
									<span class="fa fa-chevron-right"></span>
									</a>
								</h4>
							</div>
							<div id="collapseOne" class="panel-collapse collapse">
								<div class="panel-body">
									<p align="justify">
                    <ul class="fa-ul">
                      <li><span class="fa-li"><i class="fa fa-circle" style="font-size:10px"></i></span><b>Arts:</b> fine arts, crafts, theater, dance, architecture, literature, music, film, photography</li>
                      <li><span class="fa-li"><i class="fa fa-circle" style="font-size:10px"></i></span><b>Humanities:</b> history, political science, government, philosophy, law</li>
                      <li><span class="fa-li"><i class="fa fa-circle" style="font-size:10px"></i></span><b>Life Sciences:</b> paleontology, biochemistry, animal behavior, ecology, anatomy, physiology, genetics, health science, biology, agriculture</li>
                      <li><span class="fa-li"><i class="fa fa-circle" style="font-size:10px"></i></span><b>Physical Sciences:</b> geology, astronomy, chemistry, Earth science, engineering, meteorology, energy, technology, oceanography, physics</li>
                      <li><span class="fa-li"><i class="fa fa-circle" style="font-size:10px"></i></span><b>Social Sciences:</b> anthropology, sociology, education, geography, archaeology, psychology, economics, business, management, marketing, communications</li>
                    </ul>
								</div>
							</div>
						</div>
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-e1" href="#collapseTwo">
									Campus-life Topics
									<span class="fa fa-chevron-right"></span>
									</a>
								</h4>
							</div>
							<div id="collapseTwo" class="panel-collapse collapse">
								<div class="panel-body">
									<p align="justify">
                    <ul class="fa-ul">
                      <li><span class="fa-li"><i class="fa fa-circle" style="font-size:10px"></i></span><b>Classes:</b> class schedules, class requirements, library references, assignments (papers, presentations, readings), professors, studying, field trips</li>
                      <li><span class="fa-li"><i class="fa fa-circle" style="font-size:10px"></i></span><b>Campus administration:</b> registration, housing on and off campus, study abroad, internships, university policies</li>
                      <li><span class="fa-li"><i class="fa fa-circle" style="font-size:10px"></i></span><b>Campus activities:</b> clubs, committees, social events</li>
                    </ul>
                </div>
							</div>
						</div>
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-e1" href="#collapseTheree">
									General Topics
									<span class="fa fa-chevron-right"></span>
									</a>
								</h4>
							</div>
							<div id="collapseTheree" class="panel-collapse collapse">
								<div class="panel-body">
									<p align="justify">
                    <ul class="fa-ul">
                      <li><span class="fa-li"><i class="fa fa-circle" style="font-size:10px"></i></span><b>Business:</b> management, offices, official documents, law
                      <li><span class="fa-li"><i class="fa fa-circle" style="font-size:10px"></i></span><b>Environment:</b> weather, nature, climate, environment
                      <li><span class="fa-li"><i class="fa fa-circle" style="font-size:10px"></i></span><b>Food:</b> types of food, restaurants
                      <li><span class="fa-li"><i class="fa fa-circle" style="font-size:10px"></i></span><b>Language and communication:</b> mail, email, telephone use, leaving messages, requests for information
                      <li><span class="fa-li"><i class="fa fa-circle" style="font-size:10px"></i></span><b>Media:</b> TV, newspapers, internet
                      <li><span class="fa-li"><i class="fa fa-circle" style="font-size:10px"></i></span><b>Objects:</b> descriptions of objects, equipment
                      <li><span class="fa-li"><i class="fa fa-circle" style="font-size:10px"></i></span><b>Personal:</b> family members, friends, health, emotions, physical characteristics, daily routines
                      <li><span class="fa-li"><i class="fa fa-circle" style="font-size:10px"></i></span><b>Planning and time management:</b> future events, invitations, personal schedules
                      <li><span class="fa-li"><i class="fa fa-circle" style="font-size:10px"></i></span><b>Purchases:</b> clothing, shopping, banking, money
                      <li><span class="fa-li"><i class="fa fa-circle" style="font-size:10px"></i></span><b>Recreation:</b> sports, games, concerts, plays, art, books, photography, music, parties and gatherings, public lectures
                      <li><span class="fa-li"><i class="fa fa-circle" style="font-size:10px"></i></span><b>Transportation:</b> travel, driving, parking, public transportation, travel reservations
                      <li><span class="fa-li"><i class="fa fa-circle" style="font-size:10px"></i></span><b>Workplace:</b> applying for a job, on-campus employment, work schedules
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
