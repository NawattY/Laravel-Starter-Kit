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
            <form role="form" action="{{ route('backend.permission.update.put', $permission->id) }}" method="post">
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
                            <label>Name</label>
                            <input type="text" class="form-control" placeholder="Name"  name="name" value="{{ old('name', $permission->name) }}">
                            <p class="help-block">Example : user-view</p>
                        </div>

                        <div class="form-group">
                            <label>Display Name</label>
                            <input type="text" class="form-control" placeholder="Display Name"  name="display_name" value="{{ old('display_name', $permission->display_name) }}">
                            <p class="help-block">Example : View User</p>
                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" rows="3" placeholder="Description" name="description">{{ old('description', $permission->description) }}</textarea>
                        </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <a href="{{ route('backend.permission.index.get') }}" class="btn btn-default">Cancel</a>

                        <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-save"></i> Save</button>
                        {!! csrf_field() !!}
                        <input type="hidden" name="_method" value="put">
                    </div><!-- /.box-footer -->
                </div><!-- /.box -->
            </form>
        </div>
    </div>

</section><!-- /.content -->