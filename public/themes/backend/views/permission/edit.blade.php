<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Permission
        <small>edit</small>
    </h1>

    {!! Theme::breadcrumb()->render() !!}
</section>

<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-xs-12">
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
                    <form role="form" action="{{ route('backend.permission.update.put', $permission->id) }}" method="post">
                        <div class="form-group">
                            <label>Permission Title</label>
                            <input type="text" class="form-control" placeholder="Permission Title"  name="permission_title" value="{{ old('permission_title', $permission->permission_title) }}">
                            <p class="help-block">Example : View User</p>
                        </div>

                        <div class="form-group">
                            <label>Permission Slug</label>
                            <input type="text" class="form-control" placeholder="Permission Slug"  name="permission_slug" value="{{ old('permission_slug', $permission->permission_slug) }}">
                            <p class="help-block">Example : user-view</p>
                        </div>

                        <div class="form-group">
                            <label>Permission Description</label>
                            <textarea class="form-control" rows="3" placeholder="Permission Description" name="permission_description">{{ old('permission_description', $permission->permission_description) }}</textarea>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn bg-navy"><i class="fa fa-save"></i> Save</button>
                            {!! csrf_field() !!}
                            <input type="hidden" name="_method" value="put">
                        </div>

                    </form>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>

</section><!-- /.content -->