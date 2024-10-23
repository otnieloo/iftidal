<div>
  <div class="row">
    <div class="col-lg-8 col-md-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Create Event</h3>
        </div>
        <div class="card-body">

          {{-- @if ($errors->any())
          <ul>
            @foreach ($errors->all() as $error)
            <li class="text-danger">{{ $error }}</li>
            @endforeach
          </ul>
          @endif --}}

          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <div class="row">
                  <div class="col-lg-2 col-md-12">
                    <label class="form-label" for="event_name">{{ __('Name Event') }}<span class="field-req">
                        *</span></label>
                  </div>
                  <div class="col-lg-10 col-md-12">
                    <input type="text" name="event_name" id="event_name" wire:model.debounce.500ms="event_name"
                      class="form-control">
                    {{-- @error('event_name')
                    {{ $message }}
                    @enderror --}}
                  </div>
                </div>
              </div>
            </div>


            <div class="col-12">
              <div class="form-group">
                <div class="row">
                  <div class="col-lg-2 col-md-12">
                    <label class="form-label" for="event_type_id">{{ __('Type of Event') }}<span class="field-req">
                        *</span></label>
                  </div>
                  <div class="col-lg-8 col-md-12">
                    <select wire:model="event_type_id" id="event_type_id" class="form-control">
                      <option value="0">Select Type Of Event</option>
                      @foreach ($event_types as $item)
                      <option value="{{ $item->id }}">{{ $item->event_type }}</option>
                      @endforeach
                    </select>
                    {{-- @error('event_type_id')
                    {{ $message }}
                    @enderror --}}
                  </div>
                </div>
              </div>
            </div>


            <div class="col-12">
              <div class="form-group">
                <div class="row">
                  <div class="col-lg-2 col-md-12">
                    <label class="form-label" for="event_date">{{ __('Date of Event') }}<span class="field-req">
                        *</span></label>
                  </div>
                  <div class="col-lg-8 col-md-12">
                    <div class="input-group">
                      <div class="input-group-text">
                        <i class="typcn typcn-calendar-outline tx-24 lh--9 op-6"></i>
                      </div>
                      <div>
                        <input type="date" class="form-control" wire:model="event_date" placeholder="Choose date">
                        {{-- @error('event_date')
                        {{ $message }}
                        @enderror --}}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-12">
              <div class="form-group">
                <div class="row">
                  <div class="col-lg-2 col-md-12">
                    <label class="form-label" for="event_type_id">{{ __('Event Period') }}<span class="field-req">
                        *</span></label>
                  </div>

                  <div class="col-lg-4 col-md-12">
                    <div class="input-group">
                      <div class="input-group-text">
                        <i class="typcn typcn-stopwatch tx-24 lh--9 op-6"></i>
                      </div>
                      <div>
                        <input type="time" wire:model="event_start_time" class="form-control" placeholder="From">
                        {{-- @error('event_start_time')
                        {{ $message }}
                        @enderror --}}
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-4 col-md-12">
                    <div class="input-group ">
                      <div class="input-group-text">
                        <i class="typcn typcn-stopwatch tx-24 lh--9 op-6"></i>
                      </div>
                      <div>
                        <input type="time" wire:model="event_end_time" class="form-control" placeholder="To">
                        {{-- @error('event_end_time')
                        {{ $message }}
                        @enderror --}}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-12">
              <div class="form-group">
                <div class="row">
                  <div class="col-lg-2 col-md-12">
                    <label class="form-label" for="event_location">{{ __('Set Location') }}<span class="field-req">
                        *</span></label>
                  </div>
                  <div class="col-lg-8 col-md-12">
                    <select wire:model="location_id" id="location_id" class="form-control">
                      <option value="0">Pick Location Address</option>
                      @foreach ($locations as $item)
                      <option value="{{ $item->id }}">{{ $item->location }}</option>
                      @endforeach
                    </select>
                    {{-- @error('location_id')
                    {{ $message }}
                    @enderror --}}
                    {{-- <div class="input-group">
                      <div class="input-group-text">
                        <i class="typcn typcn-calendar-outline tx-24 lh--9 op-6"></i>
                      </div>
                      <input type="text" class="form-control" id="event_location" name="event_location"
                        placeholder="Pick Location Address">
                    </div> --}}
                  </div>
                </div>
              </div>
            </div>



            <div class="col-12">
              <div class="form-group">
                <div class="row">
                  <div class="col-lg-2 col-md-12">
                    <label class="form-label" for="event_number_guest">{{ __('Est. Number of Guest') }}<span
                        class="field-req"> *</span></label>
                  </div>
                  <div class="col-lg-8 col-md-12">
                    <input type="text" wire:model.debounce.500ms="event_guest_count" class="form-control">
                    {{-- @error('event_guest_count')
                    {{ $message }}
                    @enderror --}}
                  </div>
                </div>
              </div>
            </div>

            <div class="col-12">
              <div class="form-group">
                <div class="row">
                  <div class="col-lg-2 col-md-12">
                    <label class="form-label" for="event_type_id">Range Budget<span class="field-req"> *</span></label>
                  </div>

                  <div class="col-lg-3 col-md-12">
                    <div class="input-group">
                      <div class="input-group-text">
                        RM
                      </div>
                      <input type="number" wire:model.debounce.500ms="event_start_budget" class="form-control ">
                    </div>
                  </div>

                  <div class="col-lg-2 text-center">
                    -
                  </div>

                  <div class="col-lg-3 col-md-12">
                    <div class="input-group ">
                      <div class="input-group-text">
                        RM
                      </div>
                      <input type="number" wire:model.debounce.500ms="event_end_budget" class="form-control ">
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-12 text-center wizzard-action">
              Reminder : Kindly double check before continue...
            </div>

            <div class="d-flex justify-content-center">
              <button type="button" class="btn btn-warning" wire:click="save" {{ $errors->any() ? 'disabled' : ''
                }}>Next</button>
            </div>

          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-4 col-md-12">
      @livewire('apps.ads.index')
      @livewire('apps.tips.index')
    </div>
  </div>

</div>