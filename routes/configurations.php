<?php
\Config::set('filesystems.disks.public.url', url('storage'));
//return dd(config('filesystems.disks.public.url'));
////// direction Function /////////////////////
app()->singleton('direction', function () {
   if (app()->getLocale() == 'ar') {
      return '-rtl';
   }
});
app()->singleton('dir', function () {
  return app()->getLocale() == 'ar' ? 'rtl' :'ltr';
});
////// direction Function /////////////////////

//////  upload Function /////////////////////
if (!function_exists('it')) {
   function it()
   {
      return new \App\Http\Controllers\FileUploader;
   }
}
if (!function_exists('setting')) {
   function setting()
   {
      return \App\Setting::find(1);
   }
}
//////  upload Function /////////////////////

////// Admin Url Function /////////////////////
if (!function_exists('aurl')) {
   function aurl($link)
   {
      if (substr($link, 0, 1) == '/') {
         return url(app('admin') . $link);
      } else {
         return url(app('admin') . '/' . $link);
      }
   }
}
////// Admin Url Function /////////////////////

////// Admin Url Function /////////////////////
if (!function_exists('admin')) {
   function admin()
   {
      return auth()->guard('admin');
   }
}
////// Admin Url Function /////////////////////

////// Admin Url Function /////////////////////
if (!function_exists('active_link')) {
   function active_link($segment, $class = null)
   {
      if (null == $segment and request()->segment(2) == null) {
         return $class;
      } elseif (preg_match('/' . $segment . '/i', request()->segment(2))) {
         if (null != $class || 'block' != $class) {
            if (null != $segment) {
               return $class;
            }
         } else {
            if ('block' == $class) {
               return 'display:block';
            } else {
               return 'display:none';
            }
         }
      }
   }
}
////// Admin Url Function /////////////////////

function intPart($float)
{
   if ($float < -0.0000001) {
      return ceil($float - 0.0000001);
   } else {
      return floor($float + 0.0000001);
   }
}

function Hijri2Greg($day, $month, $year, $string = false)
{
   $day   = (int) $day;
   $month = (int) $month;
   $year  = (int) $year;

   $jd = intPart((11 * $year + 3) / 30) + 354 * $year + 30 * $month - intPart(($month - 1) / 2) + $day + 1948440 - 385;

   if ($jd > 2299160) {
      $l     = $jd + 68569;
      $n     = intPart((4 * $l) / 146097);
      $l     = $l - intPart((146097 * $n + 3) / 4);
      $i     = intPart((4000 * ($l + 1)) / 1461001);
      $l     = $l - intPart((1461 * $i) / 4) + 31;
      $j     = intPart((80 * $l) / 2447);
      $day   = $l - intPart((2447 * $j) / 80);
      $l     = intPart($j / 11);
      $month = $j + 2 - 12 * $l;
      $year  = 100 * ($n - 49) + $i + $l;
   } else {
      $j     = $jd + 1402;
      $k     = intPart(($j - 1) / 1461);
      $l     = $j - 1461 * $k;
      $n     = intPart(($l - 1) / 365) - intPart($l / 1461);
      $i     = $l - 365 * $n + 30;
      $j     = intPart((80 * $i) / 2447);
      $day   = $i - intPart((2447 * $j) / 80);
      $i     = intPart($j / 11);
      $month = $j + 2 - 12 * $i;
      $year  = 4 * $k + $n + $i - 4716;
   }

   $data          = [];
   $date['year']  = $year;
   $date['month'] = $month;
   $date['day']   = $day;

   if (!$string) {
      return $date;
   } else {
      return "{$year}-{$month}-{$day}";
   }
}

function calculate_age($date)
{
   $date = new \Carbon\Carbon($date);
   return (int) $date->diffInYears();
}

function Greg2Hijri($day, $month, $year, $string = false)
{
   $day   = (int) $day;
   $month = (int) $month;
   $year  = (int) $year;

   if (($year > 1582) or ((1582 == $year) and ($month > 10)) or ((1582 == $year) and (10 == $month) and ($day > 14))) {
      $jd = intPart((1461 * ($year + 4800 + intPart(($month - 14) / 12))) / 4) + intPart((367 * ($month - 2 - 12 * (intPart(($month - 14) / 12)))) / 12) -
      intPart((3 * (intPart(($year + 4900 + intPart(($month - 14) / 12)) / 100))) / 4) + $day - 32075;
   } else {
      $jd = 367 * $year - intPart((7 * ($year + 5001 + intPart(($month - 9) / 7))) / 4) + intPart((275 * $month) / 9) + $day + 1729777;
   }

   $l = $jd - 1948440 + 10632;
   $n = intPart(($l - 1) / 10631);
   $l = $l - 10631 * $n + 354;
   $j = (intPart((10985 - $l) / 5316)) * (intPart((50 * $l) / 17719)) + (intPart($l / 5670)) * (intPart((43 * $l) / 15238));
   $l = $l - (intPart((30 - $j) / 15)) * (intPart((17719 * $j) / 50)) - (intPart($j / 16)) * (intPart((15238 * $j) / 43)) + 29;

   $month = intPart((24 * $l) / 709);
   $day   = $l - intPart((709 * $month) / 24);
   $year  = 30 * $n + $j - 30;

   $date          = [];
   $date['year']  = $year;
   $date['month'] = $month;
   $date['day']   = $day;

   if (!$string) {
      return $date;
   } else {
      return "{$year}-{$month}-{$day}";
   }
}

if (!function_exists('load_dep')) {
   function load_dep($select = null, $dep_hide = null)
   {

      $departments = \App\Models\Department::selectRaw('dep_name as text')
         ->selectRaw('id as id')
         ->selectRaw('parent as parent')
         ->get(['text', 'parent', 'id']);
      $dep_arr = [];
      foreach ($departments as $department) {
         $list_arr             = [];
         $list_arr['icon']     = '';
         $list_arr['li_attr']  = '';
         $list_arr['a_attr']   = '';
         $list_arr['children'] = [];

         if (null !== $select and $select == $department->id) {
            $list_arr['state'] = [
               'opened'   => true,
               'selected' => true,
               'disabled' => false,
            ];
         }

         if (null !== $dep_hide and $dep_hide == $department->id) {
            $list_arr['state'] = [
               'opened'   => false,
               'selected' => false,
               'disabled' => true,
               'hidden'   => true,
            ];
         }

         $list_arr['id']     = $department->id;
         $list_arr['parent'] = $department->parent > 0 ? $department->parent : '#';
         $list_arr['text']   = $department->text;
         array_push($dep_arr, $list_arr);
      }

      return json_encode($dep_arr, JSON_UNESCAPED_UNICODE);
   }

   if (!function_exists('calc_time')) {
      function calc_time($type = 'morning')
      {
         // evening or morning
         $datetime1 = new \DateTime(setting()->{'from_' . $type});
         $datetime2 = new \DateTime(setting()->{'to_' . $type});
         $interval  = $datetime1->diff($datetime2);
         $hm        = $interval->format('%H:%I');
         if (!empty($hm)) {
            $extime = explode(':', $hm);
            return ($extime[0] * 60 + (int) $extime[1]) / setting()->patient_exposure;
         } else {
            return 'data not found';
         }
      }
   }
}
