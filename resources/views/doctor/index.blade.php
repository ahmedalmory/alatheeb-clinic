@extends('doctor.layout.index')
@section('content')
    <style media="screen">
        .d-block {
            display: block
        }

        .fa, .fas {
            font-weight: 900;
        }

        .fa, .far, .fas {
            font-family: "Font Awesome 5 Free";
        }

        .fa-3x {
            font-size: 3em;
        }

        .fa, .fab, .fad, .fal, .far, .fas {
            -moz-osx-font-smoothing: grayscale;
            -webkit-font-smoothing: antialiased;
            display: inline-block;
            font-style: normal;
            font-variant: normal;
            text-rendering: auto;
            line-height: 1;
        }

        .index-dd {
            background-color: #83c2f761;
            display: flex;
            align-items: center;
            flex-direction: column;
            color: #253848;
            font-size: 14px;
            margin-bottom: 10px;
            border-radius: 10px;
            padding: 15px 10px;
            height: 114px;
        }

        .mb-3 {

        }

        .bg-success-lt {
            background-color: #14dd7f;
        }

        .m-2 {
            margin: 0.5rem !important;
        }

        .badge {
            display: inline-block;
            padding: 0.35em 0.65em;
            font-size: 16px !important;
            font-weight: 700;
            height: auto;
            line-height: 1;
            color: #fff;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: 0.25rem !important;

        }

        .mb-3 {
            margin-bottom: 1rem !important;
        }

        .d-block {
            display: block !important;
        }

        .mt-5 {
            margin-top: 20px
        }

        @media (max-width: 991px) {
            .w-all {
                width: 100%
            }
        }

    </style>
    <style>.homepagetable2 {
            padding: 30px;
        }</style>
    <div class="mt-5 ">
        <div class="row w-100 mx-0 "
             style="flex-wrap: wrap;display: flex;justify-content: center; background-color: #fff; padding: 21px 0px 19px; border-radius: 10px;">
            <div class="col-md-4 col-lg-2 w-all mb-3">
                <div class="index-dd">
                    <i class="fas fa-user-injured fa-2x d-block mb-3" style="line-height: 1;"></i>
                    <span class="translate">{{trans('admin.All patients')}}
        </span>
                    <span
                        class="badge bg-success-lt mx-2 mt-0">{{\App\Models\Appoint::query()->where('user_id',auth()->id())->count()}}</span>
                </div>
            </div>
            <div class="col-md-4 col-lg-2 w-all mb-3">
                <div class="index-dd">
                    <i class=" far fa-calendar-alt fa-2x d-block mb-3" style="line-height: 1;"></i>
                    <span class="translate">{{trans("admin.Today's dates")}}
        </span>
                    <span
                        class="badge bg-success-lt mx-2 mt-0">{{\App\Models\Appoint::query()->where('user_id',auth()->id())->where('in_day',\Carbon\Carbon::today()->toDateString())->count()}}</span>
                </div>
            </div>
            <div class="col-md-4 col-lg-2 w-all mb-3">
                <div class="index-dd">
                    <i class="fas fa-user-check fa-2x d-block mb-3" style="line-height: 1;"></i>
                    <span class="translate">{{trans('admin.Available patients')}}
        </span>
                    <span
                        class="badge bg-success-lt mx-2 mt-0">{{\App\Models\Appoint::query()->where('user_id',auth()->id())->whereBetween('in_time',[\Carbon\Carbon::now()->subHour()->format('h:i'),\Carbon\Carbon::now()->addHour()->format('h:i')])->where('in_day',\Carbon\Carbon::today()->toDateString())->count()}}</span>
                </div>
            </div>
            <div class="col-md-4 col-lg-2 w-all mb-3">
                <div class="index-dd">
                    <i class="fas fa-file-invoice-dollar fa-2x d-block mb-3" style="line-height: 1;"></i>
                    <span class="translate"> {{trans('admin.Invoices')}}
        </span>
                    <span
                        class="badge bg-success-lt mx-2 mt-0">{{\App\Models\invoice_main::query()->where('doc_id',auth()->id())->count()}}</span>
                </div>
            </div>
            <div class="col-md-4 col-lg-2 w-all mb-3">
                <div class="index-dd">
                    <i class="fas fa-file-invoice fa-2x d-block mb-3" style="line-height: 1;"></i>
                    <span class="translate"> {{trans('admin.Unpaid invoices')}}
        </span>
                    <span
                        class="badge bg-success-lt mx-2 mt-0">{{\App\Models\invoice_main::query()->where('doc_id',auth()->id())->where('due','<>',0)->count()}}</span>
                </div>
            </div>

        </div>
    </div>

@endsection
