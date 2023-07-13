<!DOCTYPE html>
<html>
<head>
    <title>Tasks</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">All tasks</button>
            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Create new task</button>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            <div class="card bg-light mt-3">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col"><a href="?sort_field=status">Status</a></th>
                        <th scope="col"><a href="?sort_field=priority">Priority</a></th>
                        <th scope="col"><a href="?sort_field=created_at">Created</a></th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $task)
                        <tr>
                            <th scope="row">{{$loop->index + 1}}</th>
                            <td>{{$task->title}}</td>
                            <td>{{$task->status->title}}</td>
                            <td>{{$task->priority}}</td>
                            <td>{{$task->created_at}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
            <div class="card bg-light mt-3">
                <div class="card-body">
                    <form action="{{ route('tasks') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="text" name="title" placeholder="task title" class="form-control">
                        <textarea type="text" name="description" placeholder="description" class="form-control" rows="5" cols="33"></textarea>
                        <select class="form-select form-select-lg mb-3 form-control" name="status_id" id="statuses">
                            <option selected>Select status</option>
                            @foreach ($statuses as $status)
                            <option value="{{$status->id}}">{{$status->title}}</option>
                            @endforeach
                        </select>
                        <select class="form-select form-select-lg mb-3 form-control" name="priority">
                            <option selected>Select priority</option>
                            @for($i = 0; $i <= 10; $i++)
                            <option value="{{$i}}">{{$i}}</option>
                            @endfor
                        </select>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button class="btn btn-success">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
