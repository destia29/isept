@extends('templateisclunila')

@section('title')
  ISLC Unila | EPT Participant
@endsection
@section('navbarisclunila')
  @include('isclunila/adminclu/navbaradminclu')
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
@section('mainisclunila')


<div class="wraper container-fluid">
    <div class="col-lg-8">
            <h3 class="title" style="text-align: left; justify-content: center; vertical-align:middle;">Find EPT Participant</h3>
    </div>
    <div class="col-lg-4"><br>
        <div class="pull-right">
              <a href="{{ url('isclunila/adminclu/addneweptparticipant') }}" class="btn btn-block btn-md btn-success">Add EPT Participant <i class="fa fa-plus"></i></a>
        </div>
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
                    <h3 class="panel-title">Operating Guide Find By Name/NPM</h3>
                </div>
                <div class="panel-body">
                    <form action="{{ route('adminlcunila.findparticipant.bynpmname') }}" method="GET">
                    <strong>How to find EPT Participant by Name/NPM.</strong></p>
                    <table>
                      <tr>
                        <td style="text-align: left; justify-content: left; vertical-align:top; padding: 0px !important;">1. &nbsp;</td>
                        <td style="text-align: left; justify-content: left; vertical-align:top; padding: 0px !important;">To find a EPT participant, you just need to input Her/His Name or NPM/NIK.</td>
                      </tr>
                      <tr>
                        <td style="text-align: left; justify-content: left; vertical-align:top; padding: 0px !important;">2. &nbsp;</td>
                        <td style="text-align: left; justify-content: left; vertical-align:top; padding: 0px !important;">Use <span class="label label-primary" data-toggle="tooltip" data-placement="left">Find EPT Participant</span> button to search the data.</td>
                      </tr>
                    </table>
                    <br>
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="col-md-3 control-label">Name/ID Number <star>*</star></label>
                            <div class="col-md-6">
                                <input type="text" name="ept_npm_name" class="form-control" placeholder="Name/NPM">
                                @if ($errors->has('idnumber_eptparticipant'))
                                <span class="help-block text-danger">
                                    {{ $errors->first('idnumber_eptparticipant') }}
                                </span>
                                @endif
                            </div>
                              <div class="col-sm-3">
                                <button type="submit" class="btn btn-primary pull-left">Find</button>
                              </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Operating Guide Select By Category</h3>
                </div>
                <div class="panel-body">
                  <form action="{{ route('adminlcunila.findparticipant.bycategory') }}" method="GET">
                    <address class="ngscope"><strong>How to find EPT Participant By Category.</strong></p>
                      <table>
                        <tr>
                          <td style="text-align: left; justify-content: left; vertical-align:top; padding: 0px !important;">1. &nbsp;</td>
                          <td style="text-align: left; justify-content: left; vertical-align:top; padding: 0px !important;">To find a EPT participant by category you can find by faculty and/or major and/or generation</td>
                        </tr>
                        <tr>
                          <td style="text-align: left; justify-content: left; vertical-align:top; padding: 0px !important;">2. &nbsp;</td>
                          <td style="text-align: left; justify-content: left; vertical-align:top; padding: 0px !important;">For the generation, you just need to input 2 last number. Example "Generation 2013rd", just input "13".</td>
                        </tr>
                        <tr>
                          <td style="text-align: left; justify-content: left; vertical-align:top; padding: 0px !important;">3. &nbsp;</td>
                          <td style="text-align: left; justify-content: left; vertical-align:top; padding: 0px !important;">Use <span class="label label-info" data-toggle="tooltip" data-placement="left">Find EPT Participant</span> button to search the data.</td>
                        </tr>
                      </table>
                    <div class="row">
                      <div class="col-md-10">
                        <p><strong>Choose Faculty, Major & Generation.</strong></p>
                          <div class="btn-group m-b-10">
                            <div class="form-group">
                                <div class="col-sm-4">
                                    <select class="form-control" id="faculty" name="id_faculty" required>
                                        <option selected disabled>-Choose Faculty -</option>
                                        @foreach($faculty as $data)
                                            <option value="{{ $data->id }}">{{ $data->faculty_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-5">
                                    <select class="form-control" id="major" name="id_major" required>
                                        <option selected disabled>- Choose Major -</option>
                                        @foreach($list_major as $data)
                                            <option value="{{ $data->id }}">{{ $data->major_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                  <div class="input-group">
                                    <input type="text" name="getgeneration" class="form-control" placeholder="ex: 13">
                                  </div>
                                </div>
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
     <!-- <center>
       <br>
        <h2><br>OR</h2><br>
        <a href="{{ route('adminlcunila.findparticipant.eptparticipant') }}"><button type="button" class="btn btn-pink" name="type_file">See All EPT Participant</button></a>
     </center> -->
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

      $(document).on('change', '#faculty',function(e)
          {
           var val = $(this).val();

           e.preventDefault();

          $.ajax({
          type: "POST",
          url: "{!! route('searcheptpart.major') !!}", // path to function
          dataType: 'JSON',
          data: {
              "_token": "{{ csrf_token() }}",
              "val"  : val,
          },
          success: function(data){
          try{
          var locationString = '';
          $.each(data, function (key, value) {
                    locationString += '<option value="' + value.id + '">' + value.major_name + '</option>';
                });
          $('#major').html(locationString);
          }catch(e) {
          alert('Exception while request..');
          }
          },
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
