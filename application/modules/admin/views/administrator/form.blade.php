<div class="row">
    <div class="col-md-12">

        <div class="form-group" style="display:none;">
            <label for="{{ $csrf['name'] }}" class="col-sm-2 control-label">CSRF</label>
            <div class="col-sm-5">
                <input type="hidden" class="form-control" name="{{ $csrf['name'] }}" value="{{ $csrf['hash'] }}">
            </div>
        </div>

        <div class="form-group">
            <label for="company" class="col-sm-3 control-label">{{ $ci->lang->line('company') }}</label>
            <div class="col-sm-4">
                <select name="company" id="company" class="form-control">
                    @foreach($companies as $company)
                        <option value="{{ $company->id }}" {{ (isset($user) && $user->company_id == $company->id) ? 'selected="selected"' : '' }}>{{ $company->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-5 has-error">
                {!! form_error('company')  !!}
            </div>
        </div>

        <div class="form-group">
            <label for="first_name" class="col-sm-3 control-label">{{ $ci->lang->line('first_name') }}</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="first_name" id="first_name" placeholder="{{ $ci->lang->line('first_name') }}" value="{{ set_value('first_name', isset($user) ? $user->first_name : '') }}">
            </div>
            <div class="col-sm-5 has-error">
                {!! form_error('first_name')  !!}
            </div>
        </div>

        <div class="form-group">
            <label for="last_name" class="col-sm-3 control-label">{{ $ci->lang->line('last_name') }}</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="last_name" id="last_name" placeholder="{{ $ci->lang->line('last_name') }}" value="{{ set_value('last_name', isset($user) ? $user->last_name : '') }}">
            </div>
            <div class="col-sm-5 has-error">
                {!! form_error('last_name')  !!}
            </div>
        </div>

        <div class="form-group">
            <label for="username" class="col-sm-3 control-label">{{ $ci->lang->line('username') }}</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="username" id="username" placeholder="{{ $ci->lang->line('username') }}" value="{{ set_value('username', isset($user) ? $user->username : '') }}">
            </div>
            <div class="col-sm-5 has-error">
                {!! form_error('username')  !!}
            </div>
        </div>

        <div class="form-group">
            <label for="email" class="col-sm-3 control-label">{{ $ci->lang->line('email') }}</label>
            <div class="col-sm-4">
                <input type="email" class="form-control" name="email" id="email" placeholder="{{ $ci->lang->line('email') }}" value="{{ set_value('email', isset($user) ? $user->email : '') }}">
            </div>
            <div class="col-sm-5 has-error">
                {!! form_error('email')  !!}
            </div>
        </div>

        <div class="form-group">
            <label for="avatar" class="col-sm-3 control-label">{{ $ci->lang->line('avatar') }}</label>
            <div class="col-sm-4 container-logo kv-avatar center-block">
                <input type="file" class="form-control file-loading" name="avatar" id="avatar" placeholder="{{ $ci->lang->line('avatar') }}">
            </div>
            <div class="col-sm-5 has-error">
                @if (!is_null($ci->session->userdata('error-avatar')))
                    <small class="help-block">{!! $ci->session->userdata('error-avatar') !!}</small>
                @endif
                <?php $ci->session->unset_userdata('error-avatar'); ?>
            </div>
        </div>

        <div class="form-group">
            <label for="password" class="col-sm-3 control-label">{{ $ci->lang->line('password') }}</label>
            <div class="col-sm-4">
                <input type="password" class="form-control" name="password" id="password" placeholder="{{ $ci->lang->line('password') }}">
            </div>
            <div class="col-sm-5 has-error">
                {!! form_error('password')  !!}
            </div>
        </div>

        <div class="form-group">
            <label for="confirm_password" class="col-sm-3 control-label">{{ $ci->lang->line('r_password') }}</label>
            <div class="col-sm-4">
                <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="{{ $ci->lang->line('r_password') }}">
            </div>
            <div class="col-sm-5 has-error">
                {!! form_error('confirm_password')  !!}
            </div>
        </div>

        <div class="form-group">
            <label for="phone" class="col-sm-3 control-label">{{ $ci->lang->line('phone') }}</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="phone" id="phone" placeholder="{{ $ci->lang->line('phone') }}" value="{{ set_value('phone', isset($user) ? $user->phone : '') }}">
            </div>
            <div class="col-sm-5 has-error">
                {!! form_error('phone')  !!}
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>

    var imgSource = "{{ isset($user) && !is_null($user->avatar) ? $user->avatar : 'default-user.png' }}",
            avatar = "{{ base_url('assets/img/users/') }}"+imgSource;

    $("#avatar").fileinput({
        overwriteInitial: true,
        maxFileSize: 1500,
        showClose: false,
        showCaption: false,
        showBrowse: false,
        browseOnZoneClick: true,
        removeLabel: '',
        removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
        removeTitle: '{{ $ci->lang->line('no_changes') }}',
        elErrorContainer: '#kv-avatar-errors-2',
        msgErrorClass: 'alert alert-block alert-danger',
        defaultPreviewContent: '<img src="'+avatar+'" style="width:160px">' +
        '<h6 class="text-muted">{{ $ci->lang->line('click_to_select') }}</h6>',
        layoutTemplates: {main2: '{preview} {remove} {browse}'},
        allowedFileExtensions: ["jpg", "png", "jpeg"]
    });

</script>
@endpush