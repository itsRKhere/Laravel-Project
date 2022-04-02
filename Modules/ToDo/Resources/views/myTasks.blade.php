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
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    
    <title>Manager List</title>
</head>
<body>
    <nav class="navbar navbar-light bg-light">
        <a href="{{ Route('welcomeRoute') }}" >
            <button class="btn btn-secondary">Back</button>
        </a>
        <a href="{{ Route('LogoutRoute') }}">
            <button class="btn btn-primary">Log Out</button>
        </a>
    </nav>
        <br><br>
    <section>
        <div class="m-5">
            <table id="table" class="table table-bordered border-dark">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Created On</th>
                        <th scope="col">Assigned By</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <span class="hidden did"></span>
                    @foreach($data as $d)
                    <tr>
                        @if($d->deleted_at === null)
                        <td>{{ $d->Title }}</td>
                        <td>{{ $d->Description }}</td>
                        <td>{{ $d->created_at }}</td>
                        @foreach ($rows as $row)
                            @if($d["Assigned By"] === $row->id)
                            <td>{{ $row->firstName." ".$row->lastName }}</td>
                            @endif
                        @endforeach
                        <td>
                            <form>
                                @csrf
                            <div class="form-group" style="display:inline-block">
                                <select name="Select" id="Select{{ $d->Task_id }}">
                                    @if ($d->Status === 'To Do')
                                    <option  value="To Do" selected>To Do</option>
                                    @else
                                    <option  value="To Do">To Do</option>
                                    @endif
                                    @if ($d->Status === 'In Progress')
                                    <option  value="In Progress" selected>In Progress</option>
                                    @else
                                    <option  value="In Progress">In Progress</option>
                                    @endif
                                    @if ($d->Status === 'Hold')
                                    <option  value="Hold" selected>Hold</option>
                                    @else
                                    <option  value="Hold">Hold</option>
                                    @endif
                                    @if ($d->Status === 'Completed')
                                    <option  value="Completed" selected>Completed</option>
                                    @else
                                    <option  value="Completed">Completed</option>
                                    @endif
                                </select>
                            </div>         
                            <div class="mySave ms-2" style="display:inline-block;">
                                <button type="button" data-info="{{ $d->Task_id }}" class="btn btn-success saveStatus">Save</button>
                            </div>
                        </form> 
                        @endif
                        @endforeach
                    </td>
                </tr>
                </tbody>

    <script type="text/javascript">
        $(document).ready(function() {
          $('#table').DataTable();
        } );


//AJAX for changing status


        $('.mySave').on('click', '.saveStatus', function(){

            var stuff = $(this).data('info');
            $('.did').text(stuff);

            $.ajax({
            type: 'post',
            url: 'saveStatus',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $('.did').text(),
                'status': $('#Select' + $('.did').text()).val()
            },success: function () {
                location.reload();
      }})
        });

    </script>
</body>
</html>