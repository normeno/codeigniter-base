<div class="row">
    <div class="col-md-12">

        <div class="form-group" style="display:none;">
            <label for="{{ $csrf['name'] }}" class="col-sm-2 control-label">CSRF</label>
            <div class="col-sm-5">
                <input type="hidden" class="form-control" name="{{ $csrf['name'] }}" value="{{ $csrf['hash'] }}">
            </div>
        </div>

        <div class="form-group">
            <label for="short_name" class="col-sm-2 control-label">Short Name</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="short_name" id="short_name" placeholder="Short Name" value="{{ set_value('short_name', isset($settings) ? $settings->short_name : '') }}">
            </div>
        </div>

        <div class="form-group">
            <label for="full_name" class="col-sm-2 control-label">Full Name</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="full_name" id="full_name" placeholder="Full Name" value="{{ set_value('full_name', isset($settings) ? $settings->full_name : '') }}">
            </div>
        </div>

        <div class="form-group">
            <label for="logo" class="col-sm-2 control-label">Logo</label>
            <div class="col-sm-5 container-logo">
                <input type="file" class="form-control" name="logo" id="logo" placeholder="Logo" value="{{ set_value('logo', isset($settings) ? $settings->logo : '') }}">
            </div>
        </div>

        <div class="form-group">
            <label for="web" class="col-sm-2 control-label">Website</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="website" id="website" placeholder="Website" value="{{ set_value('website', isset($settings) ? $settings->website : '') }}">
            </div>
        </div>

        <div class="form-group">
            <label for="contact_email" class="col-sm-2 control-label">Contact Email</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="contact_email" id="contact_email" placeholder="Contact Email" value="{{ set_value('contact_email', isset($settings) ? $settings->contact_email : '') }}">
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $( function()
    {
        $("#logo").change(function(){
            readURL(this);
            var gallery = $('a[data-imagelightbox="logo-preview"]').imageLightbox();
            var image = $( '<img />' );
            gallery.addToImageLightbox( image );
        });
    });
</script>
@endpush