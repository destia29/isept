@extends('templateclunila')

@section('title')
  LCUnila | Search Announcement
@endsection

@section('main')

  @if($searcheptresult != NULL)

	<!-- PAGE HEADER -->
	<div class="page_header">
		<div class="page_header_parallax3">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h3><span>Search EPT Result</span>Take a look!<br>To see your EPT Result.</h3>
					</div>
				</div>
			</div>
		</div>
		<div class="bcrumb-wrap">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<ul class="bcrumbs">
							<li><a href="#"><i class="fa fa-home"></i> English Proficiency Test</a></li>
							<li>Search Result</li>
						</ul>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- INNER Content -->
	<div class="inner-content">
		<div class="container">
			<div class="row">
				<div class="col-md-12 blog-content">
					<div class="row">
						<div class="col-md-2 space10">
								<div class="post-media">
									<img src="{{ asset('storage/eptparticipant_photoprofile/'.$searcheptresult->eptpart_profilepicture) }}" class="img-responsive" alt="">
								</div>
								<div class="space10"></div>
								<div class="post-excerpt">
									<p align="center"><b>{{ $searcheptresult->user_name }}</b></p>
								</div>
						</div>
						<div class="col-md-3 space10">
								<h2 class="post-title-small"><a href="#">General Information</a></h2>
								<div class="space20"></div>
      					<table style="width:100%">
      						<tbody>
    								<tr>
                    @if( $searcheptresult->id_major != NULL )
    									<td width="210"><font style="font-family: helvetica; color: #446CB3">NPM</td>
                    @else
						          <td width="210"><font style="font-family: helvetica; color: #446CB3">NIK</td>
                    @endif
    									<td>:&nbsp;</td>
                      <td align="left" width="210">{{ $searcheptresult->eptpart_idnumber }}</td>
    								</tr>
    								<tr>
    									<td><font style="font-family: helvetica; color: #446CB3">Name</td>
    									<td>:</td>
                      <td align="left">{{ $searcheptresult->user_name }}</td>
    								</tr>
                    @if( $searcheptresult->id_major != NULL )
      								<tr>
      									<td><font style="font-family: helvetica; color: #446CB3">Participant Type</td>
      									<td>:</td>
                        <td align="left">
                          Unila Student
                        </td>
      								</tr>
      								<tr>
      									<td><font style="font-family: helvetica; color: #446CB3">Faculty</td>
      									<td>:</td>
                        <td align="left">{{ $searcheptresult->faculty_alias }}</td>
      								</tr>
      								<tr>
      									<td><font style="font-family: helvetica; color: #446CB3">Major</td>
      									<td>:</td>
                        <td align="left">{{ $searcheptresult->major_name }}</td>
      								</tr>
                    @else
      								<tr>
      									<td><font style="font-family: helvetica; color: #446CB3">E-mail</td>
      									<td>:</td>
                        <td align="left">{{ $searcheptresult->user_email }}</td>
      								</tr>
      								<tr>
      									<td><font style="font-family: helvetica; color: #446CB3">Participant Type</td>
      									<td style="text-align: top; justify-content: top; vertical-align:top; padding: 0px !important;">:</td>
                        <td align="left" style="text-align: top; justify-content: top; vertical-align:top; padding: 0px !important;">
                          Public
                        </td>
      								</tr>
                    @endif
      						</tbody>
      					</table>
	          </div>

						<div class="col-md-3 space10">
								<h2 class="post-title-small"><a href="#">Test Information</a></h2>
								<div class="space20"></div>
      					<table style="width:100%">
      						<tbody>
      								<tr>
      									<td width="210"><font style="font-family: helvetica; color: #446CB3">Test Type</td>
      									<td>:&nbsp;</td>
                        <td align="left" width="210">1417051032</td>
      								</tr>
      								<tr>
      									<td><font style="font-family: helvetica; color: #446CB3">Test Date</td>
      									<td>:</td>
                        <td align="left">{{ date('d F Y', strtotime($searcheptresult->ept_eptdate)) }}</td>
      								</tr>
      								<tr>
      									<td><font style="font-family: helvetica; color: #446CB3">Test Time</td>
      									<td>:</td>
                        <td align="left">{{ date('h:i A', strtotime($searcheptresult->ept_epttime)) }}</td>
      								</tr>
      								<tr>
      									<td><font style="font-family: helvetica; color: #446CB3">Attempt</td>
      									<td>:</td>
                        <td align="left">{{ $searcheptresult->attempt }}</td>
      								</tr>
      								<tr>
      									<td style="text-align: top; justify-content: top; vertical-align:top; padding: 0px !important;">
                          <font style="font-family: helvetica; color: #446CB3">Test Room</td>
      									<td style="text-align: top; justify-content: top; vertical-align:top; padding: 0px !important;">:</td>
                        <td align="left">{{ $searcheptresult->room_name }}</td>
      								</tr>
      						</tbody>
      					</table>
	          </div>

						<div class="col-md-3 space10">
								<h2 class="post-title-small"><a href="#">Test Result</a></h2>
								<div class="space20"></div>
      					<table style="width:100%">
      						<tbody>
      								<tr>
      									<td width="210"><font style="font-family: helvetica; color: #446CB3">Listening Score</td>
      									<td>:&nbsp;</td>
                        <td align="left" width="210">&nbsp;&nbsp;{{ $searcheptresult->listening_score }}</td>
      								</tr>
      								<tr>
      									<td><font style="font-family: helvetica; color: #446CB3">Structure Score</td>
      									<td>:</td>
                        <td align="left">&nbsp;&nbsp;{{ $searcheptresult->structure_score }}</td>
      								</tr>
      								<tr>
      									<td><font style="font-family: helvetica; color: #446CB3">Reading Score</td>
      									<td>:</td>
                        <td align="left">&nbsp;&nbsp;{{ $searcheptresult->reading_score }}</td>
      								</tr>
      								<tr>
      									<td><font style="font-family: helvetica; color: #446CB3"><b>EPT Score</b></td>
      									<td>:</td>
                        <td align="left">
                            @if(empty($searcheptresult->total_score))
                              -
                            @else
                              @if($searcheptresult->total_score >= 450)
                                  <font style="font-family: helvetica; color: green">{{ $searcheptresult->total_score }}
                              @else
                                  <font style="font-family: helvetica; color: red">{{ $searcheptresult->total_score }}
                              @endif
                            @endif
                        </td>
      								</tr>
      						</tbody>
      					</table>
	          </div>
					</div>
            <h2 class="post-title-small">Doc.Number: {{ $search }}</h2><br>
					<!-- End Pagination -->
				</div>
			</div>
		</div>
	</div>
  @else
  <div class="page_header">
    <div class="page_header_parallax3">
      <div class="container">
        <div class="col-md-12">
          <h3 class="text-center">EPT Result not found</h3>
        </div>
      </div>
    </div>
  </div>

  <!-- 404 ERROR CONTENT -->
  <div class="inner-content">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center error-404">
          <h2>Oops</h2><br>
          <p>Sorry, the code which you've input doesn't match with our database. Please re-input your code.</p>
        </div>
      </div>
    </div>
    <div class="search-container">
      <div class="container">
        <div class="row">
            <div class="text-center">
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
            <div class="clearfix"></div><br>
            <a href="{{ url('/') }}" class="button btn-center"><i class="icon-circle-arrow-left"></i>Back to Home</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endif

@stop

@section('footer')
  @include('footer-top')
  @include('footer')
  @include('style-switcher')
@stop
