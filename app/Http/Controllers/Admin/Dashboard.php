<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Setting;

class Dashboard extends Controller
{

   public function home()
   {
      return view('admin.home', ['title' => trans('admin.dashboard')]);
   }

   public function setting()
   {
      return view('admin.setting', ['title' => trans('admin.setting')]);
   }

   public function setting_post()
   {
      // return dd(request()->all());

      $data = [
         'sitename'         => request('sitename'),
         'email'            => request('email'),
         'status'           => request('status'),
         'message_status'   => request('message_status'),
         'url'              => request('url'),
         'phones'           => count(request('phones')) > 0 ? implode('|', request('phones')) : '',
         'sms_status'       => request('sms_status'),
         'sms_username'     => request('sms_username'),
         'sms_password'     => request('sms_password'),
         'sms_sender'       => request('sms_sender'),
         'from_morning'     => request('from_morning'),
         'to_morning'       => request('to_morning'),
         'from_evening'     => request('from_evening'),
         'to_evening'       => request('to_evening'),
         'patient_exposure' => request('patient_exposure'),
         'tax_enabled'      => request('tax_enabled'),
         'tax_rate'         => request('tax_rate'),
         'tax_id'           => request('tax_id'),
         'address'           => request('address'),
         'unit_num'           => request('unit_num'),
         'build_num'           => request('build_num'),
         'postal_code'           => request('postal_code'),
         'extra_number'           => request('extra_number'),
      ];
      request()->hasFile('logo') ? $data['logo'] = it()->upload('logo', 'settings') : '';
      request()->hasFile('icon') ? $data['icon'] = it()->upload('icon', 'settings') : '';
      Setting::where('id', 1)->update($data);
      session()->flash('success', trans('admin.updated'));
      return back();
   }

   public function theme($id)
   {
      if (session()->has('theme')) {
         session()->forget('theme');
      }
      session()->put('theme', $id);
   }
}
