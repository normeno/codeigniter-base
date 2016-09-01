<div class="row">
    <div class="col-md-12">

        <div class="form-group" style="display:none;">
            <label for="{{ $csrf['name'] }}" class="col-sm-2 control-label">CSRF</label>
            <div class="col-sm-5">
                <input type="hidden" class="form-control" name="{{ $csrf['name'] }}" value="{{ $csrf['hash'] }}">
            </div>
        </div>

        <div class="form-group">
            <label for="short_name" class="col-sm-3 control-label">{{ $ci->lang->line('short_name') }}</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="short_name" id="short_name" placeholder="{{ $ci->lang->line('short_name') }}" value="{{ set_value('short_name', isset($settings) ? $settings->short_name : '') }}">
            </div>
            <div class="col-sm-5 has-error">
                {!! form_error('short_name')  !!}
            </div>
        </div>

        <div class="form-group">
            <label for="full_name" class="col-sm-3 control-label">{{ $ci->lang->line('full_name') }}</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="full_name" id="full_name" placeholder="{{ $ci->lang->line('full_name') }}" value="{{ set_value('full_name', isset($settings) ? $settings->full_name : '') }}">
            </div>
            <div class="col-sm-5 has-error">
                {!! form_error('full_name')  !!}
            </div>
        </div>

        <div class="form-group">
            <label for="logo" class="col-sm-3 control-label">{{ $ci->lang->line('logo') }}</label>
            <div class="col-sm-4 container-logo kv-avatar center-block">
                <input type="file" class="form-control file-loading" name="logo" id="logo" placeholder="{{ $ci->lang->line('logo') }}" value="{{ set_value('logo', isset($settings) ? $settings->logo : '') }}">
            </div>
            <div class="col-sm-5 has-error">
                @if (!is_null($ci->session->userdata('error-logo')))
                    <small class="help-block">Error al subir imagen</small>
                @endif
                <?php $ci->session->unset_userdata('error-logo'); ?>
            </div>
        </div>

        <div class="form-group">
            <label for="web" class="col-sm-3 control-label">{{ $ci->lang->line('website') }}</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="website" id="website" placeholder="{{ $ci->lang->line('website') }}" value="{{ set_value('website', isset($settings) ? $settings->website : '') }}">
            </div>
            <div class="col-sm-5 has-error">
                {!! form_error('website')  !!}
            </div>
        </div>

        <div class="form-group">
            <label for="contact_email" class="col-sm-3 control-label">{{ $ci->lang->line('contact_email') }}</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="contact_email" id="contact_email" placeholder="{{ $ci->lang->line('contact_email') }}" value="{{ set_value('contact_email', isset($settings) ? $settings->contact_email : '') }}">
            </div>
            <div class="col-sm-5 has-error">
                {!! form_error('contact_email')  !!}
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $("#logo").fileinput({
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
        defaultPreviewContent: '<img src="{{ base_url('assets/img/companies/default-company.png') }}" style="width:160px">' +
                                '<h6 class="text-muted">{{ $ci->lang->line('click_to_select') }}</h6>',
        layoutTemplates: {main2: '{preview} {remove} {browse}'},
        allowedFileExtensions: ["jpg", "png", "jpeg"]
    });

</script>
@endpush