@extends('templateisclunila')

@section('title')
  ISLCUnila | EPT Score
@endsection
@section('navbarisclunila')
  @include('isclunila/chiefoftheboard/navbarchiefoftheboard')
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
    <div class="page-title">
        <h3 class="title">EPT Score</h3>
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
                    <h3 class="panel-title">Operating Guide</h3>
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
                <div class="panel-body">
                @if($page != "neweptscore")
                  <form action="{{ route('eptresult.exportexcelselected') }}" method="POST">
                @else
                  <form action="{{ route('eptresult.exportexcel') }}" method="POST">
                @endif
                    {{ csrf_field() }}
                    <address class="ngscope"><strong>How to export EPT Score to Excel file.</strong></p>
                        1. First you need to select <strong> EPT Type</strong> and <strong>EPT Date</strong>.<br>
                        2. Use <span class="label label-primary" data-toggle="tooltip" data-placement="left" title="This is Design">Export to Excel</span> button to download the data.<br>
                        <i class="text-danger">*Note: Never change Participant's NPM/NIK</i>
                      <br><br>
                    <div class="row">
                      <div class="col-md-8">
                        <p><strong>Choose EPT Type and Date.</strong></p>
                          <div class="btn-group m-b-10">
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <select class="form-control" name="ept_type" id="ept_type">
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
                      <p><strong>Export EPT Score Here.</strong></p>
                        <div class="btn-group m-b-10">
                          <div class="btn-group dropdown">
                              <button type="submit" class="btn btn-primary" name="type_file" value="csv">Export to Excel</button>
                              <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="caret"></i></button>
                              <ul class="dropdown-menu" role="menu">
                                <li><button type="submit" name="type_file" value="csv" class="btn-link">Tipe file <b>*.csv</b></button>  </li>
                                <li class="divider"></li>
                                <li><button type="submit" name="type_file" value="xls" class="btn-link">Tipe file <b>*.xls</b></button>  </li>

                              </ul>
                            </div>
                          </div>
                        </div>
                    </form>
                  </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Operating Guide</h3>
                </div>
                <div class="panel-body">
                @if($page != "neweptscore")
                  <form action="{{ route('isept.vieweptresultselected') }}" method="POST">
                @else
                  <form action="{{ route('isept.vieweptresult') }}" method="POST">
                @endif
                    {{ csrf_field() }}
                    <address class="ngscope"><strong>How to export EPT Score to PDF file.</strong></p>
                        1. First you need to select <strong> EPT Type</strong> and <strong>EPT Date</strong>.<br>
                        2. Use <span class="label label-info" data-toggle="tooltip" data-placement="left" title="This is Design">Export to PDF</span> button to download the data.<br>
                      <br><br>
                    <div class="row">
                      <div class="col-md-8">
                        <p><strong>Choose EPT Type and Date.</strong></p>
                          <div class="btn-group m-b-10">
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <select class="form-control" name="ept_type2" id="ept_type2">
                                        <option selected disabled>- Choose EPT Type -</option>
                                        @foreach($type as $data)
                                            <option value="{{ $data->id }}">{{ $data->type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @if($page != "neweptscore")
                                  <div class="col-sm-6">
                                    <div class="input-group">
                                      <input type="text" name="ept_date2" class="form-control" placeholder="Choose EPT Date" id="datepicker-multiple">
                                      <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                    </div>
                                  </div>
                                  @else
                                  <div class="col-sm-6">
                                      <select class="form-control" name="ept_date2" id="ept_date2">
                                          <option selected disabled>- Choose EPT Date -</option>
                                      </select>
                                  </div>
                                  @endif
                               </div>
                          </div>
                      </div>
                      <div class="col-md-4">
                      <p><strong>Export EPT Score Here.</strong></p>
                        <div class="btn-group m-b-10">
                          <div class="btn-group dropdown">
                              <button type="submit" class="btn btn-info">Export to PDF</button>
                          </div>
                        </div>
                      </div>
                    </form>
                 </div>
              </div>
            </div>
        </div>
    </div>
    <div class="row">
      <div class="col-md-12">
          <div class="panel panel-default">
              <div class="panel-heading">
                  <h3 class="panel-title">List Table</h3>
              </div>
              <div class="panel-body">
                  <div class="row">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                          <table id="datatable" class="table table-striped table-bordered">
                              <thead>
                                  <tr>
                                      <th>No</th>
                                      <th>Name</th>
                                      <th>NPM/NIK</th>
                                      <th>Faculty</th>
                                      <th>Major</th>
                                      <th>Test Type</th>
                                      <th>Test Date</th>
                                      <th>Time</th>
                                      <th>Attempt</th>
                                      <th>Listening</th>
                                      <th>Structure</th>
                                      <th>Reading</th>
                                      <th>EPT Score</th>
                                      <th>Take Course</th>
                                  </tr>
                              </thead>

                              <tbody>
                                      <?php $i=1; ?>
                                      @foreach($eptscore as $data)
                      								<tr>
                      									<td>{{ $i++ }}</td>
                      									<td>{{ $data->name }}</td>
                      									<td>{{ $data->idnumber_eptparticipant }}</td>
                                        @if($data->id_major != NULL)
                      									<td>{{ $data->faculty_name }}</td>
                      									<td>{{ $data->major_name }}</td>
                                        @else
                      									<td>-</td>
                      									<td>-</td>
                                        @endif
                      									<td>{{ $data->type }}</td>
                      									<td>{{ date('d F Y', strtotime($data->ept_date)) }}</td>
                      									<td align="center">{{ $data->ept_time }}</td>
                      									<td align="center">
                                            @if($data->attempt <= 3)
                                                <p style="color:green">{{ $data->attempt }}</p>
                                            @else
                                                <p style="color:red">{{ $data->attempt }}</p>
                                            @endif
                                        </td>
                                        <td align="center">
                                          @if(empty($data->listening_score))
                                            -
                                          @else
                                            {{ $data->listening_score }}
                                          @endif
                                        </td>
                      									<td align="center">
                                          @if(empty($data->structure_score))
                                            -
                                          @else
                                            {{ $data->structure_score }}
                                          @endif
                                        </td>
                      									<td align="center">
                                          @if(empty($data->reading_score))
                                            -
                                          @else
                                            {{ $data->reading_score }}
                                          @endif
                                        </td>
                      									<td align="center">
                                          @if(empty($data->total_score))
                                            -
                                          @else
                                            @if($data->total_score >= 450)
                                                <p style="color:green">{{ $data->total_score }}</p>
                                            @else
                                                <p style="color:red">{{ $data->total_score }}</p>
                                            @endif
                                          @endif
                                        </td>
                                        <td align="center">
                                            @if($data->takecourse == "Yes")
                                                <p style="color:DodgerBlue">Yes</p>
                                            @else
                                                <p style="color:red">No</p>
                                            @endif
                                        </td>
                      								</tr>
                                      @endforeach
                              </tbody>
                          </table>

                      </div>
                  </div>
              </div>
          </div>
      </div>

  </div> <!-- End Row -->
</div>



@stop
@section('script')
<script type="text/javascript">
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
