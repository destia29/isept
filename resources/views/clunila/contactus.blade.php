@extends('templateclunila')

@section('title')
  LCUnila | Contact Us
@endsection

@section('main')
	<!-- PAGE HEADER -->
	<div class="page_header">
		<div class="page_header_parallax">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h3><span>Contact Us</span>Stay Close</h3>
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
							<li>Contact Us</li>
						</ul>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>
	</div>

  	<!-- INNER CONTENT -->
  	<div class="inner-content">
  		<div class="container">
  			<div class="row">
  				<div class="col-md-8 margin30">
  					<p align="justify">If you have a question about our service or want to give us your feedback, feel free to contact us by email, phone, or visit our headquearters. We would also love to hear from you! Please fill out the form below and we will get in touch with you as quickly as we can.</p>
  					<div class="form-contact">
  						<div class="required">
  							<p>( <span style="color:red">*</span> fields are required )</p>
  						</div>
  						<form name="sentMessage" role="form" id="contactForm" action="{{ route('message.create') }}" method="POST">
                {{ csrf_field() }}
  							<div class="row">
  								<div class="col-md-6">
  									<div class="row control-group">
  										<div class="form-group col-xs-12 controls">
  											<label>Name <span style="color:red">*</span></label>
  											<input class="form-control" placeholder="Name" id="name" name="name" required="" data-validation-required-message="Please enter your name." type="text">
  											<p class="help-block"></p>
                            @if ($errors->has('name'))
                            <span class="help-block text-danger">
                                {{ $errors->first('name') }}
                            </span>
                            @endif
  										</div>
  									</div>
  								</div>
  								<div class="col-md-6">
  									<div class="row control-group">
  										<div class="form-group col-xs-12 controls">
  											<label>Email Address <span style="color:red">*</span></label>
  											<input class="form-control" placeholder="Email Address" id="email" name="email" required="" data-validation-required-message="Please enter your email address." type="email">
  											<p class="help-block"></p>
                            @if ($errors->has('email'))
                            <span class="help-block text-danger">
                                {{ $errors->first('email') }}
                            </span>
                            @endif
  										</div>
  									</div>
  								</div>
  							</div>
  							<div class="row control-group">
  								<div class="form-group col-xs-12  controls">
  									<label>Subject <span style="color:red">*</span></label>
  									<input class="form-control" placeholder="Subject" id="subject" name="subject" required="" data-validation-required-message="Please enter your subject message.">
  									<p class="help-block"></p>
                        @if ($errors->has('subject'))
                        <span class="help-block text-danger">
                            {{ $errors->first('subject') }}
                        </span>
                        @endif
  								</div>
  							</div>
  							<div class="row control-group">
  								<div class="form-group col-xs-12 controls">
  									<label>Message <span style="color:red">*</span></label>
  									<textarea rows="5" class="form-control" placeholder="Message" name="message" id="message" required="" data-validation-required-message="Please enter your message detail."></textarea>
  									<p class="help-block"></p>
                        @if ($errors->has('message'))
                        <span class="help-block text-danger">
                            {{ $errors->first('message') }}
                        </span>
                        @endif
  								</div>
  							</div>
  							<br>
  							<div class="row">
  								<div class="form-group col-xs-12">
  									<button type="submit" class="button btn-lg">Send Message</button>
  								</div>
  							</div>
  						</form>
  					</div>
  					<!--contact form-->
  				</div>
  				<div class="col-md-4">
  					<div class="map-border">
  						<div id="map-greyscale">
              </div>
  					</div>
  					<div class="space50"></div>
  					<h3 class="no-margin">Contact info</h3>
  					<div class="space20"></div>
  					<ul class="contact-info">
  						<li>
  							<p><strong><i class="fa fa-map-marker"></i></strong> Jl. Prof. Dr. Sumantri Brojonegoro<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No. 1 Bandar Lampung<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;35145 - Indonesia</p>
  						</li>
  						<li>
  							<p><strong><i class="fa fa-envelope"></i></strong> <a href="#">uptbahasa@kpa.unila.ac.id</a></p>
  						</li>
  						<li>
  							<p><strong><i class="fa fa-phone"></i></strong> (+62) 721 770 844</p>
  						</li>
  						<li>
  							<p><strong><i class="fa fa-facebook"></i></strong> @balaibahasauniversitaslampung</p>
  						</li>
  					</ul>
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
