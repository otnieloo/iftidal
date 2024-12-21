@extends('layouts.users.app')

@push('style')
  <link rel="stylesheet" href="{{ asset('assets/css/pages/financial-user.css?v=' . time()) }}">
@endpush

@section('content')

<div class="row">
  <div class="col-md-3">

    <div class="card financial-user">
      <div class="card-header p-2">
        <div class="col-8 mt-3">
          <h6>Wallet Amount</h6>
        </div>
        <div class="col-4">
          <button class="btn btn-warning btn-topup" onclick="CORE.showModal('modalAddTopUp')">Top Up</button>
        </div>
      </div>
      <div class="card-body">

        <div class="row align-items-end">
          <div class="col-4">
            <div class="icon" style="background-color: #ffd700;">
              <i class="fa-solid fa-wallet text-white"></i>
            </div>
          </div>
          <div class="col-2">
            <small>RM</small>
          </div>
          <div class="col-6">
            <h3 class="m-0">{{ number_format($user_balance->wallet, 2) }}</h3>
          </div>
        </div>

      </div>
    </div>

  </div>

  <div class="col-md-3">

    <div class="card financial-user">
      <div class="card-header p-2">
        <div class="col-8 mt-3">
          <h6>Pending Deposit</h6>
        </div>
      </div>
      <div class="card-body">

        <div class="row align-items-end">
          <div class="col-4">
            <div class="icon" style="background-color: #99cccc">
              <i class="fa-solid fa-comment-dollar text-white"></i>
            </div>
          </div>
          <div class="col-2">
            <small>RM</small>
          </div>
          <div class="col-6">
            <h3 class="m-0">{{ number_format($user_balance->paid_deposit, 2) }}</h3>
          </div>
        </div>

      </div>
    </div>

  </div>

  <div class="col-md-3">

    <div class="card financial-user">
      <div class="card-header p-2">
        <div class="col-8 mt-3">
          <h6>Pending Balance</h6>
        </div>
      </div>
      <div class="card-body">

        <div class="row align-items-end">
          <div class="col-4">
            <div class="icon" style="background-color: #B3B3B3">
              <i class="fa-solid fa-comment-dollar text-white"></i>
            </div>
          </div>
          <div class="col-2">
            <small>RM</small>
          </div>
          <div class="col-6">
            <h3 class="m-0">{{ number_format($user_balance->pending_balance, 2) }}</h3>
          </div>
        </div>

      </div>
    </div>

  </div>

  <div class="col-md-3">

    <div class="card financial-user">
      <div class="card-header p-2">
        <div class="col-7 mt-3">
          <h6>Credit Balance</h6>
        </div>
        <div class="col-5">
          <button class="btn btn-warning" style="background-color: #009999 !important;" onclick="CORE.showModal('modalCreatedWithdraw')">Withdraw</button>
        </div>
      </div>
      <div class="card-body">

        <div class="row align-items-end">
          <div class="col-4">
            <div class="icon" style="background-color: #333333;">
              <i class="fa-solid fa-wallet text-white"></i>
            </div>
          </div>
          <div class="col-2">
            <small>RM</small>
          </div>
          <div class="col-6">
            <h3 class="m-0">{{ number_format($user_balance->credit_balance, 2) }}</h3>
          </div>
        </div>

      </div>
    </div>

  </div>

</div>

<div class="financial-user">
  <div class="row align-items-center">
    <div class="col-8">

      <ul class="nav nav-tabs">
        <li class="nav-item">
          <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#tabTransactionHistory" type="button">Transaction History</button>
        </li>
        <li class="nav-item">
          <button class="nav-link" id="hired-tab" data-bs-toggle="tab" data-bs-target="#transactionPaid" type="button">Paid</button>
        </li>
        <li class="nav-item">
          <button class="nav-link" id="banned-tab" data-bs-toggle="tab" data-bs-target="#transactionPending" type="button">Pending Payment</button>
        </li>
        <li class="nav-item">
          <button class="nav-link" id="banned-tab" data-bs-toggle="tab" data-bs-target="#transactionWithdrawal" type="button">Withdrawal</button>
        </li>
      </ul>

    </div>
    <div class="col-4">

      <input type="text" class="form-control" id="inputSearchFinancial" placeholder="Search...">

    </div>
  </div>

  <div class="card">
    <div class="card-body">

      <div class="tab-content">
        <div class="tab-pane fade show active" id="tabTransactionHistory">

          @livewire('apps.users.financials.transaction-history')

        </div>
        <div class="tab-pane fade" id="transactionPaid"></div>
        <div class="tab-pane fade" id="transactionPending"></div>
        <div class="tab-pane fade" id="transactionWithdrawal">

          @livewire('apps.users.financials.withdraw')

        </div>
      </div>

    </div>
  </div>

  <div class="modal fade" id="modalAddTopUp">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">

          <div class="form-group">
            <label>Amount</label>
            <select name="amount" class="form-control">
              <option value="25">RM 25</option>
              <option value="50">RM 50</option>
              <option value="100">RM 100</option>
              <option value="200">RM 200</option>
              <option value="300">RM 300</option>
            </select>
          </div>

          <button class="btn btn-success btn-sm mt-3" onclick="topUpWallet()">Top Up</button>

        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
  </div>

  <div class="modal fade" id="modalCreatedWithdraw">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">

          <form action="{{ route('user.withdraw.store') }}" method="POST" with-submit-crud>
            @csrf

            <div class="form-group my-3">
              <label>Amount</label>
              <input type="text" class="form-control number-format" name="amount">
              <div></div>
            </div>

            <div class="form-group my-3">
              <label>Information Bank</label>
              <textarea name="information_bank" class="form-control" cols="30" rows="5"></textarea>
              <div></div>
            </div>

            <button class="btn btn-success">Withdraw</button>

          </form>

        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
  </div>

</div>

<form action="https://uatpaymenthub.infinpay.com/api/pymt/pw/v1.1/payment" id="formTopupWalletPG" method="POST">
  <input type="hidden" name="jwt" id="jwtPaymentTopUp">
</form>

@endsection

@push('script')
<script src="{{ asset('assets/js/apps/financial-user.js?v=' . time()) }}"></script>
@endpush
