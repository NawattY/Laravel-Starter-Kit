<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Role
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
                        @if (Auth::user()->can('role-create'))
                        <a href="{{ route('backend.role.create.get') }}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Create role</a>
                        @endif
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>ID</th>
                            <th>Role Title</th>
                            <th>Role Slug</th>
                            <th>Manage</th>
                        </tr>
                        @forelse($roles as $role)
                            <tr>
                                <td>{{ $role->id }}</td>
                                <td>{{ $role->role_title }}</td>
                                <td>{{ $role->role_slug }}</td>
                                <td>
                                    @if (Auth::user()->can('role-update'))
                                    <a href="{{ route('backend.role.edit.get', $role->id) }}" class="btn btn-warning inline"><i class="fa fa-edit"></i> Edit</a>
                                    @endif

                                    @if (Auth::user()->can('role-delete') && $role->id != 1)
                                    <form method="post" action="{{ route('backend.role.destroy.delete', $role->id) }}" class="inline">
                                        <input type="hidden" name="_method" value="delete">
                                        {!! csrf_field() !!}
                                        <button class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i> Delete</button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Role is empty.</td>
                            </tr>
                        @endforelse
                    </table>
                </div><!-- /.box-body -->
                <div class="box-footer">
                <?php
                    $roles->appends(Input::query());
                    echo $roles->render();
                ?>
                </div><!-- /.box-footer -->
            </div><!-- /.box -->
        </div>
    </div>

</section><!-- /.content -->