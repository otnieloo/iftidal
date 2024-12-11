<div class="row">
  <div class="col-lg-8 col-md-12">
    <div class="alert alert-warning d-none" id="sectionValidationError">
    </div>

    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Create Event</h3>
      </div>
      <div class="card-body">


        <div class="row">
          <div class="col-12">
            <div class="form-group">
              <div class="row">
                <div class="col-lg-2 col-md-12">
                  <label class="form-label" for="event_name">{{ __('Name Event') }}<span class="field-req">
                      *</span></label>
                </div>
                <div class="col-lg-10 col-md-12">
                  <input type="text" name="event_name" id="event_name" value="{{ $event->event_name ?? '' }}"
                    class="form-control">
                  <div></div>
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
                  <select name="event_type_id" id="event_type_id" class="form-control">
                    <option value="">Select Type Of Event</option>
                    @foreach ($event_types as $item)
                    <option value="{{ $item->id }}">{{ $item->event_type }}</option>
                    @endforeach
                  </select>
                  <div></div>
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
                    <input type="text" class="form-control" id="date" name="event_date" placeholder="Choose date"
                      value="{{ date('Y-m-d') }}">
                    <div></div>
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
                    <input type="text" class="form-control timepikcr" name="event_start_time" placeholder="From">
                  </div>
                </div>

                <div class="col-lg-4 col-md-12">
                  <div class="input-group ">
                    <div class="input-group-text">
                      <i class="typcn typcn-stopwatch tx-24 lh--9 op-6"></i>
                    </div>
                    <input type="text" class="form-control timepikcr" name="event_end_time" placeholder="To">
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
                  {{-- <div class="input-group">
                    <div class="input-group-text">
                      <i class="typcn typcn-calendar-outline tx-24 lh--9 op-6"></i>
                    </div>
                    <input type="text" class="form-control" id="event_location" name="event_location"
                      placeholder="Pick Location Address">
                  </div> --}}
                  <select name="location_id" id="location_id" class="form-control">
                    <option value="">Pick Location Address</option>
                    @foreach ($locations as $item)
                    <option value="{{ $item->id }}">{{ $item->location }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
          </div>



          <div class="col-12">
            <div class="form-group">
              <div class="row">
                <div class="col-lg-2 col-md-12">
                  <label class="form-label" for="event_number_guest">{{ __('Est. Number of Guest') }} <span
                      class="field-req"> *</span></label>
                </div>
                <div class="col-lg-8 col-md-12">
                  <select name="event_guest_count" id="event_number_guest" class="form-control form-select select2">
                    <option value="0">Select Range</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                    <option value="200">200</option>
                    <option value="300">300</option>
                  </select>
                </div>
              </div>
            </div>
          </div>


          <div class="col-12">
            <div class="form-group">
              <div class="row">
                <div class="col-lg-2 col-md-12">
                  <label class="form-label" for="event_type_id">{{ __('Range Budget') }}<span class="field-req">
                      *</span></label>
                </div>

                <div class="col-lg-3 col-md-12">
                  <div class="input-group">
                    <div class="input-group-text">
                      RM
                    </div>
                    <input type="number" name="event_start_budget" class="form-control ">
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
                    <input type="number" name="event_end_budget" class="form-control ">
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-12">
            <div class="form-group">
              <div class="row">
                <div class="col-lg-2 col-md-12">
                  <label class="form-label" for="vendor_range">{{ __('Vendor Range Search') }}<span class="field-req">
                      *</span></label>
                </div>
                <div class="col-lg-10 col-md-12">
                  <input type="text" name="vendor_range" id="vendor_range" value="{{ $event->event_name ?? '' }}"
                    class="form-control">
                  <input type="hidden" id="latitudeUser" value="">
                  <input type="hidden" id="longitudeUser" value="">
                  <div></div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-12 text-center wizzard-action">
            Reminder : Kindly double check before continue...
          </div>

          <div class="d-flex justify-content-center">
            <button type="button" class="btn btn-warning" onclick="Order.storeStep1()">Next</button>
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