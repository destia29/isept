<html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <title>My E-PIC</title>
    <style media="screen">
    table, td, th {
        border: 0px solid black;
    }

    table {
        border-collapse: collapse;
        width: 1px;
    }
    @page { margin: 15px; margin-bottom: 0px;}
    body { margin: 0px; margin-bottom: 0px;}


    td {
        height: 1px;
    }
</style>
</head>
    <body>
        <div class="container">
          @if($pic->status == "Abandoned" || $pic->status == "Unverified")
          <font size="9pt" style="font-family: helvetica">Not Available<br>
          @else
            <table class="table table-bordered" cellpadding="4.6" align="center" style="width: 20px; height: 20px; background-image:url({{ asset('images/basic/picbackground5.png') }});">
            <tr>
              <td colspan="47" rowspan="1" style="text-align: left; justify-content: left; vertical-align:middle; padding: 0px !important;"><img style="width: 510px; height: 9px;" src="{{ asset('images/basic/picheaderfooter.png') }}"></td>
            </tr>
            <tr>
              <td colspan="1" rowspan="30" style="text-align: left; justify-content: left; vertical-align:top; padding: 0px !important;"><img style="width: 9px; height: 325px;" src="{{ asset('images/basic/picside.png') }}"></td>
              <td></td>
              <td></td>
              <td></td>
              <td colspan="6" rowspan="6" style="text-align: center; justify-content: center; vertical-align:middle; padding: 0px !important;"><img style="display: block; width: 60px; height: 60px;" src="{{ asset('images/basic/logounila.png') }}"></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td colspan="1" rowspan="30" style="text-align: right; justify-content: right; vertical-align:top; padding: 0px !important;"><img style="width: 9px; height: 325px;" src="{{ asset('images/basic/picside.png') }}"></td>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td colspan="25" rowspan="4" style="text-align: left; justify-content: left; vertical-align:middle; padding: 0px !important;"><img style="width: 250px; height: 43px;" src="{{ asset('images/basic/pictitle2.png') }}"></td>
              <td colspan="10" rowspan="4" style="text-align: left; justify-content: left; vertical-align:middle; padding: 1px !important;"><img style="display: block; width: 95px; height: 28px;" src="{{ asset('images/basic/logokaniapmo.png') }}"></td>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td colspan="12" rowspan="15" style="text-align: left; justify-content: left; vertical-align:left; padding: 0px !important;"><img style="width: 129px; height: 154px;" src="{{  asset('/storage/eptparticipant_photoprofile/'. Auth::user()->eptparticipant->profile_picture) }}"></td>
              <td></td>
              <td></td>
              <td colspan="13" rowspan="2" style="text-align: left; justify-content: left; vertical-align:middle; padding: 0px !important;"><img style="width: 134px; height: 18px;" src="{{ asset('images/basic/picgeneralinfo.png') }}"></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td colspan="9" rowspan="8" style="text-align: left; justify-content: left; vertical-align:left; padding: 0px !important;">
                @if(Auth::user()->eptparticipant->id_major != NULL)
                <font size="9pt" style="font-family: helvetica">NPM<br>
                @else
                <font size="9pt" style="font-family: helvetica">NIK<br>
                @endif
                Name<br>
                Participant Type<br>
                @if(Auth::user()->eptparticipant->id_major != NULL)
                Faculty<br>
                Major<br>
                @else
                Email<br>
                Phone<br>
                @endif
                </font>
              </td>
              <td colspan="19" rowspan="8" style="text-align: left; justify-content: left; vertical-align:left; padding: 0px !important;">
                <font size="9pt" style="font-family: helvetica">: {{ Auth::user()->eptparticipant->idnumber_eptparticipant }}<br>
                : {{ Auth::user()->name }}<br>
                @if(Auth::user()->eptparticipant->id_major != NULL)
                : Unila Student<br></font>
                <font size="8pt" style="font-family: helvetica;">
                : {{ Auth::user()->eptparticipant->major->faculty->faculty_name }}<br></font>
                <font size="9pt" style="font-family: helvetica;">
                : {{ Auth::user()->eptparticipant->major->major_name }}<br></font>
                @else
                <font size="9pt" style="font-family: helvetica">
                : Public<br>
                : {{ Auth::user()->email }}<br>
                : {{ Auth::user()->eptparticipant->handphone_number }}<br>
                @endif
                </font>
              </td>
              <td></td>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td colspan="11" rowspan="2" style="text-align: left; justify-content: left; vertical-align:middle; padding: 0px !important;"><img style="width: 110px; height: 18px;" src="{{ asset('images/basic/pictestinfo.png') }}"></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td colspan="8" rowspan="8" style="text-align: left; justify-content: left; vertical-align:left; padding: 0px !important;">
                <font size="9pt" style="font-family: helvetica">Test Type<br>
                Date<br>
                Time<br>
                Attempt<br>
                Test Room<br>
                </font>
              </td>
              <td style="text-align: center; justify-content: left; vertical-align:left; padding: 0px !important;"><font size="9pt" style="font-family: helvetica">:</font></td>
              <td colspan="13" rowspan="8" style="text-align: left; justify-content: left; vertical-align:left; padding: 0px !important;">
                <font size="9pt" style="font-family: helvetica">{{ $pic->ept->type->type }}<br>
                {{ date('d F Y', strtotime($pic->ept->ept_date)) }}<br>
                {{ date('h:i A', strtotime($pic->ept->ept_time)) }}<br>
                {{ $pic->attempt }}<br></font>
                <font size="8pt" style="font-family: helvetica">
                {{ $pic->availableseat->room->room_name }}<br>
                </font>
              </td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td style="text-align: center; justify-content: left; vertical-align:left; padding: 0px !important;"><font size="9pt" style="font-family: helvetica">:</font></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td style="text-align: center; justify-content: left; vertical-align:left; padding: 0px !important;"><font size="9pt" style="font-family: helvetica">:</font></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td style="text-align: center; justify-content: left; vertical-align:left; padding: 0px !important;"><font size="9pt" style="font-family: helvetica">:</font></td>
              <td></td>
              <td colspan="6" rowspan="7"style="text-align: right; justify-content: right; vertical-align:middle; padding: 0px !important;"><img style="width: 48px; height: 48px;" src="{{ asset('storage/qr-code_participant/'.$pic->qr_code ) }}"></td>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td style="text-align: center; justify-content: left; vertical-align:left; padding: 0px !important;"><font size="9pt" style="font-family: helvetica">:</font></td>
              <td></td>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td colspan="33" rowspan="2"colspan="1" rowspan="30" style="text-align: center; justify-content: left; vertical-align:bottom; padding: 0px !important;"><img style="width: 335px; height: 22px;" src="{{ asset('images/basic/picaddressfooter.png') }}"></td>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td colspan="47" rowspan="1" style="text-align: left; justify-content: left; vertical-align:middle; padding: 0px !important;"><img style="width: 510px; height: 9px;" src="{{ asset('images/basic/picheaderfooter.png') }}"></td>
            </tr>
            </table>
        </div>
        @endif
        <!-- Optional JavaScript -->
        <!-- jQuery first, tden Popper.js, tden Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
    </body>
</html>
