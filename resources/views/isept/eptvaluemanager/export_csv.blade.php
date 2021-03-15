<html>
  <head>
    <meta charset="utf-8">
    <title> </title>
  </head>
  <body>
    <table border="1">
        <thead>
            <tr>
                <th>certif_code</th>
                <th>id_registerept</th>
                <th>name</th>
                <th>idnumber_eptparticipant</th>
                <th>faculty</th>
                <th>major</th>
                <th>type_test</th>
                <th>test_date</th>
                <th>time</th>
                <th>attempt</th>
                <th>listening_score</th>
                <th>structure_score</th>
                <th>reading_score</th>
                <th>total_score</th>
                <th>takecourse</th>
            </tr>
        </thead>

        <tbody>
                <?php $i=1; ?>
                @foreach($eptscorelist as $data)
                <tr>
                  <td>{{ $data->certif_code }}</td>
                  <td>{{ $data->reg_id }}</td>
                  <td>{{ $data->user_name }}</td>
                  <td>{{ $data->eptpart_idnumber }}</td>
                  @if($data->id_major != NULL)
                  <td>{{ $data->faculty_alias }}</td>
                  <td>{{ $data->major_name }}</td>
                  @else
                  <td>-</td>
                  <td>-</td>
                  @endif
                  <td>{{ $data->type }}</td>
                  <td>{{ date('d F Y', strtotime($data->ept_eptdate)) }}</td>
                  <td align="center">{{ date('h:i A', strtotime($data->ept_epttime)) }}</td>
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
