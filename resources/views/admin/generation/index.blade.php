@extends('admin.partial.master')

@section('title')
    <title>{{ $settings->company_name }}</title>
@endsection

@section('mainsection')
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="#">Generation Manages</a>
                </li>
            </ul><!-- /.breadcrumb -->
        </div>




        <div class="page-content">


            <table class="table table-bordered" style="margin-top:10px;">
                <thead>
                    <tr>

                        <th align="center">Lavel 1</th>
                        <th>Lavel 2</th>
                        <th>Lavel 3</th>
                        <th>Lavel 4</th>
                        <th>Lavel 5</th>
                        <th>Lavel 6</th>
                        <th>Lavel 7</th>
                        <th>Lavel 8</th>
                        <th>Lavel 9</th>
                        <th>Lavel 10</th>

                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($generation as $v)
                        <tr>
                            <td>{{ $v->lavel_1 }}</td>
                            <td>{{ $v->lavel_2 }}</td>
                            <td>{{ $v->lavel_3 }}</td>
                            <td>{{ $v->lavel_4 }}</td>
                            <td>{{ $v->lavel_5 }}</td>
                            <td>{{ $v->lavel_6 }}</td>
                            <td>{{ $v->lavel_7 }}</td>
                            <td>{{ $v->lavel_8 }}</td>
                            <td>{{ $v->lavel_9 }}</td>
                            <td>{{ $v->lavel_10 }}</td>

                            <td>
                                <a href="{{ url('admin/settings/generation/edit/' . $v->id) }}"
                                    class="btn btn-xs btn-info"><i class="ace-icon fa fa-pencil bigger-120"></i></a>

                            </td>
                        </tr>
                    @endforeach



                </tbody>
            </table>



        </div><!-- /.page-content -->
    </div>
@endsection


@section('javascript')
    @if (Session::has('success'))
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Data has been saved',
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif
@endsection
