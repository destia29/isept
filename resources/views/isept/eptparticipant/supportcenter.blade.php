@extends('templateiseptunila')

@section('title')
  ISEPT Unila | Support Center
@endsection
@section('navbarisept')
  @include('isept/eptparticipant/navbareptparticipant')
@endsection
@section('mainisept')
@include('supportcenter_termpolicies')
    <div class="col-lg-6">
      <h4 class="title">Frequent Ask Questions (FAQ)</h4>
        <div class="panel-group" id="accordion-test-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapseOne-2" aria-expanded="false" class="collapsed">
                            How to Register an EPT? #1
                        </a>
                    </h4>
                </div>
                <div id="collapseOne-2" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ol>
                            <li>After you logged in to ISEPT, You need to fill up your biodata in Profile Menu.<br>My Profile -> Settings </li>
                            <li>Next, go to the Register EPT Menu, re-check your personal data in Register Form.</li>
                            <li>Then, choose the EPT Type, Test Date, and Test Time which is available.</li>
                            <li>If success, you need to pay the EPT cost at Language Center of Unila. Our admin will be verified your payment</li>
                            <li>Once your payment is verified, you can view and download your Electronic Participant Identification Card(E-PIC)</li>
                            <li>No Need to Print!, you can just show your e-PIC in your smartphone and your ID Card such as KTM, KTP, SIM, or Passport
                              when you entering the Test Room.</li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapseTwo-2" class="collapsed" aria-expanded="false">
                            Why I can't register EPT? #2
                        </a>
                    </h4>
                </div>
                <div id="collapseTwo-2" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <ol>
                            <li>Register form not filled completely</li>
                            <li>Your Profile Picture is too big or the extension file is wrong, the extension must be .jpg, .jpeg, .png</li>
                            <li>You already have registered at that that before.</li>
                            <li>The room is not available or the quota is full at that time/date.</li>
                            <li>You have failed the EPT 3 times (your score < 450).</li>
                            <li>You have abandoned the test for more than 2 times.</li>
                            <li>You are a Non Active User.</li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapseThree-2" class="collapsed" aria-expanded="false">
                            How to Re-Active My Account? #3
                        </a>
                    </h4>
                </div>
                <div id="collapseThree-2" class="panel-collapse collapse">
                    <div class="panel-body">
                      Once you've placed to a Nonactive user, you can't register a new English Proficiency Test.<br>
                      To Re-active your account you need to visit Language Center of Unila or <a href="{{ url('contactus') }}" class="alert-link" target="_blank">Contact Us</a>.
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapseFour-2" class="collapsed" aria-expanded="false">
                            How to see my EPT Score/Result?  #4
                        </a>
                    </h4>
                </div>
                <div id="collapseFour-2" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ol>
                            <li>You can now your EPT Score in the My EPT Score Menu</li>
                            <li>You can also check your EPT Result at Web Portal's Language Center of Unila at Service Menu-> English Proficiency Test, by inputing certificate number in your e-PIC Qrcode or EPT certificate.</li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapseFive-2" class="collapsed" aria-expanded="false">
                            How can I Know that My EPT Certificate is Genuine?  #5
                        </a>
                    </h4>
                </div>
                <div id="collapseFive-2" class="panel-collapse collapse">
                    <div class="panel-body">
                        You can check the originality of your EPT Certificate at Web Portal's Language Center of Unila at Service Menu-> English Proficiency Test, by inputing certificate number in your EPT certificate.<br>
                        If the code matches with our database, that means your EPT Certificate is Original.
                    </div>
                </div>
            </div>
        </div>
    </div>

</div> <!-- End row -->

@stop

@section('footer')
  @include('isept/footerisept')
@stop
