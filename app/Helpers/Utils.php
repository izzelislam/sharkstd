<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

class Utils {

  /**
   * check user is authenticated
   *
   * @return void
   */
  public static function Check()
  {
    $is_authenticated = Auth::check();
    if (!$is_authenticated){
      return abort(401);
    }
  }

  /**
   * redirect bac with success message
   *
   * @param [type] $message
   * @return void
   */
  public static function BackSuccess($message)
  {
    return redirect()->back()->with('success', $message);
  }

  /**
   * redirec back with error message
   *
   * @param [type] $message
   * @return void
   */
  public static function BackFail($message)
  {
    return redirect()->back()->with('error', $message)->withInput();
  }

  /**
   * redirect with success message
   *
   * @param [type] $route
   * @param [type] $message
   * @return void
   */
  public static function RedirectSuccess($route, $message)
  {

    return redirect($route)->with("success", $message);
  }

  /**
   * redirect with error message
   *
   * @param [type] $route
   * @param [type] $message
   * @return void
   */
  public static function RedirectError($route, $message)
  {
    return redirect($route)->with("error", $message);
  }

  /**
   *  formatter data from select input
   *
   * @param [type] $data
   * @return void
   */
  public static function SelectFormatter($data)
  {
      $model = [];
      foreach ($data as $key => $value) {
          $model[$value->id] = $value->name ?? $value->title;
      }
      return $model;
  }

  public static function pluckId($data)
  {
    if ($data != '' ){
      return $data->pluck('id')->toARray();
    }
    return [];
  }

  /**
   * unie code generator
   *
   * @param [type] $length
   * @return void
   */
  public static function CodeGenerator($length)
  {
      $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $charactersLength = strlen($characters);
      $randomString = '';
      for ($i = 0; $i < $length; $i++) {
          $randomString .= $characters[rand(0, $charactersLength - 1)];
      }
      return $randomString;
  }
}