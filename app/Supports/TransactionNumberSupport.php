<?php namespace App\Supports;

      use App\Models\UserWalletTopup;
      use App\Models\UserWithdraw;

class TransactionNumberSupport
{
  /**
   * Generate order number
   *
   * @return string
   */
  public function generate_wallet_number()
  {
    $loop = 0;
    do {
      $get_last_number = UserWalletTopup::query()->count();
      $get_last_number = $get_last_number + 1;

      $transaction_number = "W" . date("ymd") . str_pad($get_last_number, 4, "0", STR_PAD_LEFT);
      $check_order = UserWalletTopup::query()->where('transaction_number', $transaction_number)->first();

      if ($loop > 10) {
        throw new \Exception("Failed to generate order number!", 500);
      }

      $loop++;
    } while ($check_order);

    return $transaction_number;
  }

  /**
   * Generate withdraw number
   *
   * @return string
   */
  public function generate_withdraw_number()
  {
    $loop = 0;
    do {
      $get_last_number = UserWithdraw::query()->count();
      $get_last_number = $get_last_number + 1;

      $withdraw_number = "WD" . date("ymd") . str_pad($get_last_number, 4, "0", STR_PAD_LEFT);
      $check_order = UserWithdraw::query()->where('withdraw_number', $withdraw_number)->first();

      if ($loop > 10) {
        throw new \Exception("Failed to generate order number!", 500);
      }

      $loop++;
    } while ($check_order);

    return $withdraw_number;
  }
}
