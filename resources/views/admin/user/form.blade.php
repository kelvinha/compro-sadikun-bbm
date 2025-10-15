<div class="row">
    <div class="col-md-6">
        <div class="form-group mb-3">
            {!! Form::label('name', 'Name', ['class' => 'form-label']) !!}
            {!! Form::text('name', null, [
                'class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''),
                'required' => 'required',
                'placeholder' => 'Enter full name'
            ]) !!}
            @if($errors->has('name'))
                <div class="invalid-feedback d-block">
                    {{ $errors->first('name') }}
                </div>
            @endif
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group mb-3">
            {!! Form::label('email', 'Email', ['class' => 'form-label']) !!}
            {!! Form::email('email', null, [
                'class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''),
                'required' => 'required',
                'placeholder' => 'Enter email address'
            ]) !!}
            @if($errors->has('email'))
                <div class="invalid-feedback d-block">
                    {{ $errors->first('email') }}
                </div>
            @endif
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group mb-3">
            {!! Form::label('password', 'Password', ['class' => 'form-label']) !!}
            {!! Form::password('password', [
                'class' => 'form-control' . ($errors->has('password') ? ' is-invalid' : ''),
                $formMode === 'create' ? 'required' : '',
                'placeholder' => $formMode === 'create' ? 'Enter password (min 8 characters)' : 'Leave blank to keep current password'
            ]) !!}
            @if ($formMode === 'edit')
                <small class="form-text text-muted">Leave blank to keep current password</small>
            @endif
            @if($errors->has('password'))
                <div class="invalid-feedback d-block">
                    {{ $errors->first('password') }}
                </div>
            @endif
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group mb-3">
            {!! Form::label('role_id', 'Role', ['class' => 'form-label']) !!}
            {!! Form::select('role_id', \App\Models\Role::pluck('display_name', 'id')->toArray(), null, [
                'class' => 'form-control' . ($errors->has('role_id') ? ' is-invalid' : ''),
                'required' => 'required',
                'placeholder' => 'Select Role',
            ]) !!}
            @if($errors->has('role_id'))
                <div class="invalid-feedback d-block">
                    {{ $errors->first('role_id') }}
                </div>
            @endif
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group mb-3">
            {!! Form::label('is_active', 'Status', ['class' => 'form-label']) !!}
            <div class="form-check form-switch">
                {!! Form::checkbox('is_active', 1, $formMode === 'create' ? true : null, [
                    'class' => 'form-check-input' . ($errors->has('is_active') ? ' is-invalid' : ''),
                    'id' => 'is_active',
                ]) !!}
                <label class="form-check-label" for="is_active">Active</label>
            </div>
            @if($errors->has('is_active'))
                <div class="invalid-feedback d-block">
                    {{ $errors->first('is_active') }}
                </div>
            @endif
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group mb-3">
            {!! Form::label('avatar', 'Profile Picture', ['class' => 'form-label']) !!}
            {!! Form::file('avatar', [
                'class' => 'form-control' . ($errors->has('avatar') ? ' is-invalid' : ''),
                'accept' => 'image/*'
            ]) !!}
            <small class="form-text text-muted">Accepted formats: JPG, PNG, GIF. Max size: 2MB</small>
            @if ($formMode === 'edit' && isset($user) && $user->avatar)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" class="img-thumbnail"
                        style="max-height: 100px;">
                    <small class="d-block text-muted">Current profile picture</small>
                </div>
            @endif
            @if($errors->has('avatar'))
                <div class="invalid-feedback d-block">
                    {{ $errors->first('avatar') }}
                </div>
            @endif
        </div>
    </div>
</div>

<br>
<div class="form-group" align="right">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
    {!! Form::reset('Reset', ['class' => 'btn btn-warning']) !!}
    <a href="#" onClick="javascript:history.go(-1)" class="btn btn-danger">Cancel and Back</a>
</div>
