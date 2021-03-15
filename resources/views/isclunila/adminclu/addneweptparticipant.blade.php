@extends('templateisclunila')

@section('title')
  ISEPT | Edit LCU Staff
@endsection
@section('navbarisclunila')
  @include('isclunila/adminclu/navbaradminclu')
@endsection
@section('mainisclunila')

<div class="wraper container-fluid">
    <div class="page-title">
        <h3 class="title">Add EPT Participant</h3>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">Add New EPT Participant Form</h3></div>
                <div class="panel-body">
                    <form class="form-horizontal p-20" action="{{ route('eptparticipant.add') }}" role="form" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="col-md-3 control-label">ID Number <star>*</star></label>
                            <div class="col-md-7">
                                <input type="text" name="idnumber_eptparticipant" class="form-control" placeholder="NIK/NPM">
                                @if ($errors->has('idnumber_eptparticipant'))
                                <span class="help-block text-danger">
                                    {{ $errors->first('idnumber_eptparticipant') }}
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-3 control-label"></label>
                          <div class="col-sm-7">
                            <button type="submit" class="btn btn-purple pull-left">Register</button>
                          </div>
                        </div>
                        <strong>*Note:</strong></p>
                        <table>
                          <tr>
                            <td style="text-align: left; justify-content: left; vertical-align:top; padding: 0px !important;">1. &nbsp;</td>
                            <td style="text-align: left; justify-content: left; vertical-align:top; padding: 0px !important;">To register a new EPT participant, you just need Her/His identification number, then click <span class="label label-purple" data-toggle="tooltip" data-placement="left" title="This is Design">Register</span>.</td>
                          </tr>
                          <tr>
                            <td style="text-align: left; justify-content: left; vertical-align:top; padding: 0px !important;">2. &nbsp;</td>
                            <td style="text-align: left; justify-content: left; vertical-align:top; padding: 0px !important;">The Username has same value based on Her/His identification number input that has been entered.<br></td>
                          </tr>
                          <tr>
                            <td style="text-align: left; justify-content: left; vertical-align:top; padding: 0px !important;">3. &nbsp;</td>
                            <td style="text-align: left; justify-content: left; vertical-align:top; padding: 0px !important;">The Default password to Login ISEPT is "lcunila".<br></td>
                          </tr>
                        </table>
                    </form>
                </div> <!-- panel-body -->
            </div> <!-- panel -->
        </div> <!-- col -->
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Operating Guide</h3>
                </div>
                <div class="panel-body">
                    <address class="ngscope"><strong>How to import New EPT Participant's Account.</strong></p>
                        1. You can import/register new EPT Participant by importing the downloaded file.<br>
                        2. The File Import must be <mark>*.csv</mark> extension and <strong>the format must be same as file which has been Downloaded</strong>.<br>
                        3. You can download the format file by using  <span class="label label-info" data-toggle="tooltip" data-placement="left" title="This is Design">Download Format File</span>.<br>
                        4. You can import/register new EPT Participant by using  <span class="label label-success" data-toggle="tooltip" data-placement="left" title="This is Design">Import EPT Participant</span>
                      <br><br>
                  <div class="row">
                      <div class="col-md-10">
                      <p><strong>Download Format File Here.</strong></p>
                        <form action="{{ route('adminlcunila.exportformatfile') }}" method="POST" enctype="multipart/form-data">
                          <div class="btn-group m-b-10">
                              {{ csrf_field() }}
                              <button class="btn btn-info">Download Format File</button>
                          </div>
                        </form>
                      <p><strong>Import EPT Score Here.</strong></p>
                        <form action="{{ route('adminlcunila.importeptparticipant') }}" method="POST" enctype="multipart/form-data">
                          <div class="btn-group m-b-10">
                              {{ csrf_field() }}
                              <input class="btn btn-default" type="file" name="file_import">
                              <button type="submit" class="btn btn-success">Import EPT Participant</button>
                          </div>
                        </form>
                      </div>
                  </div>
                </div>
            </div>
        </div>
    </div> <!-- End row -->
</div>


@stop

@section('footer')
  @include('isclunila/footerisclunila')
@stop
