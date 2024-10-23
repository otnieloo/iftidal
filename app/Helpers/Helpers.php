<?php

use Illuminate\Support\Facades\Storage;

if (!function_exists("create_response")) {
  function create_response()
  {
    $response = new stdClass;
    $response->status = FALSE;
    $response->status_code = 404;
    $response->data = [];
    $response->message = "Not Found";

    return $response;
  }
}

if (!function_exists("response_success_default")) {
  function response_success_default($message, $id = FALSE, $next_url = FALSE)
  {
    $response = create_response();
    $response->status = TRUE;
    $response->status_code = 200;
    if ($id) {
      $response->data = [
        "id" => $id
      ];
    }

    $response->message = $message;
    if ($next_url) {
      $response->next_url = $next_url;
    }

    return $response;
  }
}

if (!function_exists("response_errors_default")) {
  function response_errors_default()
  {
    $response = new stdClass;
    $response->status = FALSE;
    $response->status_code = 500;
    $response->data = [];
    $response->message = "Sorry we have a something wrong on server!";

    return $response;
  }
}

if (!function_exists("response_json")) {
  function response_json($response)
  {
    return response()->json($response, $response->status_code);
  }
}

if (!function_exists("response_data")) {
  function response_data($data)
  {
    $response = create_response();

    if (count($data) > 0) {
      $response->status = TRUE;
      $response->status_code = 200;
      $response->message = "Found!";
      $response->data = $data;
    }

    return $response;
  }
}

if (!function_exists("random_string")) {
  function random_string($length = 10)
  {
    return \Illuminate\Support\Str::random($length);
  }
}

if (!function_exists("form_delete")) {
  function form_delete($formID, $route)
  {
    $html = "<form class='d-inline ms-2' id='$formID' action='$route' method='POST' with-submit-crud>";
    $html .= "<input type='hidden' name='_token' value='" . csrf_token() . "'>";
    $html .= "<input type='hidden' name='_method' value='DELETE'>";

    $html .= "<button class='btn btn-danger btn-sm' type='button' onclick=\"CORE.promptForm('$formID', 'Sure for deleted this data?')\"><i class='fa-solid fa-trash'></i></button>";
    $html .= "</form>";

    return $html;
  }
}

if (!function_exists("form_custom")) {
  function form_custom($formID, $route, $icon, $color, $message, $method = "PUT")
  {
    $html = "<form class='d-inline ms-2' id='$formID' action='$route' method='POST' with-submit-crud>";
    $html .= "<input type='hidden' name='_token' value='" . csrf_token() . "'>";
    $html .= "<input type='hidden' name='_method' value='$method'>";

    $html .= "<button class='btn btn-$color btn-sm' type='button' onclick=\"CORE.promptForm('$formID', '$message')\"><i class='$icon'></i></button>";
    $html .= "</form>";

    return $html;
  }
}

if (!function_exists("check_authorized")) {
  function check_authorized($module_code)
  {
    return (new \App\Services\AuthorizationService)->check_authorization($module_code);
  }
}


if (!function_exists("move_tmp_file")) {
  function move_tmp_file($tmpImage, $dir)
  {
    $newImage       = explode('/', $tmpImage);
    $newImage[0]    = $dir;
    $newImage       = implode('/', $newImage);
    $movedFile      = Storage::move($tmpImage, $newImage);


    return [$newImage, $movedFile];
  }
}


if (!function_exists("myr_currency")) {
  function myr_currency($amount)
  {
    $formatted_amount = 'RM ' . number_format($amount, 2, '.', ',');

    return $formatted_amount;
  }
}

if (!function_exists("is_role")) {
  function is_role($role_name)
  {
    return auth()->user()->role->role_name == $role_name;
  }
}
