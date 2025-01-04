<div>

  <div class="row align-items-center">
    <div class="col-md-8">
      <div class="page-header d-sm-flex d-block">
        <ol class="breadcrumb mb-sm-0 mb-3">
          <!-- breadcrumb -->
          <li class="breadcrumb-item"><a href="javascript:void(0);">Management</a></li>
          <li class="breadcrumb-item active" aria-current="page">My Staff (s)</li>
        </ol><!-- End breadcrumb -->
      </div>
    </div>
    <div class="col-md-4">
      <button class="btn btn-gray" wire:click="save">Save Staff</button>
      <button class="btn btn-gray" onclick="CORE.showModal('modalImport')">Import Contact</button>
    </div>
  </div>

  <div class="card">
    <div class="card-body">

      <!-- Search Bar -->
      <div class="d-flex justify-content-end mb-4">
        <div class="search-container" style="width: 25%;">
          <input type="text" class="form-control" wire:model.debounce.500ms="keyword" placeholder="Search...">
          <i class="fas fa-search search-icon"></i>
        </div>
      </div>

      <!-- Table Container -->
      <div class="table-container">
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th wire:click="sortBy('employees.id')">No <i class="ms-1">↑</i></th>
                <th wire:click="sortBy('employees.name')">Name <i class="ms-1">↑</i></th>
                <th wire:click="sortBy('cc.code')">Country Code <i class="ms-1">↑</i></th>
                <th wire:click="sortBy('employees.phone_number')">Phone Number <i class="ms-1">↑</i></th>
                <th wire:click="sortBy('d.department')">Department <i class="ms-1">↑</i></th>
                <th wire:click="sortBy('employees.location')">Location <i class="ms-1">↑</i></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td></td>
                <td>
                  <input type="text" class="form-control" wire:model.debounce.500ms="name" placeholder="Insert Name...">
                  @error('name')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </td>
                <td>
                  <select wire:model="country_code_id" class="form-control">
                    <option value="">Select Country</option>
                    @foreach ($country_codes as $item)
                      <option value="{{ $item->id }}">+{{ $item->code }} ( {{ $item->country }} )</option>
                    @endforeach
                  </select>
                  @error('country_code_id')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </td>
                <td>
                  <input type="text" class="form-control" wire:model.debounce.500ms="phone_number" placeholder="Insert Phone Number...">
                  @error('phone_number')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </td>
                <td>
                  <select class="form-control" wire:model="department_id">
                    <option value="">Select Department</option>
                    @foreach ($departments as $item)
                      <option value="{{ $item->id }}">{{ $item->department }}</option>
                    @endforeach
                  </select>
                  @error('department_id')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </td>
                <td>
                  <input type="text" class="form-control" wire:model.debounce.500ms="location" placeholder="Insert location...">
                  @error('location')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </td>
              </tr>
              @forelse ($employees as $item)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $item->name }}</td>
                  <td>+{{ $item->code }} ( {{ $item->country }} )</td>
                  <td>{{ $item->phone_number }}</td>
                  <td>{{ $item->department }}</td>
                  <td>{{ $item->location }}</td>
                </tr>
              @empty
                <tr>
                  <td colspan="6" class="text-center">No Data Found</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        <!-- Table Footer -->
        <div class="d-flex align-items-center justify-content-between p-3">
          <div class="text-secondary">
            Show
            <select wire:model="per_page" class="form-select d-inline-block w-auto mx-2">
              <option value="10">10</option>
              <option value="50">50</option>
              <option value="100">100</option>
            </select>
            entries
          </div>

          {{-- {!! $orders->links() !!} --}}
        </div>
      </div>

    </div>
  </div>

  <div class="modal" id="modalImport">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Import Employee</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <a href="{{ route('vendor.employees.export') }}" class="btn btn-primary btn-sm">Download Template</a>

          <form action="{{ route('vendor.employees.import') }}" method="POST" enctype="multipart/form-data" with-submit-crud>
            @csrf

            <div class="form-group mt-4">
              <label>File Excel</label>
              <input type="file" name="file" class="form-control">
            </div>

            <button class="btn btn-success btn-sm mt-3">Import</button>

          </form>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
  </div>

</div>
