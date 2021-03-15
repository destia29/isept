<html>
  <head>
    <meta charset="utf-8">
    <title> </title>
  </head>
  <body>
    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>certif_code</th>
                <th>Name</th>
                <th>NPM/NIK</th>
                <th>Faculty</th>
                <th>Major</th>
                <th>Birth Date</th>
                <th>Test Type</th>
                <th>Test Date</th>
                <th>Time</th>
                <th>Room Name</th>
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
                @foreach($eptscorelist as $data)
                <tr>
                  <td>{{ $i++ }}</td>
                  <td>{{ $data->certif_code }}</td>
                  <td>{{ $data->user_name }}</td>
                  <td>{{ $data->eptpart_idnumber }}</td>
                  @if($data->id_major != NULL)
                  <td>{{ $data->faculty_alias }}</td>
                  <td>{{ $data->major_name }}</td>
                  @else
                  <td>-</td>
                  <td>-</td>
                  @endif
                  <td>{{ $data->birthdate }}</td>
                  <td>{{ $data->type }}</td>
                  <td>{{ date('d F Y', strtotime($data->ept_eptdate)) }}</td>
                  <td align="center">{{ date('h:i A', strtotime($data->ept_epttime)) }}</td>
                  <td>{{ $data->roomname }}</td>
                  <td align="center">
                      @if($data->attempt <= 3)
                          {{ $data->attempt }}
                      @else
                          {{ $data->attempt }}
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
                        {{ $data->total_score }}
                    @else
                        {{ $data->total_score }}
                    @endif
                    @endif

                  </td>
                  <td align="center">
                      @if($data->takecourse == "Yes")
                          Yes
                      @else
                        No
                      @endif
                  </td>
                </tr>
                @endforeach
        </tbody>
    </table>
  </body>
</html>
