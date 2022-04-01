
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 py-2">
            <div class="form-group">
                <strong>Title:</strong>
                <input type="text" name="title" class="form-control" placeholder="Title" required value="{{ $company->title ?? '' }}" />
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 py-2">
            <div class="form-group">
                <strong>Login:</strong>
                <input type="text" name="login" class="form-control" placeholder="Login" required value="{{ $company->login ?? '' }}" />
            </div>
        </div>
    </div>
