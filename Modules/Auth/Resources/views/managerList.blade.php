<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
    <script src="//code.jquery.com/jquery-1.12.3.js"></script>
    <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
    
    <title>Manager List</title>
</head>
<body>
    <nav class="navbar navbar-light bg-light">
        <a href="{{ Route('welcomeRoute') }}" style="margin-left:3%;"><button class="btn btn-secondary">Back</button></a>
        <a style="float:right; margin:1%; margin-right:3%;" href="{{ Route('LogoutRoute') }}">
            <button class="btn btn-primary">Log Out</button>
        </a>
    </nav>
        <br>
    <section>
        <div class="m-5">
            <table id="table" class="table table-bordered border-dark">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Age</th>
                        <th scope="col">Email ID</th>
                        <th scope="col">Creation Date</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                        @can('isAdmin')
                        <th scope="col">Action Permission</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rows as $row)
                    @if($row->Role_name === 'Manager')
                    <tr>
                        <td>{{ $row->firstName }}</td>
                        <td>{{ $row->lastName }}</td>
                        <td>
                            @php
                                $dateOfBirth = $row->DOB;
                                $today = date("Y-m-d");
                                $diff = date_diff(date_create($dateOfBirth), date_create($today));
                            @endphp
                            {{ $diff->format('%y') }}
                        </td>
                        <td>{{ $row->emailID }}</td>
                        <td>{{ $row->created_at }}</td>
                        <td>
                            @if ($row->status == 1)
                                <span class="text-success">Active</span>
                            @else 
                                <span class="text-danger">InActive</span>
                            @endif
                        </td>
                        <td>
                        @can('isManager')
                            @if (Auth::user()->actionPermission == 1)
                                <a href="{{ Route('updateWelcomeRoute',['id'=> $row->id]) }}">
                                    @if ($row->status == 1)
                                <button class='btn btn-danger w-100'>
                                    OFF
                                    @else 
                                <button class='btn btn-success w-100'>
                                    ON
                                    @endif
                                </button>
                                </a>
                            @else
                                    @if ($row->status == 1)
                                <button class='btn btn-danger w-100' disabled>
                                    OFF
                                    @else 
                                <button class='btn btn-success w-100' disabled>
                                    ON
                                    @endif
                                </button>
                            @endif
                        @endcan
                        @can('isAdmin')
                            <a href="{{ Route('updateWelcomeRoute',['id'=> $row->id]) }}">
                                @if ($row->status == 1)
                                <button class='btn btn-danger w-100'>
                                    OFF
                                @else 
                                <button class='btn btn-success w-100'>
                                    ON
                                @endif
                                </button>
                            </a>
                        </td>
                        <td>
                        <form action="{{ Route('actionRoute',['id'=> $row->id ]) }}" method="POST">
                        @csrf
                            @if($row->actionPermission == 1)
                            <input type="checkbox" name="checkbox" value="1" checked>Choose</input>
                            @else
                            <input type="checkbox" name="checkbox" value="1" >Choose</input>
                            @endif
                                <button type="submit"class='btn btn-success saveButton' style="float: right;">
                                    Change
                                </button>
                        </form>
                        </td>
                        @endcan                    
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
</body>
</html>