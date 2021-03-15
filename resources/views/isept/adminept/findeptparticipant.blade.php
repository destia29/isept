@extends('templateiseptunila')

@section('title')
  ISEPT Unila | EPT Participant
@endsection
@section('navbarisept')
  @include('isept/adminept/navbaradminept')
@endsection

@section('style')
<style media="screen">
.btn-link {
   background:none!important;
   color: black;
   border:none;
   /* padding:0!important; */
   font: inherit;
   /*border is optional*/
   /* border-bottom:1px solid #444; */
   /* cursor: pointer; */
   text-decoration: none;
}

.dropdown-menu>li>button {
    padding: 6px 20px;
}
.dropdown-menu>li>button {
    display: block;
    padding: 3px 20px;
    clear: both;
    font-weight: 400;
    line-height: 1.42857143;
    color: #333;
    white-space: nowrap;
}
</style>
@endsection
@section('mainisept')


<div class="wraper container-fluid">
    <div class="page-title">
        <h3 class="title">Find EPT Participant</h3>
    </div>
    @if (count($errors) > 0)
    <div class="row">
     <div class="alert alert-danger">
      <ul>
       @foreach ($errors->all() as $error)
       <li>{{ $error }}</li>
       @endforeach
      </ul>
     </div>
    </div>
    @endif
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Operating Guide Select Date</h3>
                </div>
                <div class="panel-body">
                  <form action="{{ route('adminept.findparticipant.selectdate') }}" method="GET">
                    {{ csrf_field() }}
                    <address class="ngscope"><strong>How to find EPT Participant Selected Date.</strong></p>
                        1. First you need to select <strong> EPT Type</strong> and <strong>EPT Date</strong>.<br>
                        2. Use <span class="label label-primary" data-toggle="tooltip" data-placement="left">Find EPT Participant</span> button to search the data.
                      <br><br>
                    <div class="row">
                      <div class="col-md-8">
                        <p><strong>Choose EPT Type and Date.</strong></p>
                          <div class="btn-group m-b-10">
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <select class="form-control" name="ept_type" id="ept_type" required>
                                        <option selected disabled>- Choose EPT Type -</option>
                                        @foreach($type as $data)
                                            <option value="{{ $data->id }}">{{ $data->type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @if($page != "neweptscore")
                                  <div class="col-sm-6">
                                    <div class="input-group">
                                      <input type="text" name="ept_date" class="form-control" placeholder="Choose EPT Date" id="datepicker">
                                      <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                    </div>
                                  </div>
                                  @else
                                  <div class="col-sm-6">
                                      <select class="form-control" name="ept_date" id="ept_date">
                                          <option selected disabled>- Choose EPT Date -</option>
                                      </select>
                                  </div>
                                  @endif
                            </div>
                          </div>
                      </div>
                      <div class="col-md-4">
                        <p><strong>Find</strong></p>
                        <div class="btn-group m-b-10">
                          <div class="btn-group dropdown">
                              <button type="submit" clas s="btn btn-primary" name="type_file">Find EPT Participant</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Operating Guide Select Custom Date</h3>
                </div>
                <div class="panel-body">
                  <form action="{{ route('adminept.findparticipant.selectcustomdate') }}" method="GET">
                    <address class="ngscope"><strong>How to find EPT Participant Custom Date.</strong></p>
                        1. First you need to select <strong> EPT Type</strong> and <strong>EPT Date</strong>.<br>
                        2. Use <span class="label label-info" data-toggle="tooltip" data-placement="left">Find</span> button to search the data.
                      <br><br>
                    <div class="row">
                      <div class="col-md-10">
                        <p><strong>Choose EPT Type and Interval.</strong></p>
                          <div class="btn-group m-b-10">
                            <div class="form-group">
                                <div class="col-sm-4">
                                    <select class="form-control" name="ept_type" id="ept_type" required>
                                        <option selected disabled>- Choose EPT Type -</option>
                                        @foreach($type as $data)
                                            <option value="{{ $data->id }}">{{ $data->type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                  <div class="col-sm-4">
                                    <div class="input-group">
                                      <input type="text" name="ept_dateint1" class="form-control" placeholder="From" id="datepicker-date">
                                      <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                    </div>
                                  </div>
                                    <div class="col-sm-4">
                                      <div class="input-group">
                                        <input type="text" name="ept_dateint2" class="form-control" placeholder="Until" id="datepicker-date2">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                      </div>
                                    </div>
                                <!-- <div class="col-sm-5">
                                  <div class="input-group">
                                      <input type="text" data-mask="99/99/9999" class="form-control" placeholder="dd/mm/yyyy">
                                      <span class="help-inline"></span>
                                  </div>
                                </div> -->
                            </div>
                          </div>
                     </div>
                     <div class="col-md-2">
                       <p><strong>Find</strong></p>
                       <div class="btn-group m-b-2">
                         <div class="btn-group dropdown">
                             <button type="submit" class="btn btn-info" name="type_file">Find</button>
                         </div>
                       </div>
                     </div>
                   </div>
               </form>
            </div>
        </div>
    </div>
     <center>
        <h2><br>OR</h2><br>
        <a href="{{ url('isept/adminept/alleptparticipant') }}"><button type="button" class="btn btn-pink" name="type_file">See All EPT Participant</button></a>
     </center>
</div>



@stop
@section('script')
<script type="text/javascript">
$('#datepicker-date').datepicker();
$('#datepicker-date2').datepicker();
    $(document).ready(function() {
        $(document).on('change', '#ept_type',function(e)
        {
            var val = $(this).val();
            e.preventDefault();

            $.ajax({
            type: "POST",
            url: "{!! route('search.ept_by_type_universal') !!}", // path to function
            dataType: 'JSON',
            data: {
                "_token": "{{ csrf_token() }}",
                "val"  : val,
            },
            success: function(data){
                try{
                    var locationString = '<option selected disabled>- Choose EPT Date -</option>';
                    $.each(data.type, function (key, value) {
                          locationString += '<option value="' + value.ept_date + '">' + moment(value.ept_date).format("DD MMMM, YYYY") + '</option>';
                      });
                    $('#ept_date').html(locationString);
                }
                catch(e) {
                    alert('Exception while request..');
                }
            },
            });
        });

      });

      $(document).ready(function() {
          $(document).on('change', '#ept_type2',function(e)
          {
              var val = $(this).val();
              e.preventDefault();

              $.ajax({
              type: "POST",
              url: "{!! route('search.ept_by_type_universal') !!}", // path to function
              dataType: 'JSON',
              data: {
                  "_token": "{{ csrf_token() }}",
                  "val"  : val,
              },
              success: function(data){
                  try{
                      var locationString = '<option selected disabled>- Choose EPT Date -</option>';
                      $.each(data.type, function (key, value) {
                            locationString += '<option value="' + value.id + '">' + moment(value.ept_date).format("DD MMMM, YYYY") + '</option>';
                        });
                      $('#ept_date2').html(locationString);
                  }
                  catch(e) {
                      alert('Exception while request.. is: '+e);
                  }
              },
              });
          });

        });

  </script>
@endsection
@section('footer')
  @include('isclunila/footerisclunila')
@stop
