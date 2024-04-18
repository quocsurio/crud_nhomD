<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD NhómD</title>
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if (session('status'))
                <h5 class="alert alert-success">{{session('status')}}</h5>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h3>laravel CRUD teamD <a href="{{ route('student.add')}}" class="btn btn-primary float-end">Thêm Sinh Viên</a></h3>

                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <th>ID</th>
                                <th>Tên</th>
                                <th>Email</th>
                                <th>Lớp</th>
                                <th>Ảnh đại diện</th>
                                <th>Thao tác</th>
                            </thead>
                            <tbody>
                                @foreach($student as $student)
                                <tr>
                                    <td>{{$student->id}}</td>
                                    <td>{{$student->ten}}</td>
                                    <td>{{$student->email}}</td>
                                    <td>{{$student->lop}}</td>
                                    <td><img src="{{asset('uploads/student/'.$student->anhdaidien)}}" width="70px" height="70px" alt="Ảnh đại diện"></td>
                                    <td>
                                        <a href="{{ route('student.edit', ['id' => $student->id]) }}" class="btn btn-primary">Sửa</a>
                                        <a href="{{ route('student.update', ['id' => $student->id]) }}" class="btn btn-primary">Xóa</a>
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>