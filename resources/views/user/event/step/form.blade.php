<div class="row">
  <div class="col-lg-8 col-md-12">
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
                  <label class="form-label" for="event_name">{{ __('Name Event') }}<span class="field-req"> *</span>
                  </label>
                </div>
                <div class="col-lg-10 col-md-12">
                  <input type="text" name="event_name" id="event_name" value="{{ $event->event_name ?? '' }}" class="form-control">
                  <div></div>
                </div>
              </div>
            </div>
          </div>


          <div class="col-12">
            <div class="form-group">
              <div class="row">
                <div class="col-lg-2 col-md-12">
                  <label class="form-label" for="event_type_id">{{ __('Type of Event') }}<span class="field-req"> *</span></label>
                </div>
                <div class="col-lg-8 col-md-12">
                  <select name="event_type_id" id="event_type_id" class="form-control form-select select2">
                    <option value="0">Select Type Of Event</option>
                  </select>
                </div>
              </div>
            </div>
          </div>


          <div class="col-12">
            <div class="form-group">
              <div class="row">
                <div class="col-lg-2 col-md-12">
                  <label class="form-label" for="event_date">{{ __('Date of Event')
                    }}<span class="field-req"> *</span></label>
                </div>
                <div class="col-lg-8 col-md-12">
                  <div class="input-group">
                    <div class="input-group-text">
                      <i class="typcn typcn-calendar-outline tx-24 lh--9 op-6"></i>
                    </div>
                    <input type="text" class="form-control" id="date" name="event_date" placeholder="Choose date">
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-12">
            <div class="form-group">
              <div class="row">
                <div class="col-lg-2 col-md-12">
                  <label class="form-label" for="event_type_id">{{ __('Event Period')
                    }}<span class="field-req"> *</span></label>
                </div>

                <div class="col-lg-4 col-md-12">
                  <div class="input-group">
                    <div class="input-group-text">
                      <i class="typcn typcn-stopwatch tx-24 lh--9 op-6"></i>
                    </div>
                    <input type="text" class="form-control timepikcr" placeholder="From">
                  </div>
                </div>

                <div class="col-lg-4 col-md-12">
                  <div class="input-group ">
                    <div class="input-group-text">
                      <i class="typcn typcn-stopwatch tx-24 lh--9 op-6"></i>
                    </div>
                    <input type="text" class="form-control timepikcr" placeholder="To">
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-12">
            <div class="form-group">
              <div class="row">
                <div class="col-lg-2 col-md-12">
                  <label class="form-label" for="event_location">{{ __('Set Location')
                    }}<span class="field-req"> *</span></label>
                </div>
                <div class="col-lg-8 col-md-12">
                  <div class="input-group">
                    <div class="input-group-text">
                      <i class="typcn typcn-calendar-outline tx-24 lh--9 op-6"></i>
                    </div>
                    <input type="text" class="form-control" id="event_location" name="event_location"
                      placeholder="Pick Location Address">
                  </div>
                </div>
              </div>
            </div>
          </div>



          <div class="col-12">
            <div class="form-group">
              <div class="row">
                <div class="col-lg-2 col-md-12">
                  <label class="form-label" for="event_number_guest">{{ __('Est. Number of
                    Guest')
                    }}<span class="field-req"> *</span></label>
                </div>
                <div class="col-lg-8 col-md-12">
                  <select name="event_number_guest" id="event_number_guest" class="form-control form-select select2">
                    <option value="0">Select Range</option>
                  </select>
                </div>
              </div>
            </div>
          </div>


          <div class="col-12">
            <div class="form-group">
              <div class="row">
                <div class="col-lg-2 col-md-12">
                  <label class="form-label" for="event_type_id">{{ __('Range Budget')
                    }}<span class="field-req"> *</span></label>
                </div>

                <div class="col-lg-3 col-md-12">
                  <div class="input-group">
                    <div class="input-group-text">
                      RM
                    </div>
                    <input type="number" name="event_range_budget" class="form-control ">
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
                    <input type="number" name="event_range_budget" class="form-control ">
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-12 text-center wizzard-action">
            Reminder : Kindly double check before continue...
          </div>

          <div class="d-flex justify-content-center">
            <button type="button" class="btn btn-warning next">Next</button>
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
