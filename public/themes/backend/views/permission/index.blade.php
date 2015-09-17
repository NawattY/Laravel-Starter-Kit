<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Permission
        <small>list</small>
    </h1>

    {!! Theme::breadcrumb()->render() !!}
</section>

<!-- Main content -->
<section class="content">

    @if (Session::has('messages'))
        @foreach (Session::get('messages') as $key => $val)
        <div class="alert alert-{{ $key }} alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                @foreach ($val as $message)
                    <p>{{ $message }}</p>
                @endforeach
        </div>
        @endforeach
    @endif

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"></h3>
                    <div class="box-tools">
                        @if (Auth::user()->can('permission-create'))
                        <a href="{{ route('backend.permission.create.get') }}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Create permission</a>
                        @endif
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>ID</th>
                            <th>Permission Title</th>
                            <th>Permission Slug</th>
                            <th>Permission Description</th>
                            <th>Manage</th>
                        </tr>
                        @forelse($permissions as $permission)
                            <tr>
                                <td>{{ $permission->id }}</td>
                                <td>{{ $permission->permission_title }}</td>
                                <td>{{ $permission->permission_slug }}</td>
                                <td>{{ $permission->permission_description }}</td>
                                <td>
                                    <a href="{{ route('backend.permission.edit.get', $permission->id) }}" class="btn btn-warning inline"><i class="fa fa-edit"></i> Edit</a>
                                    <form method="post" action="{{ route('backend.permission.destroy.delete', $permission->id) }}" class="inline">
                                        <input type="hidden" name="_method" value="delete">
                                        {!! csrf_field() !!}
                                        <button class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i> Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Permission is empty.</td>
                            </tr>
                        @endforelse
                    </table>
                </div><!-- /.box-body -->
                <div class="box-footer">
                <?php
                    $permissions->appends(Input::query());
                    echo $permissions->render();
                ?>
                </div><!-- /.box-footer -->
            </div><!-- /.box -->
        </div>
    </div>

</section><!-- /.content -->