<div class="row">
    <div class="col-md-12">

        <div class="form-group" style="display:none;">
            <label for="{{ $csrf['name'] }}" class="col-sm-2 control-label">CSRF</label>
            <div class="col-sm-5">
                <input type="hidden" class="form-control" name="{{ $csrf['name'] }}" value="{{ $csrf['hash'] }}">
            </div>
        </div>

        <div class="form-group">
            <label for="company" class="col-sm-2 control-label">Company</label>
            <div class="col-sm-5">
                <select name="company" id="company" class="form-control">
                    @foreach($companies as $company)
                        <option value="{{ $company->id }}" {{ (isset($user) && $user->company_id == $company->id) ? 'selected="selected"' : '' }}>{{ $company->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="first_name" class="col-sm-2 control-label">First Name</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name" value="{{ set_value('first_name', isset($user) ? $user->first_name : '') }}">
            </div>
        </div>

        <div class="form-group">
            <label for="last_name" class="col-sm-2 control-label">Last Name</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name" value="{{ set_value('last_name', isset($user) ? $user->last_name : '') }}">
            </div>
        </div>

        <div class="form-group">
            <label for="username" class="col-sm-2 control-label">Username</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="{{ set_value('username', isset($user) ? $user->username : '') }}">
            </div>
        </div>

        <div class="form-group">
            <label for="email" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-5">
                <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="{{ set_value('email', isset($user) ? $user->email : '') }}">
            </div>
        </div>

        <div class="form-group">
            <label for="password" class="col-sm-2 control-label">Password</label>
            <div class="col-sm-5">
                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
            </div>
        </div>

        <div class="form-group">
            <label for="confirm_password" class="col-sm-2 control-label">Confirm Password</label>
            <div class="col-sm-5">
                <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm Password">
            </div>
        </div>

        <div class="form-group">
            <label for="phone" class="col-sm-2 control-label">Phone</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone" value="{{ set_value('phone', isset($user) ? $user->phone : '') }}">
            </div>
        </div>
    </div>
</div>