<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        User
        <small>create</small>
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
                    <form role="form" action="{{ route('backend.user.store.post') }}" method="post">
                        <div class="form-group">
                            <label>Firstname</label>
                            <input type="text" class="form-control" placeholder="Firstname"  name="first_name" value="{{ old('first_name') }}">
                        </div>

                        <div class="form-group">
                            <label>Lastname</label>
                            <input type="text" class="form-control" placeholder="Lastname"  name="last_name" value="{{ old('last_name') }}">
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}">
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" placeholder="Password" name="password">
                        </div>

                        <div class="form-group">
                            <label>Retype password</label>
                            <input type="password" class="form-control" placeholder="Retype password" name="password_confirmation">
                        </div>

                        <div class="form-group">
                            <label>Role</label>
                            <select class="form-control" name="role[]" multiple>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" <?php if (in_array($role->id, old('role', []))) { echo 'selected="selected"'; } ?>>{{ $role->role_title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn bg-navy"><i class="fa fa-save"></i> Save</button>
                            {!! csrf_field() !!}
                        </div>

                    </form>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>

</section><!-- /.content -->