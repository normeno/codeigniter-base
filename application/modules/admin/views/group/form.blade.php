<div class="row">
    <div class="col-md-12">

        <div class="form-group" style="display:none;">
            <label for="{{ $csrf['name'] }}" class="col-sm-2 control-label">CSRF</label>
            <div class="col-sm-5">
                <input type="hidden" class="form-control" name="{{ $csrf['name'] }}" value="{{ $csrf['hash'] }}">
            </div>
        </div>

        <div class="form-group">
            <label for="name" class="col-sm-3 control-label">{{ $ci->lang->line('name') }}</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="name" id="name" placeholder="{{ $ci->lang->line('name') }}" value="{{ set_value('name', isset($group) ? $group->name : '') }}">
            </div>
            <div class="col-sm-5 has-error">
                {!! form_error('name')  !!}
            </div>
        </div>

        <div class="form-group">
            <label for="description" class="col-sm-3 control-label">{{ $ci->lang->line('description') }}</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="description" id="description" placeholder="{{ $ci->lang->line('description') }}" value="{{ set_value('description', isset($group) ? $group->description : '') }}">
            </div>
            <div class="col-sm-5 has-error">
                {!! form_error('description')  !!}
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label">{{ $ci->lang->line('modules') }}</label>
            <div class="col-sm-4">
                @foreach ($modules as $module)

                    @if (empty($module['module_id']) && !isset($module['childs']))
                        <div class="top-10">
                            <input type="checkbox" name="modules[]" id="module-{{ $module['id'] }}" value="{{ $module['id'] }}"> {{ $ci->lang->line(strtolower($module['name'])) }} <br>
                        </div>
                    @elseif (empty($module['module_id']) && isset($module['childs']))
                        <div class="top-10">
                            <input type="checkbox" name="modules[]" id="module-{{ $module['id'] }}" value="{{ $module['id'] }}"> {{ $module['name'] }} <br>
                        </div>
                        @foreach ($module['childs'] as $child)
                            <div class="left-25">
                                <input type="checkbox" name="modules[]" data-parent="{{ $module['id'] }}" id="module-{{ $child['id'] }}" value="{{ $child['id'] }}"> {{ $child['name'] }} <br>
                            </div>
                        @endforeach
                    @endif
                @endforeach
            </div>
            <div class="col-sm-5 has-error">
                {!! form_error('modules')  !!}
            </div>
        </div>


    </div>
</div>

@push('scripts')
<script>

    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
            increaseArea: '20%' // optional
        });

        $('input[id*="module-"]').on('ifChecked', function(event){
            if(!$(this).attr('data-parent')) {
                $('[data-parent="'+this.value+'"]').each(function () {
                    $(this).iCheck('check');
                })
            }
        });

        $('input[id*="module-"]').on('ifUnchecked', function(event){
            if(!$(this).attr('data-parent')) {
                $('[data-parent="'+this.value+'"]').each(function () {
                    $(this).iCheck('uncheck');
                })
            }
        });
    });

</script>
@endpush