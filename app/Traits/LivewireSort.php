<?php namespace App\Traits;

trait LivewireSort
{
  public $sort_column = 'id'; // Default column
  public $sort_direction = 'desc';

  public function sortBy($column)
  {
    if ($this->sort_column === $column) {
      $this->sort_direction = $this->sort_direction === 'asc' ? 'desc' : 'asc';
    } else {
      $this->sort_column = $column;
      $this->sort_direction = 'asc';
    }
  }
}
