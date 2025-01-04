<?php namespace App\Traits;

      use Jantinnerezo\LivewireAlert\LivewireAlert;


trait AlertLivewire
{
  use LivewireAlert;

  /**
   * Alert success
   *
   * @param mixed $message
   * @param mixed $position
   * @return void
   */
  protected function alert_success($message, $position = "center")
  {
    $this->alert("success", $message, [
      "position" => $position,
    ]);
  }

  /**
   * Alert error
   *
   * @param mixed $message
   * @param mixed $position
   * @return void
   */
  protected function alert_error($message, $position)
  {
    $this->alert("error", $message, [
      "position" => $position,
    ]);
  }
}
