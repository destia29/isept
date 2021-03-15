@extends('templateclunila')

@section('title')
  LCUnila | English Proficiency Test
@endsection

@section('main')
	<!-- PAGE HEADER -->
	<div class="page_header">
		<div class="page_header_parallax4">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h3><span>English Proficiency Test</span>Boost Your Confidence<br>with the English Proficiency Test</h3>
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
							<li>English Proficiency Test</li>
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
							<img src="images/other/epttoefl.png" class="img-responsive" alt="">
						</div>
					</div>
					<div class="col-md-6">
						<div>
							<h3>What is the English Proficiency Test?</h3>
							<p align="justify">The English Proficiency Test (EPT) is a test held by Language Center of Lampung University which measures people’s and our students' English language skills to see if they are
                good enough to take a course at university or graduate from our university. It is for people whose native language is not English. It measures how well
                a person uses listening, reading, speaking and writing skills to perform academic tasks.<br><br>

                You can register the English Proficiency Test by using our Information System of English Proficiency Test <a href="{{ url('isept/login') }}"><font color="446CB3">(ISEPT)</font></a> which you can reach at login menu-><a href="{{ url('isept/login') }}"><font color="446CB3">ISEPT</font></a>.
            </div>
					</div>
				</div>
			</div>

			<!-- SERVICES -->
			<div class="section-services2 space40">
				<div class="row">
					<div class="col-md-4">
						<h3>A Reliable Assessment<br> of English</h3>
						<p class="space30" align="justify">The English Proficiency Test are paper-based or computer-based and use academic and social content to evaluate the English-language proficiency
              of nonnative English speakers, giving us confidence about our students' ability in a real-world academic setting.
              All questions are multiple choice and students answer questions by filling in an answer sheet. The tests evaluate skills in three areas:
						</p>
						<a href="{{ url('isept/login') }}" class="button color2 btn-md">Register Now!</a>
					</div>
					<!-- end section -->
					<div class="col-md-8">
						<div class="row">
							<div class="col-md-4 ss2-content">
								<i class="fa fa-headphones"></i>
								<h4>Listening Comprehension</h4>
								<p>Listening Comprehension measures the ability to understand spoken English as it is used in colleges and universities.</p>
							</div>
							<!-- end section -->
							<div class="col-md-4 ss2-content">
								<i class="fa fa-pencil"></i>
								<h4>Structure and Written Expression</h4>
								<p>Structure and Written Expression measures recognition of selected structural and grammatical points in standard written English.</p>
							</div>
							<!-- end section -->
							<div class="col-md-4 ss2-content">
								<i class="fa fa-book"></i>
								<h4>Reading Comprehension</h4>
								<p>Reading Comprehension measures the ability to read and understand academic reading material in English.</p>
							</div>
							<!-- end section -->
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<h4>EPT Schedule for S1/D3</h4>
				 <div class="space20"></div>
    				<div class="space-top">
    					<table class="table table-striped">
    						<thead>
    							<tr>
    								<th>No</th>
    								<th>Test Date</th>
    								<th align="center">Capacity</th>
    								<th align="center">Registered</th>
    								<th align="center">Status</th>
    							</tr>
    						</thead>
    						<tbody>
                  <?php $i=1; $total=0; ?>
                  @foreach($eptschedules1 as $data)
    								<tr>
    									<td>{{ $i++ }}</td>
    									<td>{{ date('d F Y', strtotime($data->ept_date)) }}</td>
                      <td align="center">
                        @foreach($data->availableseat as $value)
                        <?php
                          $total=$total+$value->room->capacity;
                          ?>
                        @endforeach
                        {{ $total }}
                      </td>
    									<td style="text-align:center">{{ $data->registerept_participant->count() }}</td>
                      <td>
                          @if($total <= $data->registerept_participant->count())
                              <span class="label label-danger">Full</span>
                          @else
                              <span class="label label-success">Available</span>
                          @endif
                      </td>
    								</tr>
                    <?php $total=0; ?>
                  @endforeach
    						</tbody>
    					</table>
				    </div>
			  </div>
  			<div class="col-md-6">
  				<h4>EPT Schedule for S2/Public</h4>
  				 <div class="space20"></div>
      				<div class="space-top">
      					<table class="table table-striped">
      						<thead>
      							<tr>
      								<th>No</th>
      								<th>Test Date</th>
      								<th align="center">Capacity</th>
      								<th align="center">Registered</th>
      								<th align="center">Status</th>
      							</tr>
      						</thead>
      						<tbody>
                    <?php $i=1; $total=0; ?>
                    @foreach($eptschedules2 as $data)
      								<tr>
      									<td>{{ $i++ }}</td>
      									<td>{{ date('d F Y', strtotime($data->ept_date)) }}</td>
                        <td align="center">
                          @foreach($data->availableseat as $value)
                          <?php
                            $total=$total+$value->room->capacity;
                            ?>
                          @endforeach
                          {{ $total }}
                        </td>
      									<td style="text-align:center">{{ $data->registerept_participant->count() }}</td>
                        <td>
                            @if($total <= $data->registerept_participant->count())
                                <span class="label label-danger">Full</span>
                            @else
                                <span class="label label-success">Available</span>
                            @endif
                        </td>
      								</tr>
                      <?php $total=0; ?>
                    @endforeach
      						</tbody>
      					</table>
  				    </div>
  			  </div>
    				<div class="col-md-8 col-md-offset-2 text-center">
    					<h2 class="uppercase">How to <span class="highlight">Take an EPT</span></h2>
    					<p>Welcome, If you don't now how to take an EPT, Please follow the instructions below to take an EPT as an EPT participant. </p>
    				</div>
    			<div class="row">
    				<div class="col-md-10 col-md-offset-1">
    					<!--Nav Tabs-->
    					<ul class="nav-tabs left" role="tablist">
    						<li class="active"><a href="#pre-sale" role="tab" data-toggle="tab"><span>01</span>Signup/Login</a></li>
    						<li><a href="#install" role="tab" data-toggle="tab"><span>02</span>Register</a></li>
    						<li><a href="#support" role="tab" data-toggle="tab"><span>03</span>Take a Test</a></li>
    						<li><a href="#custom" role="tab" data-toggle="tab"><span>04</span>Finish</a></li>
    					</ul>
    					<!--Tabs Content-->
    					<div class="tab-content">
    						<!--Tab01-->
    						<div class="tab-pane fade in active" id="pre-sale">
    							<div id="accordion01">
    								<div class="panel">
    									<div class="panel-heading">
    										<a data-toggle="collapse" data-parent="#accordion01" href="#collapse01">
    										1.&nbsp;Signup/Login to ISEPT (Information System of English Proficiency Test)
    										</a>
    									</div>
    									<div id="collapse01" class="panel-collapse collapse in">
    										<div class="panel-body">
    											{{-- The first thing to do is you need to have an ISEPT Account. As an Unila Students, you may login to your account by using the same username and password as your NPM. If not you need to visit Language Center of Unila.
                          If you're a Public Participant, You should go to Language Center of Unila to make your ISEPT Account. --}}
                          The first thing to do is you need to have an ISEPT Account. You can login to ISEPT Account by inputing your username and your password.
                          If you haven't made an ISEPT Account yet, you can signup by clicking the signup button.
    										</div>
    									</div>
    								</div>
    								<div class="panel">
    									<div class="panel-heading">
    										<a data-toggle="collapse" data-parent="#accordion01" href="#collapse02" class="collapsed">
    										2.&nbsp;Why I can not create a new ISEPT account?
    										</a>
    									</div>
    									<div id="collapse02" class="panel-collapse collapse">
    										<div class="panel-body">
    											To make a new ISEPT account, your username/NPM must be unique. Your Re-type Password must match with the First Password.
                          If still can't Signup to ISEPT that means you already signup before. If you feel you have never registered an ISEPT account before, please contact us or visit Language Center of Unila
    										</div>
    									</div>
    								</div>
    								<div class="panel">
    									<div class="panel-heading">
    										<a data-toggle="collapse" data-parent="#accordion01" href="#collapse03" class="collapsed">
    										3.&nbsp;Where fusce eget aliquet arcu?
    										</a>
    									</div>
    									<div id="collapse03" class="panel-collapse collapse">
    										<div class="panel-body">
    											Mauris posuere metus at urna euismod iaculis. Aliquam quis ligula ut sem convallis luctus nec ut nulla. Donec efficitur porttitor eros id blandit. Aliquam tincidunt viverra tempor. Curabitur vehicula mauris justo, id ultricies tellus ullamcorper at.
    										</div>
    									</div>
    								</div>
    								<div class="panel">
    									<div class="panel-heading">
    										<a data-toggle="collapse" data-parent="#accordion01" href="#collapse04" class="collapsed">
    										4.&nbsp;How eget blandit mattis justo felis?
    										</a>
    									</div>
    									<div id="collapse04" class="panel-collapse collapse">
    										<div class="panel-body">
    											Mauris posuere metus at urna euismod iaculis. Aliquam quis ligula ut sem convallis luctus nec ut nulla. Donec efficitur porttitor eros id blandit. Aliquam tincidunt viverra tempor. Curabitur vehicula mauris justo, id ultricies tellus ullamcorper at.
    										</div>
    									</div>
    								</div>
    							</div>
    						</div>
    						<!--Tab02-->
    						<div class="tab-pane fade" id="install">
    							<div id="accordion02">
    								<div class="panel">
    									<div class="panel-heading">
    										<a data-toggle="collapse" data-parent="#accordion02" href="#collapse05">
    										1.&nbsp;What quis ligula ut sem convallis?
    										</a>
    									</div>
    									<div id="collapse05" class="panel-collapse collapse">
    										<div class="panel-body">
    											Mauris posuere metus at urna euismod iaculis. Aliquam quis ligula ut sem convallis luctus nec ut nulla. Donec efficitur porttitor eros id blandit. Aliquam tincidunt viverra tempor. Curabitur vehicula mauris justo, id ultricies tellus ullamcorper at.
    										</div>
    									</div>
    								</div>
    								<div class="panel">
    									<div class="panel-heading">
    										<a data-toggle="collapse" data-parent="#accordion02" href="#collapse06" class="collapsed">
    										2.&nbsp;Why posuere metus at urna euismod?
    										</a>
    									</div>
    									<div id="collapse06" class="panel-collapse collapse">
    										<div class="panel-body">
    											Mauris posuere metus at urna euismod iaculis. Aliquam quis ligula ut sem convallis luctus nec ut nulla. Donec efficitur porttitor eros id blandit. Aliquam tincidunt viverra tempor. Curabitur vehicula mauris justo, id ultricies tellus ullamcorper at.
    										</div>
    									</div>
    								</div>
    								<div class="panel">
    									<div class="panel-heading">
    										<a data-toggle="collapse" data-parent="#accordion02" href="#collapse07" class="collapsed">
    										3.&nbsp;Where fusce eget aliquet arcu?
    										</a>
    									</div>
    									<div id="collapse07" class="panel-collapse collapse">
    										<div class="panel-body">
    											Mauris posuere metus at urna euismod iaculis. Aliquam quis ligula ut sem convallis luctus nec ut nulla. Donec efficitur porttitor eros id blandit. Aliquam tincidunt viverra tempor. Curabitur vehicula mauris justo, id ultricies tellus ullamcorper at.
    										</div>
    									</div>
    								</div>
    								<div class="panel">
    									<div class="panel-heading">
    										<a data-toggle="collapse" data-parent="#accordion02" href="#collapse08" class="collapsed">
    										4.&nbsp;How eget blandit mattis justo felis?
    										</a>
    									</div>
    									<div id="collapse08" class="panel-collapse collapse">
    										<div class="panel-body">
    											Mauris posuere metus at urna euismod iaculis. Aliquam quis ligula ut sem convallis luctus nec ut nulla. Donec efficitur porttitor eros id blandit. Aliquam tincidunt viverra tempor. Curabitur vehicula mauris justo, id ultricies tellus ullamcorper at.
    										</div>
    									</div>
    								</div>
    							</div>
    						</div>
    						<!--Tab03-->
    						<div class="tab-pane fade" id="support">
    							<div id="accordion03">
    								<div class="panel">
    									<div class="panel-heading">
    										<a data-toggle="collapse" data-parent="#accordion03" href="#collapse09" class="collapsed">
    										1.&nbsp;How lorem ipsum dolor sit amet adipiscing elit ?
    										</a>
    									</div>
    									<div id="collapse09" class="panel-collapse collapse">
    										<div class="panel-body">
    											Mauris posuere metus at urna euismod iaculis. Aliquam quis ligula ut sem convallis luctus nec ut nulla. Donec efficitur porttitor eros id blandit. Aliquam tincidunt viverra tempor. Curabitur vehicula mauris justo, id ultricies tellus ullamcorper at.
    										</div>
    									</div>
    								</div>
    								<div class="panel">
    									<div class="panel-heading">
    										<a data-toggle="collapse" data-parent="#accordion03" href="#collapse10" class="collapsed">
    										2.&nbsp;Where imperdiet auctor velit quis auctor?
    										</a>
    									</div>
    									<div id="collapse10" class="panel-collapse collapse">
    										<div class="panel-body">
    											Mauris posuere metus at urna euismod iaculis. Aliquam quis ligula ut sem convallis luctus nec ut nulla. Donec efficitur porttitor eros id blandit. Aliquam tincidunt viverra tempor. Curabitur vehicula mauris justo, id ultricies tellus ullamcorper at.
    										</div>
    									</div>
    								</div>
    								<div class="panel">
    									<div class="panel-heading">
    										<a data-toggle="collapse" data-parent="#accordion03" href="#collapse11">
    										3.&nbsp;Where fusce eget aliquet arcu?
    										</a>
    									</div>
    									<div id="collapse11" class="panel-collapse collapse">
    										<div class="panel-body">
    											Mauris posuere metus at urna euismod iaculis. Aliquam quis ligula ut sem convallis luctus nec ut nulla. Donec efficitur porttitor eros id blandit. Aliquam tincidunt viverra tempor. Curabitur vehicula mauris justo, id ultricies tellus ullamcorper at.
    										</div>
    									</div>
    								</div>
    							</div>
    						</div>
    						<!--Tab04-->
    						<div class="tab-pane fade" id="custom">
    							<div id="accordion04">
    								<div class="panel">
    									<div class="panel-heading">
    										<a data-toggle="collapse" data-parent="#accordion04" href="#collapse12">
    										1.&nbsp;How lorem ipsum dolor sit amet adipiscing elit ?
    										</a>
    									</div>
    									<div id="collapse12" class="panel-collapse collapse">
    										<div class="panel-body">
    											Mauris posuere metus at urna euismod iaculis. Aliquam quis ligula ut sem convallis luctus nec ut nulla. Donec efficitur porttitor eros id blandit. Aliquam tincidunt viverra tempor. Curabitur vehicula mauris justo, id ultricies tellus ullamcorper at.
    										</div>
    									</div>
    								</div>
    								<div class="panel">
    									<div class="panel-heading">
    										<a data-toggle="collapse" data-parent="#accordion04" href="#collapse13" class="collapsed">
    										2.&nbsp;Where imperdiet auctor velit quis auctor?
    										</a>
    									</div>
    									<div id="collapse13" class="panel-collapse collapse">
    										<div class="panel-body">
    											Mauris posuere metus at urna euismod iaculis. Aliquam quis ligula ut sem convallis luctus nec ut nulla. Donec efficitur porttitor eros id blandit. Aliquam tincidunt viverra tempor. Curabitur vehicula mauris justo, id ultricies tellus ullamcorper at.
    										</div>
    									</div>
    								</div>
    								<div class="panel">
    									<div class="panel-heading">
    										<a data-toggle="collapse" data-parent="#accordion04" href="#collapse14" class="collapsed">
    										3.&nbsp;Where fusce eget aliquet arcu?
    										</a>
    									</div>
    									<div id="collapse14" class="panel-collapse collapse">
    										<div class="panel-body">
    											Mauris posuere metus at urna euismod iaculis. Aliquam quis ligula ut sem convallis luctus nec ut nulla. Donec efficitur porttitor eros id blandit. Aliquam tincidunt viverra tempor. Curabitur vehicula mauris justo, id ultricies tellus ullamcorper at.
    										</div>
    									</div>
    								</div>
    							</div>
    						</div>
    					</div>
    				</div>
          </div>
      		<div class="search-container">
      			<div class="container">
      				<div class="row">
            			<div class="text-center">
            				<div class="col-md-8 col-md-offset-2 text-center">
            					<h2 class="uppercase">Find your <span class="highlight">EPT Result</span></h2>
            					<p>You can use this search tool to find your EPT Result by inputing certificate number in your e-PIC Qrcode or EPT certificate</p>
            				</div>
            				<div class="space30"></div>
                    <form role="form" action="{{ route('ept.searcheptresult') }}" method="GET">
              				<div class="col-md-8 col-md-offset-2">
              					<div class="input-group">
              						<input class="form-control" name="searcheptresult" placeholder="0001-01.1/UN01.01/TU.00.01/2001" type="text">
              						<span class="input-group-btn">
              						<button type="submit"><i class="fa fa-search"></i></button>
              						</span>
              					</div>
              				</div>
                  </form>
          			</div>
              </div>
            </div>
          </div>
  			<div class="clearfix space40"></div>
  			<div class="text-center">
  				<h4>For further information. Contact us here.</h4>
  				<div class="space30"></div>
  				<a href="{{ url('contactus') }}" class="button color2 btn-center">Contact Support</a>
  			</div>
			</div>
		</div>
  @stop

  @section('footer')
    @include('footer-top')
    @include('footer')
    @include('style-switcher')
  @stop
