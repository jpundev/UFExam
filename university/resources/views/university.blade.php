<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <link href="favicon.ico" rel="icon" />
        <link rel="stylesheet" href="/css/app.css" />

        <title>Uberflip Technical Challenge</title>
    </head>
    <body>
    <div>
            <img class="logo" src="assets/uberflip.png" alt="Logo" />
            <h2 class="header">University Domains List</h2>
        </div>

        <table class="table-auto">
            <thead>
              <tr style="background: cornflowerblue">
                <th>Name</th>
                <th>State/Province</th>
                <th>Country</th>
                <th>Alpha-2-Code</th>
                <th>Domains</th>
                <th>Web Pages</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($data as $row)
                <tr @if(count(explode(",",$row->domains)) > 1) style="background: lightblue" @endif>
                  <td>{{$row->name}}</td>
                  <td>{{$row->state_province}}</td>
                  <td>{{$row->country}}</td>
                  <td>{{$row->alpha_two_code}}</td>
                  <td>{{$row->domains}}</td>
                  <td>{{$row->web_pages}}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
    </body>
</html>