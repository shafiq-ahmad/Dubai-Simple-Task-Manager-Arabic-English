
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 py-2">
            <div class="form-group">
                <strong>Company:</strong>
                <select name="company_id" class="form-control" required>
					<option value="">Select ...</option>
					@foreach($companies as $c)
						<option value="{{ $c['id'] }}" 
						@if(isset($project->company_id ) && $project->company_id == $c['id'])
						 selected="selected"
						@endif >{{ $c['title'] }}</option>
					@endforeach
				</select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 py-2">
            <div class="form-group">
                <strong>Title:</strong>
                <input type="text" name="title" class="form-control" placeholder="Title" required value="{{ $project->title ?? '' }}" />
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 py-2">
            <div class="form-group">
                <strong>Deadline:</strong>
                <input type="date" name="deadline" class="form-control" required value="{{ $project->deadline ?? '' }}" />
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 py-2">
            <div class="form-group">
                <strong>Description:</strong>
                <textarea type="date" name="desc" rows="5" style="width:100%;">{{ $project->desc ?? '' }}</textarea>
            </div>
        </div>
    </div>

