<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Role
        <small>create</small>
    </h1>

    {!! Theme::breadcrumb()->render() !!}
</section>

<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-xs-12">
            <form role="form" action="{{ route('backend.role.store.post') }}" method="post">
            <!-- general form elements disabled -->
                <div class="box box-warning">
                    {{--<div class="box-header with-border">
                        <h3 class="box-title">General Elements</h3>
                    </div><!-- /.box-header -->--}}
                    <div class="box-body">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4><i class="icon fa fa-ban"></i> Error!</h4>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                        <div class="form-group">
                            <label>Role Title</label>
                            <input type="text" class="form-control" placeholder="Role Title"  name="role_title" value="{{ old('role_title') }}">
                            <p class="help-block">Example : Reporter User</p>
                        </div>

                        <div class="form-group">
                            <label>Role Slug</label>
                            <input type="text" class="form-control" placeholder="Role Slug"  name="role_slug" value="{{ old('role_slug') }}">
                            <p class="help-block">Example : reporter_user</p>
                        </div>

                        <div class="form-group">
                            <label>Permissions</label>

                            <div class="row">
                                <div class="col-xs-12">
                                    @foreach($permissions as $permission)
                                    <div class="checkbox inline margin-r-5">
                                        <label>
                                            <input type="checkbox" name="permission[]" value="{{ $permission->id }}" <?php if (in_array($permission->id, old('permission', []))) { echo 'checked="checked"'; } ?>>
                                            {{ $permission->permission_title }}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <a href="{{ route('backend.role.index.get') }}" class="btn btn-default">Cancel</a>

                        <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-save"></i> Save</button>
                        {!! csrf_field() !!}
                    </div><!-- /.box-footer -->
                </div><!-- /.box -->
            </form>
        </div>
    </div>

</section><!-- /.content -->