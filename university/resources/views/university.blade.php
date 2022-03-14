<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <link href="favicon.ico" rel="icon" />
        <link rel="stylesheet" href="/css/app.css" type="text/css"/>
        <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

        <title>Uberflip Technical Challenge</title>
    </head>
    <body>
      <div class= "container">
        <img class="logo" src="uberflip.png" alt="Logo" />
        <h1 class="header">University Domains List</h1>
        <table class="border-collapse border border-slate-400 hover:table-fixed" style="margin: auto">
            <thead>
              <tr style="background: cornflowerblue">
                <th>Name</th>
                <th>State / Province</th>
                <th>Country</th>
                <th>Alpha-2-Code</th>
                <th>Domains</th>
                <th>Web Pages</th>
              </tr>
            </thead>
            <tbody>
            {{-- Retreive the data and iterate --}}
              @foreach ($data as $row)
                <tr @if($row->multi_domain == 1) style="background: lightblue" @endif>
                  <td class="border border-slate-300">{{$row->name}}</td>
                  <td class="border border-slate-300">{{$row->state_province}}</td>
                  <td class="border border-slate-300">{{$row->country}}</td>
                  <td class="border border-slate-300">{{$row->alpha_two_code}}</td>
                  <td class="border border-slate-300"> 
                    @if($row->multi == 1)
                    <?=$output = str_replace(',', '<br />', $row->domains)?>
                    @else
                    {{$row->domains}}
                    @endif
                  </td>
                  <td class="border border-slate-300">
                  @if($row->multi_page == 1)
                    <?=$output = str_replace(',', '<br />', $row->web_pages)?>
                    @else
                    {{$row->web_pages}}
                    @endif
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
          {{-- Paginate the Table --}}
          <div class="row" style="width:68%; margin:auto; padding-top:1%">
            <div class="col-md-12">
                {{ $data->links('pagination::tailwind') }}
            </div>
          </div>
      </div>
    </body>
</html>