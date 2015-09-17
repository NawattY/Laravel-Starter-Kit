<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Permission
        <small>create</small>
    </h1>

    {!! Theme::breadcrumb()->render() !!}
</section>

<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-xs-12">
            <form role="form" action="{{ route('backend.permission.store.post') }}" method="post">
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
                            <label>Permission Title</label>
                            <input type="text" class="form-control" placeholder="Permission Title"  name="permission_title" value="{{ old('permission_title') }}">
                            <p class="help-block">Example : View User</p>
                        </div>

                        <div class="form-group">
                            <label>Permission Slug</label>
                            <input type="text" class="form-control" placeholder="Permission Slug"  name="permission_slug" value="{{ old('permission_slug') }}">
                            <p class="help-block">Example : user-view</p>
                        </div>

                        <div class="form-group">
                            <label>Permission Description</label>
                            <textarea class="form-control" rows="3" placeholder="Permission Description" name="permission_description">{{ old('permission_description') }}</textarea>
                        </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <a href="{{ route('backend.permission.index.get') }}" class="btn btn-default">Cancel</a>

                        <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-save"></i> Save</button>
                        {!! csrf_field() !!}
                    </div><!-- /.box-footer -->
                </div><!-- /.box -->
            </form>
        </div>
    </div>

</section><!-- /.content -->