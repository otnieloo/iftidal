<div class="row align-items-end my-3">
  <div class="col-md-3">
    <label>{{ __("Name") }}</label>
  </div>
  <div class="col-md-6">
    <input type="text" class="form-control" name="name" value="{{ $customer->name ?? '' }}">
    <div></div>
  </div>
</div>

<div class="row align-items-end my-3">
  <div class="col-md-3">
    <label>{{ __("Email") }}</label>
  </div>
  <div class="col-md-6">
    <input type="email" class="form-control" name="email" value="{{ $customer->email ?? '' }}">
    <div></div>
  </div>
</div>

<div class="row align-items-end my-3">
  <div class="col-md-3">
    <label>{{ __("Status") }}</label>
  </div>
  <div class="col-md-6">
    <select name="user_status_id" class="form-control">
      @foreach ($user_statuses as $item)
        <option {{ isset($customer) && $customer->user_status_id == $item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->user_status }}</option>
      @endforeach
    </select>
    <div></div>
  </div>
</div>

<div class="row align-items-end my-3">
  <div class="col-md-3">
    <label>{{ __("Password") }}</label>
  </div>
  <div class="col-md-6">
    <input type="password" class="form-control" name="password">
    <div></div>
  </div>
</div>