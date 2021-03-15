<html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <title>EPT Result for: {{ $eptresult->code }}</title>
    <style media="screen">
    table, td, th {
        border: 1px solid black;
    }

    table {
        border-collapse: collapse;
        width: 1px;
    }
    @page { margin: 33px; margin-bottom: 0px;}
    body { margin: 0px; margin-bottom: 0px;}
    td {
        height: 1px;
    }
</style>
</head>
<body>
  <?php
    $jumlahData = $eptscore->count();
    $jumlahPage = 1;
    $mantapAnjing = 0;

    if ($jumlahData >= 95) {
      $sisa = ($jumlahData-43)%52;

      if ($sisa < 44) {
        $page = intval(floor(($jumlahData-43)/52));
      }
      elseif($sisa > 43){
        $page = intval(ceil(($jumlahData-43)/52));
      }


      $jumlahPage = $jumlahPage + $page;

      if ($sisa > 43 && $sisa <= 52) {
        $sisa = 2;
        $jumlahPage++;
        $mantapAnjing = 1;
      }
      elseif($sisa == 0){
        $sisa = 2;
        $jumlahPage++;
        $mantapAnjing = 1;
      }
      elseif ($sisa > 52) {
        $sisa = $sisa-52;
        $jumlahPage++;
        if ($sisa > 43 && $sisa <= 52) {
          $sisa = 2;
          $jumlahPage++;
          $mantapAnjing = 1;
        }
      }
      else{
        $jumlahPage++;
      }
    }
    elseif ($jumlahData > 43 && $jumlahData < 95) {
      $sisa = $jumlahData - 43;
      $jumlahPage++;

      if ($sisa > 43) {
        $sisa = 2;
        $jumlahPage++;
        $mantapAnjing = 1;
      }
    }
    elseif ($jumlahData > 34 && $jumlahData <= 43) {
      $sisa = 2;
      $jumlahPage++;
      $mantapAnjing = 1;
    }
    elseif ($jumlahData <= 34) {
      $sisa = 0;
    }

    // menghitung jumlah halaman
    $page = 1;
    $number = 1;
    // dd($jumlahPage);
    $spasi = 43-$sisa;
  ?>
  @while($page <= $jumlahPage)
    @if($page == 1)
    <div class="container">
        <table class="table table-bordered" cellpadding="0" cellspacing="0" border="0">
            <tr>
                <td width="60" style="text-align: center; justify-content: center; vertical-align:text-bottom; padding: 0px !important;"><br> <img src="{{ asset('images/basic/logounila.png') }}" style="display: block; width: 60px; height: 60px;"> <br></td>
                <td width="425" height="30" colspan="10" style="text-align: center; justify-content: center; vertical-align:middle; padding: 0px !important;"><b>MINISTRY OF RESEARCH, TECHNOLOGY AND HIGHER EDUCATION<br>UNIVERSITY OF LAMPUNG<br>LANGUAGE CENTER</b></td>
                <td width="50" height="30" style="text-align: center; justify-content: center; vertical-align:middle; padding: 0px !important;"><img src="{{ asset('images/basic/logokaniapmo.png') }}" width="80px"</td>
            </tr>
            <tr>
                <td colspan="12" height="50" style="text-align: center; justify-content: center; vertical-align:middle; padding: 0px !important;">English Proficiency Test<br>{{ $type->type }}</td>
            </tr>
            <tr>
                <td colspan="5" width="165" height="50" style="text-align: center;"><b><font size="10pt" style="font-family: arial">Document Number</b><br><font size="10pt" style="font-family: arial">{{ $eptresult->code }}</td>
                <td colspan="2" width="50" style="text-align: center;"><b><font size="10pt" style="font-family: arial">Test Date</b><br><font size="10pt" style="font-family: arial">{{ date('F d, Y', strtotime($eptresult->ept_date)) }}</td>
                <td colspan="3" width="50" style="text-align: center;"><b><font size="10pt" style="font-family: arial">Test Time</b><br><font size="10pt" style="font-family: arial">
                  @foreach($testdate as $key => $data)

                    @if($key < $testdate->count()-1)
                      {{date('H.i, ', strtotime($data->ept_time))}}
                    @else
                      {{date('H.i', strtotime($data->ept_time))}}
                    @endif

                  @endforeach
                </td>
                <td colspan="2" width="50" style="text-align: center;"><b><font size="10pt" style="font-family: arial">Supervisor</b><br><font size="10pt" style="font-family: arial">LC Unila Team</td>
            </tr>
        </table>
        <br>
        <table class="table table-bordered" cellpadding="2" cellspacing="1">
            <tr>
                <td class="text-center" style="background:#efefef; font-weight: bold; text-align: center;"><font size="9pt" style="font-family: arial">No</td>
                <td width="115" class="text-center" style="background:#efefef; font-weight: bold; text-align: center;"><font size="9pt" style="font-family: arial">Name</td>
                <td width="80" class="text-center" style="background:#efefef; font-weight: bold; text-align: center;"><font size="9pt" style="font-family: arial">NPM/NIK</td>
                <td class="text-center" style="background:#efefef; font-weight: bold; text-align: center;"><font size="9pt" style="font-family: arial">Faculty</td>
                <td width="115" class="text-center" style="background:#efefef; font-weight: bold; text-align: center;"><font size="9pt" style="font-family: arial">Major</td>
                <td class="text-center" style="background:#efefef; font-weight: bold; text-align: center;"><font size="9pt" style="font-family: arial">Attempt</td>
                <td class="text-center" style="background:#efefef; font-weight: bold; text-align: center;"><font size="9pt" style="font-family: arial">Listening</td>
                <td class="text-center" style="background:#efefef; font-weight: bold; text-align: center;"><font size="9pt" style="font-family: arial">Structure</td>
                <td class="text-center" style="background:#efefef; font-weight: bold; text-align: center;"><font size="9pt" style="font-family: arial">Reading</td>
                <td class="text-center" style="background:#efefef; font-weight: bold; text-align: center;"><font size="9pt" style="font-family: arial">Score</td>
            </tr>

            @foreach($eptscore as $key => $value)
              @if($key < 43)
              @if($mantapAnjing == 1 && $jumlahPage == 2)
                @if($key < $jumlahData-$sisa)
                <tr>
                    <td class="text-center"><font size="8pt" style="font-family: helvetica">{{ $number++ }}</td>
                    <td class="text-center"><font size="8pt" style="font-family: helvetica">{{ $value->registerept->eptparticipant->user->name }}</td>
                    <td class="text-center"><font size="8pt" style="font-family: helvetica">{{ $value->registerept->eptparticipant->idnumber_eptparticipant }}</td>
                    @if($value->registerept->eptparticipant->major != NULL)
                    <td class="text-center"><font size="8pt" style="font-family: helvetica">{{ $value->registerept->eptparticipant->major->faculty->faculty_alias }}</td>
                    <td class="text-center"><font size="8pt" style="font-family: helvetica">{{ str_limit($value->registerept->eptparticipant->major->major_name, 25, '...') }}</td>
                    @else
                    <td class="text-center"><font size="8pt" style="font-family: helvetica">-</td>
                    <td class="text-center"><font size="8pt" style="font-family: helvetica">-</td>
                    @endif
                    <td class="text-center"><font size="8pt" style="font-family: helvetica">{{ $value->registerept->attempt }}</td>
                    <td class="text-center"><font size="8pt" style="font-family: helvetica">{{ $value->listening_score }}</td>
                    <td class="text-center"><font size="8pt" style="font-family: helvetica">{{ $value->structure_score }}</td>
                    <td class="text-center"><font size="8pt" style="font-family: helvetica">{{ $value->reading_score }}</td>
                    <td class="text-center"><font size="8pt" style="font-family: helvetica">{{ $value->total_score }}</td>
                </tr>
                @elseif($key > $jumlahData-$sisa)
                  @for($d=0; $d < 43-($jumlahData-$sisa);$d++)
                  <table style="border: 1px solid white !important; border-collapse: collapse;" border="0">
                    <tr style="border: 1px solid white">
                      <td style="border: 1px solid white" colspan="10"><font size="8pt" style="font-family: helvetica; color:white;">a</td>
                    </tr>
                  </table>

                  @endfor
                @endif
              @else
              <tr>
                  <td class="text-center"><font size="8pt" style="font-family: helvetica">{{ $number++ }}</td>
                  <td class="text-center"><font size="8pt" style="font-family: helvetica">{{ $value->registerept->eptparticipant->user->name }}</td>
                  <td class="text-center"><font size="8pt" style="font-family: helvetica">{{ $value->registerept->eptparticipant->idnumber_eptparticipant }}</td>
                  @if($value->registerept->eptparticipant->major != NULL)
                  <td class="text-center"><font size="8pt" style="font-family: helvetica">{{ $value->registerept->eptparticipant->major->faculty->faculty_alias }}</td>
                  <td class="text-center"><font size="8pt" style="font-family: helvetica">{{ str_limit($value->registerept->eptparticipant->major->major_name, 25, '...') }}</td>
                  @else
                  <td class="text-center"><font size="8pt" style="font-family: helvetica">-</td>
                  <td class="text-center"><font size="8pt" style="font-family: helvetica">-</td>
                  @endif
                  <td class="text-center"><font size="8pt" style="font-family: helvetica">{{ $value->registerept->attempt }}</td>
                  <td class="text-center"><font size="8pt" style="font-family: helvetica">{{ $value->listening_score }}</td>
                  <td class="text-center"><font size="8pt" style="font-family: helvetica">{{ $value->structure_score }}</td>
                  <td class="text-center"><font size="8pt" style="font-family: helvetica">{{ $value->reading_score }}</td>
                  <td class="text-center"><font size="8pt" style="font-family: helvetica">{{ $value->total_score }}</td>
              </tr>
              @if($jumlahPage == 1 && $key == $jumlahData < 1)
                @for($d=0; $d < 35-($jumlahData);$d++)
                <table style="border: 1px solid white !important; border-collapse: collapse;" border="0">
                  <tr style="border: 1px solid white">
                    <td style="border: 1px solid white" colspan="10"><font size="8pt" style="font-family: helvetica; color:white;">a</td>
                  </tr>
                </table>
                @endfor
              @endif
              @endif
              @endif
            @endforeach
        </table><br>

        @if($jumlahPage == 1)
        <div align="right">
          <font size="8pt" style="font-family: helvetica;">
          Bandarlampung, {{ date('F d, Y', strtotime($time)) }}<br>
          Head of Language Center of Lampung University
          <br><br><br><br><br><br>
          {{ $headoflcunila->user->name }}<br>
          NIP. {{ $headoflcunila->nip_user }}<br><br><br>
        </div>
        @endif

        <!-- FOOTER -->
        <table class="table table-bordered" cellpadding="0" cellspacing="0">
            <tr>
                <td width="665px" height="60px" style="text-align: center; justify-content: center; vertical-align:middle; padding: 0px !important;"><font style="font-family: helvetica; color: #446CB3"><b><i>WE SERVE YOU THE EXCELLENT SERVICES</i></b></font>
                  <br><font size="10pt" style="font-family: helvetica">Jl. Prof. Dr. Soemantri Brodjonegoro No.1, Bandarlampung 35145 Telp. (+62) 721 770 844,<br>Fax. (+62) 721 770 844, email: <font style="color: #446CB3"><u><i>uptbahasa@kpa.unila.ac.id</u></i></font>, website: <font style="color: #446CB3"><u><i>http://lc.unila.ac.id</u></i></td>
                <td style="text-align: center; justify-content: center; vertical-align:middle; padding: 0px !important;"><img src="{{ route('ept_qrcode', $eptresult->qr_code) }}" width="60px"></td>
            </tr>
        </table>
    </div>
    <?php $page++; ?>
    @elseif($page > 1 && $page < $jumlahPage-1)
    <?php $loop = 1; ?>
    <div class="container">
      <br>
      <table class="table table-bordered" cellpadding="2" cellspacing="1">
          <tr>
              <td class="text-center" style="background:#efefef; font-weight: bold; text-align: center;"><font size="9pt" style="font-family: arial">No</td>
              <td width="115" class="text-center" style="background:#efefef; font-weight: bold; text-align: center;"><font size="9pt" style="font-family: arial">Name</td>
              <td width="80" class="text-center" style="background:#efefef; font-weight: bold; text-align: center;"><font size="9pt" style="font-family: arial">NPM/NIK</td>
              <td class="text-center" style="background:#efefef; font-weight: bold; text-align: center;"><font size="9pt" style="font-family: arial">Faculty</td>
              <td width="115" class="text-center" style="background:#efefef; font-weight: bold; text-align: center;"><font size="9pt" style="font-family: arial">Major</td>
              <td class="text-center" style="background:#efefef; font-weight: bold; text-align: center;"><font size="9pt" style="font-family: arial">Attempt</td>
              <td class="text-center" style="background:#efefef; font-weight: bold; text-align: center;"><font size="9pt" style="font-family: arial">Listening</td>
              <td class="text-center" style="background:#efefef; font-weight: bold; text-align: center;"><font size="9pt" style="font-family: arial">Structure</td>
              <td class="text-center" style="background:#efefef; font-weight: bold; text-align: center;"><font size="9pt" style="font-family: arial">Reading</td>
              <td class="text-center" style="background:#efefef; font-weight: bold; text-align: center;"><font size="9pt" style="font-family: arial">Score</td>
          </tr>
            @foreach($eptscore as $key => $value)
              @if($key >= $number-1 && $loop <= 52)
              <tr>
                  <td class="text-center"><font size="8pt" style="font-family: helvetica">{{ $number++ }}</td>
                  <td class="text-center"><font size="8pt" style="font-family: helvetica">{{ $value->registerept->eptparticipant->user->name }}</td>
                  <td class="text-center"><font size="8pt" style="font-family: helvetica">{{ $value->registerept->eptparticipant->idnumber_eptparticipant }}</td>
                  @if($value->registerept->eptparticipant->major != NULL)
                  <td class="text-center"><font size="8pt" style="font-family: helvetica">{{ $value->registerept->eptparticipant->major->faculty->faculty_alias }}</td>
                  <td class="text-center"><font size="8pt" style="font-family: helvetica">{{ str_limit($value->registerept->eptparticipant->major->major_name, 25, '...') }}</td>
                  @else
                  <td class="text-center"><font size="8pt" style="font-family: helvetica">-</td>
                  <td class="text-center"><font size="8pt" style="font-family: helvetica">-</td>
                  @endif
                  <td class="text-center"><font size="8pt" style="font-family: helvetica">{{ $value->registerept->attempt }}</td>
                  <td class="text-center"><font size="8pt" style="font-family: helvetica">{{ $value->listening_score }}</td>
                  <td class="text-center"><font size="8pt" style="font-family: helvetica">{{ $value->structure_score }}</td>
                  <td class="text-center"><font size="8pt" style="font-family: helvetica">{{ $value->reading_score }}</td>
                  <td class="text-center"><font size="8pt" style="font-family: helvetica">{{ $value->total_score }}</td>
              </tr>
              <?php
                $loop++;
              ?>
              @endif
            @endforeach
      </table><br>
        <table class="table table-bordered" cellpadding="0" cellspacing="0">
          <!--  -->
            <tr>
                <td width="665px" height="60px" style="text-align: center; justify-content: center; vertical-align:middle; padding: 0px !important;"><font style="font-family: helvetica; color: #446CB3"><b><i>WE SERVE YOU THE EXCELLENT SERVICES</i></b></font>
                  <br><font size="10pt" style="font-family: helvetica">Jl. Prof. Dr. Soemantri Brodjonegoro No.1, Bandarlampung 35145 Telp. (+62) 721 770 844,<br>Fax. (+62) 721 770 844, email: <font style="color: #446CB3"><u><i>uptbahasa@kpa.unila.ac.id</u></i></font>, website: <font style="color: #446CB3"><u><i>http://lc.unila.ac.id</u></i></td>
                <td style="text-align: center; justify-content: center; vertical-align:middle; padding: 0px !important;"><img src="{{ route('ept_qrcode', $eptresult->qr_code) }}" width="60px"</td>
            </tr>
        </table>
    </div>
    <?php $page++; ?>
    @elseif($page == $jumlahPage-1 && $mantapAnjing == 0)
    <?php $loop = 1; ?>
    <div class="container">
      <br>
      <table class="table table-bordered" cellpadding="2" cellspacing="1">
          <tr>
              <td class="text-center" style="background:#efefef; font-weight: bold; text-align: center;"><font size="9pt" style="font-family: arial">No</td>
              <td width="115" class="text-center" style="background:#efefef; font-weight: bold; text-align: center;"><font size="9pt" style="font-family: arial">Name</td>
              <td width="80" class="text-center" style="background:#efefef; font-weight: bold; text-align: center;"><font size="9pt" style="font-family: arial">NPM/NIK</td>
              <td class="text-center" style="background:#efefef; font-weight: bold; text-align: center;"><font size="9pt" style="font-family: arial">Faculty</td>
              <td width="115" class="text-center" style="background:#efefef; font-weight: bold; text-align: center;"><font size="9pt" style="font-family: arial">Major</td>
              <td class="text-center" style="background:#efefef; font-weight: bold; text-align: center;"><font size="9pt" style="font-family: arial">Attempt</td>
              <td class="text-center" style="background:#efefef; font-weight: bold; text-align: center;"><font size="9pt" style="font-family: arial">Listening</td>
              <td class="text-center" style="background:#efefef; font-weight: bold; text-align: center;"><font size="9pt" style="font-family: arial">Structure</td>
              <td class="text-center" style="background:#efefef; font-weight: bold; text-align: center;"><font size="9pt" style="font-family: arial">Reading</td>
              <td class="text-center" style="background:#efefef; font-weight: bold; text-align: center;"><font size="9pt" style="font-family: arial">Score</td>
          </tr>
            @foreach($eptscore as $key => $value)
              @if($key >= $number-1 && $loop <= 52)
              <tr>
                  <td class="text-center"><font size="8pt" style="font-family: helvetica">{{ $number++ }}</td>
                  <td class="text-center"><font size="8pt" style="font-family: helvetica">{{ $value->registerept->eptparticipant->user->name }}</td>
                  <td class="text-center"><font size="8pt" style="font-family: helvetica">{{ $value->registerept->eptparticipant->idnumber_eptparticipant }}</td>
                  @if($value->registerept->eptparticipant->major != NULL)
                  <td class="text-center"><font size="8pt" style="font-family: helvetica">{{ $value->registerept->eptparticipant->major->faculty->faculty_alias }}</td>
                  <td class="text-center"><font size="8pt" style="font-family: helvetica">{{ str_limit($value->registerept->eptparticipant->major->major_name, 25, '...') }}</td>
                  @else
                  <td class="text-center"><font size="8pt" style="font-family: helvetica">-</td>
                  <td class="text-center"><font size="8pt" style="font-family: helvetica">-</td>
                  @endif
                  <td class="text-center"><font size="8pt" style="font-family: helvetica">{{ $value->registerept->attempt }}</td>
                  <td class="text-center"><font size="8pt" style="font-family: helvetica">{{ $value->listening_score }}</td>
                  <td class="text-center"><font size="8pt" style="font-family: helvetica">{{ $value->structure_score }}</td>
                  <td class="text-center"><font size="8pt" style="font-family: helvetica">{{ $value->reading_score }}</td>
                  <td class="text-center"><font size="8pt" style="font-family: helvetica">{{ $value->total_score }}</td>
              </tr>
              <?php
                $loop++;

              ?>
              @endif
            @endforeach
      </table><br>
        <table class="table table-bordered" cellpadding="0" cellspacing="0">
          <!--  -->
            <tr>
                <td width="665px" height="60px" style="text-align: center; justify-content: center; vertical-align:middle; padding: 0px !important;"><font style="font-family: helvetica; color: #446CB3"><b><i>WE SERVE YOU THE EXCELLENT SERVICES</i></b></font>
                  <br><font size="10pt" style="font-family: helvetica">Jl. Prof. Dr. Soemantri Brodjonegoro No.1, Bandarlampung 35145 Telp. (+62) 721 770 844,<br>Fax. (+62) 721 770 844, email: <font style="color: #446CB3"><u><i>uptbahasa@kpa.unila.ac.id</u></i></font>, website: <font style="color: #446CB3"><u><i>http://lc.unila.ac.id</u></i></td>
                <td style="text-align: center; justify-content: center; vertical-align:middle; padding: 0px !important;"><img src="{{ route('ept_qrcode', $eptresult->qr_code) }}" width="60px"</td>
            </tr>
        </table>
    </div>
    <?php $page++; ?>
    @elseif($page == $jumlahPage-1 && $mantapAnjing == 1)
    <?php $pageIni=1; ?>
    <div class="container">
      <br>
      <table class="table table-bordered" cellpadding="2" cellspacing="1">
          <tr>
              <td class="text-center" style="background:#efefef; font-weight: bold; text-align: center;"><font size="9pt" style="font-family: arial">No</td>
              <td width="115" class="text-center" style="background:#efefef; font-weight: bold; text-align: center;"><font size="9pt" style="font-family: arial">Name</td>
              <td width="80" class="text-center" style="background:#efefef; font-weight: bold; text-align: center;"><font size="9pt" style="font-family: arial">NPM/NIK</td>
              <td class="text-center" style="background:#efefef; font-weight: bold; text-align: center;"><font size="9pt" style="font-family: arial">Faculty</td>
              <td width="115" class="text-center" style="background:#efefef; font-weight: bold; text-align: center;"><font size="9pt" style="font-family: arial">Major</td>
              <td class="text-center" style="background:#efefef; font-weight: bold; text-align: center;"><font size="9pt" style="font-family: arial">Attempt</td>
              <td class="text-center" style="background:#efefef; font-weight: bold; text-align: center;"><font size="9pt" style="font-family: arial">Listening</td>
              <td class="text-center" style="background:#efefef; font-weight: bold; text-align: center;"><font size="9pt" style="font-family: arial">Structure</td>
              <td class="text-center" style="background:#efefef; font-weight: bold; text-align: center;"><font size="9pt" style="font-family: arial">Reading</td>
              <td class="text-center" style="background:#efefef; font-weight: bold; text-align: center;"><font size="9pt" style="font-family: arial">Score</td>
          </tr>
            @foreach($eptscore as $key => $value)
              @if($key >= $number-1 && $key < $jumlahData-3)
              <tr>
                  <td class="text-center"><font size="8pt" style="font-family: helvetica">{{ $number++ }}</td>
                  <td class="text-center"><font size="8pt" style="font-family: helvetica">{{ $value->registerept->eptparticipant->user->name }}</td>
                  <td class="text-center"><font size="8pt" style="font-family: helvetica">{{ $value->registerept->eptparticipant->idnumber_eptparticipant }}</td>
                  @if($value->registerept->eptparticipant->major != NULL)
                  <td class="text-center"><font size="8pt" style="font-family: helvetica">{{ $value->registerept->eptparticipant->major->faculty->faculty_alias }}</td>
                  <td class="text-center"><font size="8pt" style="font-family: helvetica">{{ str_limit($value->registerept->eptparticipant->major->major_name, 25, '...') }}</td>
                  @else
                  <td class="text-center"><font size="8pt" style="font-family: helvetica">-</td>
                  <td class="text-center"><font size="8pt" style="font-family: helvetica">-</td>
                  @endif
                  <td class="text-center"><font size="8pt" style="font-family: helvetica">{{ $value->registerept->attempt }}</td>
                  <td class="text-center"><font size="8pt" style="font-family: helvetica">{{ $value->listening_score }}</td>
                  <td class="text-center"><font size="8pt" style="font-family: helvetica">{{ $value->structure_score }}</td>
                  <td class="text-center"><font size="8pt" style="font-family: helvetica">{{ $value->reading_score }}</td>
                  <td class="text-center"><font size="8pt" style="font-family: helvetica">{{ $value->total_score }}</td>
              </tr>
              <?php $pageIni++; ?>
              @endif
              @if($key == $jumlahData-3)
                @for($d=0; $d < 53-$pageIni; $d++)
                <table style="border: 1px solid white !important; border-collapse: collapse;" border="0">
                  <tr style="border: 1px solid white">
                    <td style="border: 1px solid white" colspan="10"><font size="8pt" style="font-family: helvetica; color:white;">a</td>
                  </tr>
                </table>
                @endfor
              @endif
            @endforeach
      </table><br>
        <table class="table table-bordered" cellpadding="0" cellspacing="0">
          <!--  -->
            <tr>
                <td width="665px" height="60px" style="text-align: center; justify-content: center; vertical-align:middle; padding: 0px !important;"><font style="font-family: helvetica; color: #446CB3"><b><i>WE SERVE YOU THE EXCELLENT SERVICES</i></b></font>
                  <br><font size="10pt" style="font-family: helvetica">Jl. Prof. Dr. Soemantri Brodjonegoro No.1, Bandarlampung 35145 Telp. (+62) 721 770 844,<br>Fax. (+62) 721 770 844, email: <font style="color: #446CB3"><u><i>uptbahasa@kpa.unila.ac.id</u></i></font>, website: <font style="color: #446CB3"><u><i>http://lc.unila.ac.id</u></i></td>
                <td style="text-align: center; justify-content: center; vertical-align:middle; padding: 0px !important;"><img src="{{ route('ept_qrcode', $eptresult->qr_code) }}" width="60px"</td>
            </tr>
        </table>
    </div>
    <?php $page++; ?>
    @elseif($page == $jumlahPage)
    <?php $lastData=1; ?>
    <div class="container">
      <br>
      <table class="table table-bordered" cellpadding="2" cellspacing="1">
          <tr>
              <td class="text-center" style="background:#efefef; font-weight: bold; text-align: center;"><font size="9pt" style="font-family: arial">No</td>
              <td width="115" class="text-center" style="background:#efefef; font-weight: bold; text-align: center;"><font size="9pt" style="font-family: arial">Name</td>
              <td width="80" class="text-center" style="background:#efefef; font-weight: bold; text-align: center;"><font size="9pt" style="font-family: arial">NPM/NIK</td>
              <td class="text-center" style="background:#efefef; font-weight: bold; text-align: center;"><font size="9pt" style="font-family: arial">Faculty</td>
              <td width="115" class="text-center" style="background:#efefef; font-weight: bold; text-align: center;"><font size="9pt" style="font-family: arial">Major</td>
              <td class="text-center" style="background:#efefef; font-weight: bold; text-align: center;"><font size="9pt" style="font-family: arial">Attempt</td>
              <td class="text-center" style="background:#efefef; font-weight: bold; text-align: center;"><font size="9pt" style="font-family: arial">Listening</td>
              <td class="text-center" style="background:#efefef; font-weight: bold; text-align: center;"><font size="9pt" style="font-family: arial">Structure</td>
              <td class="text-center" style="background:#efefef; font-weight: bold; text-align: center;"><font size="9pt" style="font-family: arial">Reading</td>
              <td class="text-center" style="background:#efefef; font-weight: bold; text-align: center;"><font size="9pt" style="font-family: arial">Score</td>
          </tr>

          @foreach($eptscore as $key => $value)
            @if($key >= $number-1)
            <?php $lastData++; ?>
            <tr>
                <td class="text-center"><font size="8pt" style="font-family: helvetica">{{ $number++ }}</td>
                <td class="text-center"><font size="8pt" style="font-family: helvetica">{{ $value->registerept->eptparticipant->user->name }}</td>
                <td class="text-center"><font size="8pt" style="font-family: helvetica">{{ $value->registerept->eptparticipant->idnumber_eptparticipant }}</td>
                @if($value->registerept->eptparticipant->major != NULL)
                <td class="text-center"><font size="8pt" style="font-family: helvetica">{{ $value->registerept->eptparticipant->major->faculty->faculty_alias }}</td>
                <td class="text-center"><font size="8pt" style="font-family: helvetica">{{ str_limit($value->registerept->eptparticipant->major->major_name, 25, '...') }}</td>
                @else
                <td class="text-center"><font size="8pt" style="font-family: helvetica">-</td>
                <td class="text-center"><font size="8pt" style="font-family: helvetica">-</td>
                @endif
                <td class="text-center"><font size="8pt" style="font-family: helvetica">{{ $value->registerept->attempt }}</td>
                <td class="text-center"><font size="8pt" style="font-family: helvetica">{{ $value->listening_score }}</td>
                <td class="text-center"><font size="8pt" style="font-family: helvetica">{{ $value->structure_score }}</td>
                <td class="text-center"><font size="8pt" style="font-family: helvetica">{{ $value->reading_score }}</td>
                <td class="text-center"><font size="8pt" style="font-family: helvetica">{{ $value->total_score }}</td>
            </tr>
            @endif
          @endforeach
      </table><br><br>

      @for($d=0; $d < 44-($lastData); $d++)
      <table style="border: 1px solid white !important; border-collapse: collapse;" border="0">
        <tr style="border: 1px solid white">
          <td style="border: 1px solid white" colspan="10"><font size="8pt" style="font-family: helvetica; color:white;">a</td>
        </tr>
      </table>
      @endfor

        <div align="right">
          <font size="8pt" style="font-family: helvetica;">
          Bandarlampung, {{ date('F d, Y', strtotime($time)) }}<br>
          Head of Language Center of Lampung University
          <br><br><br><br><br><br>
          {{ $headoflcunila->user->name }}<br>
          NIP. {{ $headoflcunila->nip_user }}<br><br><br>
        </div>

        <table class="table table-bordered" cellpadding="0" cellspacing="0">
          <!--  -->
            <tr>
                <td width="665px" height="60px" style="text-align: center; justify-content: center; vertical-align:middle; padding: 0px !important;"><font style="font-family: helvetica; color: #446CB3"><b><i>WE SERVE YOU THE EXCELLENT SERVICES</i></b></font>
                  <br><font size="10pt" style="font-family: helvetica">Jl. Prof. Dr. Soemantri Brodjonegoro No.1, Bandarlampung 35145 Telp. (+62) 721 770 844,<br>Fax. (+62) 721 770 844, email: <font style="color: #446CB3"><u><i>uptbahasa@kpa.unila.ac.id</u></i></font>, website: <font style="color: #446CB3"><u><i>http://lc.unila.ac.id</u></i></td>
                <td style="text-align: center; justify-content: center; vertical-align:middle; padding: 0px !important;"><img src="{{ route('ept_qrcode', $eptresult->qr_code) }}" width="60px"</td>
            </tr>
        </table>
    </div>
    <?php $page++; ?>
    @endif

@endwhile

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
</body>
</html>
