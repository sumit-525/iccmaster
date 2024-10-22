<style type="text/css">
    .select2-container {
        z-index: 100000;
    }
</style>

<form action="{{ Route('settings.roles.store_member') }}" method="post" class="yohrm-ajax-form"
    data-modal-form="#yohrm-modal" data-redirect-url ="settings.roles" autocomplete ="off">
    @csrf
    <input type="hidden" name="id" value="{{ $role_id }}" />
    <div class="row">
        <div class="col-md-4">
            <label for="first-name-horizontal" class="required">{{ __('Select Employee')}}</label>
        </div>
        <div class="col-md-8 form-group">

            <select class="select-custom form-control" name="users[]">
                <option value=""> {{__('Select Member')}} </option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}"> {{ ucwords($user->name) }}</option>
                @endforeach
            </select>
            <small class="text-danger">
                @error('name')
                    {{ $message }}
                @enderror
            </small>
        </div>

        <div class="col-sm-12 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary me-1 mb-1">{{__('Submit')}}</button>
            <button type="reset" class="btn btn-light-secondary me-1 mb-1">{{__('Reset')}}</button>
        </div>
    </div>
</form>


