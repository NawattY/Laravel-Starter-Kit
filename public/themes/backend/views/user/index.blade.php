<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        User
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
                        @if (Auth::user()->can('user-create'))
                        <a href="{{ route('backend.user.create.get') }}" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Create user</a>
                        @endif
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>ID</th>
                            <th>Firstname</th>
                            <th>Lastname</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Manage</th>
                        </tr>
                        @forelse($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->first_name }}</td>
                                <td>{{ $user->last_name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @foreach($user->roles as $role)
                                        {{ $role->role_title }}
                                    @endforeach
                                </td>
                                <td>
                                    <a href="{{ route('backend.user.edit.get', $user->id) }}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i> Edit</a>
                                    <form method="post" action="{{ route('backend.user.destroy.delete', $user->id) }}" class="form-inline">
                                        <input type="hidden" name="_method" value="delete">
                                        {!! csrf_field() !!}
                                        <button class="btn btn-sm btn-danger"><i class="fa fa-close"></i> Suspend</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">User is empty.</td>
                            </tr>
                        @endforelse
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>

</section><!-- /.content -->