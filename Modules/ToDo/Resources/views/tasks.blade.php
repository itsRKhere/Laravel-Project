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
    
    <title>Tasks</title>
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
    <div class="p-5">
        <button href="" class="btn btn-warning" data-toggle="modal" data-target="#createModal">
            Create Task
        </button>
    </div>
    <section>
        <div class="m-5">
            <table id="table" class="table table-bordered border-dark">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Created On</th>
                        <th scope="col">Assigned To</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($taskTable as $task)
                      @if($task->deleted_at === null)
                      <tr class="item{{ $task->Task_id }}">
                          <td>{{ $task->Title }}</td>
                          <td>{{ $task->Description }}</td>
                          <td>{{ $task->created_at }}</td>
                          @foreach ($users as $user)
                              @if($user->Role_name === 'Dev') 
                                @if($task['Assigned To'] === $user->id)
                                  <span class="hidden select">{{ $selected = $user->id }}</span>
                                  <td>{{ $user->firstName." ".$user->lastName }}</td>
                                @endif
                              @endif
                          @endforeach
                          <td>{{ $task->Status }}</td>
                          <td>
                              <button class="btn btn-info edit-modal" data-info="{{ $task->Title }},{{ $task->Description }},{{ $task['Assigned To'] }},{{ $task->Task_id }}" data-toggle="modal" data-target='#editModal'>Edit</button>
                              <button class="btn btn-danger normalDelete" data-info="{{  $task->Task_id }}" data-toggle="modal" data-target="#deleteModal">Delete</button>
                          </td>
                      </tr>
                      @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>

    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h3 class="modal-title">Edit</h3>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form">
                    @csrf
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="title">Title</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="title">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="desc">Description</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="desc"></textarea>
                        </div>
                    </div>
                    <div class="hidden dod"></div>
                    <div class="form-group">
                        <label class="control-label col-sm-2 w-25" for="editAssignedTo">Assigned To</label>
                        <select name="editAssignedTo" id="editAssignedTo">
                          @foreach ($users as $user)
                           @foreach ($taskTable as $task)
                            @if($user->Role_name === 'Dev') 
                              @if ($user->id === $task->id)
                                <option value="{{ $user->id }}" selected>{{ $user->firstName." ".$user->lastName }}</option>
                              @else
                                <option  value="{{ $user->id }}">{{ $user->firstName." ".$user->lastName }}</option>
                              @endif
                            @endif
                           @endforeach
                          @endforeach
                        </select>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary updateButton" data-dismiss="modal">Save changes</button>
                    </div>
                </form>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h3 class="modal-title">Create Task</h3>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form" action="{{ route("getTasksRoute") }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="title">Title</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="title" id="title">
                        </div>
                    </div>
                    <span class="text-danger">
                        @error('title')
                          {{ $message }}
                        @enderror
                      </span>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="desc">Description</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="desc" id="desc"></textarea>
                        </div>
                    </div>
                    <span class="text-danger">
                        @error('desc')
                          {{ $message }}
                        @enderror
                      </span>
                    <div class="form-group">
                        <label class="control-label col-sm-2 w-25" for="assignedTo">Assigned To</label>
                        <select name="assignedTo" id="assignedTo">
                            <option selected disabled>--Select--</option>
                            @foreach ($users as $user)
                            @if($user->Role_name === 'Dev') 
                            <option  value="{{ $user->id }}">{{ $user->firstName." ".$user->lastName }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <span class="text-danger">
                        @error('assignedTo')
                          {{ $message }}
                        @enderror
                      </span>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" id="submitButton" class="btn btn-primary submitButton">Submit</button>
                    </div>
                </form>
              </div>
          </div>
        </div>
      </div>


      <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h3 class="modal-title">Delete</h3>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form">
                    @csrf
                    <div class="form-group text-center">
                        <label class="control-label" for="title">Are you sure you want to Delete this task ? <span class="hidden did"></span> </label>
                    </div>
                    <div class="modal-footer">
                      <button id="deleteButton" type="button" class="btn btn-danger deleteButton" data-dismiss="modal" >Delete</button>
                      <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
          </div>
        </div>
      </div>


    <script type="text/javascript">
        $(document).ready(function() {
          $('#table').DataTable();
        } );

// AJAX for preview text in Edit

        $(document).on('click', '.edit-modal', function(){
            var details  = $(this).data('info').split(',');
            $('#title').val(details[0]);
            $('#desc').val(details[1]);    

            $('.dod').text(details[3]);

        });


// AJAX for delete button


        $(document).on('click', '.normalDelete', function(){
            var stuff = $(this).data('info');
            $('.did').text(stuff);
        });


        $('.modal-footer').on('click', '.deleteButton', function(){
            $.ajax({
            type: 'post',
            url: 'deleteTask',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $('.did').text()
            },success: function(data) {
                $('.item' + $('.did').text()).remove();
            }})
            });


// AJAX for Edit Task updatation

        $('.modal-footer').on('click', '.updateButton', function(){
          
            $.ajax({
            type: 'post',
            url: 'updateTask',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $('.dod').text(),
                'title': $('#title').val(),
                'desc': $('#desc').val(),
                'assignedTo': $('#editAssignedTo').val()
              },success: function(data) {
                location.reload();
            }})
            });
        
    </script>
</body>
</html>