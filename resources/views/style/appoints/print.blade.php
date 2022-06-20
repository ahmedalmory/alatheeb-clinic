
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" media="screen" href="https://fontlibrary.org//face/droid-arabic-kufi" type="text/css"/>
    <title>Document</title>
    <style>
      body {
        font-family: 'DroidArabicKufiRegular';
        font-weight: normal;
        font-style: normal;
        }
    </style>
</head>
<body dir="rtl" style="text-align: right;">

  <div class="" style="max-width:1100px;margin:auto;background-color:#fff;padding:20px;font-size:11px">
   <table class="table" style="border:0 !important;">
      <tbody>
         <tr class="selected-cc" style="border:0 !important;">
            <td width="33%" style="border:0 !important;">
               <div class="" style="text-align: center;max-width:300px">
                  <div class="">
                     مجمع الميدان الطبي<br>
                     <!-- http://ca.midan-c.com -->
                     02145454-02145454-058458787
                  </div>
               </div>
            </td>
            <td width="33%" style="border:0 !important;">
               <div class="text-center">
                  <img style="width:100px;margin:auto" src="{{ it()->url(setting()->logo) }}">
               </div>
               <h5 class="text-center font-weight-bold" style="font-weight:bold;">print an appointment <br> طباعة موعد </h5>

            </td>
            <td width="33%" style="border:0 !important;">
               <div class="" style="text-align: center;max-width:300px;margin-bottom:5px">
                  <div class="">
                     Al-Maidan Medical Complex<br>
                     <!-- http://ca.midan-c.com -->
                     02145454-02145454-058458787
                  </div>
               </div>
               <div class="" style="display: flex;align-items: center;justify-content:center;max-widh:150px;margin:auto">
                  <!--?xml version="1.0" encoding="UTF-8"?-->

               </div>
            </td>
         </tr>
      </tbody>
   </table>
     <!-- <div class="" style="display:flex">
        <table class="table" style="border:1px solid #ddd">
           <tbody>

              <tr>
                 <th style="border:0; width:15%;white-space:nowrap">
                    التاريخ
                 </th>
                 <td style="text-align:center;border:0">
                   {{$appoint->in_day}}
                 </td>
                 <th style="border:0;white-space:nowrap;text-align:left">
                    Date
                 </th>
              </tr>
              <tr>
                 <th style="border:0; width:15%;white-space:nowrap">الوقت</th>
                 <td style="text-align:center;border:0"> {{$appoint->in_time}} </td>
                 <th style="border:0;white-space:nowrap;text-align:left">Time</th>
              </tr>
              <tr>
                 <th style="border:0; width:15%;white-space:nowrap"> اليوم </th>
                 <td style="text-align:center;border:0"> الجمعة </td>
                 <th style="border:0;white-space:nowrap;text-align:left">Day</th>
              </tr>

           </tbody>
        </table>
        <table class="table" style="border:1px solid #ddd">
           <tbody>
             <tr>
                <th style="border:0; width:15%;white-space:nowrap">
                   الإسم
                </th>
                <td style="text-align:center;border:0">
                   {{$appoint->patient->first_name}}
                </td>
                <th style="border:0;white-space:nowrap;text-align:left">Name</th>
             </tr>
             <tr>
                <th style="border:0; width:15%;white-space:nowrap"> اسم الطبيب</th>
                <td style="text-align:center;border:0">
                   {{$appoint->user->name}}
                </td>
                <th style="border:0;white-space:nowrap;text-align:left">Doctor name</th>
             </tr>
             <tr>
                <th style="border:0; width:15%;white-space:nowrap">
                   <span style="visibility:hidden">حاله الحجز</span>
                </th>
                <td style="text-align:center;border:0">
                </td>
                <th style="border:0;white-space:nowrap;text-align:left">
                  booking status
                </th>
             </tr>
           </tbody>
        </table>
     </div>
   -->




    <div style="max-width: 1000px;margin: auto;">
        <table class="table">
            <thead>
                <tr style="background-color: #000;color: #fff;">
                    <th colspan="2" class="text-center">طباعة موعد</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="width:250px">الاسم:</td>
                    <td>{{$appoint->patient->first_name}}</td>
                </tr>
                <tr>
                    <td style="width:250px">التاريخ</td>
                    <td>{{$appoint->in_day}}</td>
                </tr>
                <tr>
                    <td style="width:250px">الوقت</td>
                    <td>{{$appoint->in_time}}</td>
                </tr>
                <tr>
                    <td style="width:250px">اليوم</td>
                    <td>الجمعة</td>
                </tr>
                <tr>
                    <td style="width:250px">اسم الطبيب</td>
                    <td>{{$appoint->user->name}}</td>
                </tr>
                <tr>
                    <td style="width:250px">حاله الحجز</td>
                    <td>{{get_status($appoint->appoint_status)}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
<script>
    window.print();
</script>
</html>
