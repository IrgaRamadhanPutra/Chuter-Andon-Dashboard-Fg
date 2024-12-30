@extends('admin.layout')
@section('title')
    Dashboard portal
@endsection
@section('content')
    <div class="grid grid-cols-1 gap-12 pt-5 lg:grid-cols-1">
        <div class="panel">
            <h5 class="mb-5 text-lg font-semibold dark:text-white-light">PORTAL</h5>
            <div class="mb-5 flex items-center justify-center">
                <div
                    class="max-w-[24rem] w-full bg-white shadow-[4px_6px_10px_-3px_#bfc9d4] rounded border border-[#e0e6ed] dark:border-[#1b2e4b] dark:bg-[#191e3a] dark:shadow-none p-5">
                    <div class="flex justify-between mb-5">
                        <h6 class="text-[#0e1726] font-semibold text-base dark:text-white-light">WMS CHUTER FINISH GOOD</h6>
                        {{-- <span class="badge bg-primary/10 text-primary py-1.5 dark:bg-primary dark:text-white">IN
                            PROGRESS</span> --}}
                    </div>
                    <div class="flex items-center justify-start -space-x-5 rtl:space-x-reverse mb-5">
                        <!-- Text elements styled like images with added margin -->
                        <div
                            class="w-9 h-9 flex items-center justify-center rounded-full bg-[#e0e6ed] dark:bg-[#1b2e4b] text-[#515365] dark:text-white font-semibold shadow-[0_0_15px_1px_rgba(113,106,202,0.30)] dark:shadow-none mr-2">
                            ADM
                        </div>
                        <div
                            class="w-9 h-9 flex items-center justify-center rounded-full bg-[#e0e6ed] dark:bg-[#1b2e4b] text-[#515365] dark:text-white font-semibold shadow-[0_0_15px_1px_rgba(113,106,202,0.30)] mr-2">
                            YIMM
                        </div>
                        <div
                            class="w-9 h-9 flex items-center justify-center rounded-full bg-[#e0e6ed] dark:bg-[#1b2e4b] text-[#515365] dark:text-white font-semibold shadow-[0_0_15px_1px_rgba(113,106,202,0.30)]">
                            HPM
                        </div>
                        <span
                            class="bg-white rounded-full px-2 py-1 text-primary text-xs shadow-[0_0_20px_0_#d0d0d0] dark:shadow-none dark:bg-[#0e1726] dark:text-white">
                            +5 more
                        </span>
                    </div>
                    <div class="text-right">
                        <div class="mb-1 flex items-center justify-between">
                            <!-- Label dan Progress Bar KRITIS -->
                            <span class="text-danger font-semibold">KRITIS</span>
                            <span class="text-dark font-semibold">{{ $percentKritis }}%</span>
                        </div>
                        <div class="bg-[#ebedf2] dark:bg-[#0e1726] rounded-full w-full h-1.5 mt-1.5">
                            <div class="rounded-full bg-danger h-full" style="width: {{ $percentKritis }}%;"></div>
                        </div>
                        <div class="mb-1 flex items-center justify-between">
                            <!-- Label dan Progress Bar OVER -->
                            <span class="text-warning font-semibold">OVER</span>
                            <span class="text-dark font-semibold">{{ $percentOver }}%</span>
                        </div>
                        <div class="bg-[#ebedf2] dark:bg-[#0e1726] rounded-full w-full h-1.5 mt-1.5">
                            <div class="rounded-full bg-warning h-full" style="width: {{ $percentOver }}%;"></div>
                        </div>

                        <div class="mb-1 flex items-center justify-between">
                            <!-- Label dan Progress Bar OK -->
                            <span class="text-success font-semibold">OK</span>
                            <span class="text-dark font-semibold">{{ $percentOk }}%</span>
                        </div>
                        <div class="bg-[#ebedf2] dark:bg-[#0e1726] rounded-full w-full h-1.5 mt-1.5">
                            <div class="rounded-full bg-success h-full" style="width: {{ $percentOk }}%;"></div>
                        </div>
                        <span class="text-dark font-semibold">Total 100%</span>
                    </div>
                    <div class="border-border-white-dark/20 border-t bg-dark-light p-4 dark:border-[#0e1726] dark:bg-[#191e3a] mt-5">
                        <!-- Nunito Section -->
                        {{-- <h5 class="text-base dark:text-white-light">Nunito</h5>
                        <a href="javascript:;" class="text-[13px] text-primary">Google Fonts</a> --}}
                        <div class="mt-7 flex justify-center">
                            <a href="{{ route('andon_chuter_fg') }}" class="btn btn-primary">View Dashboard</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection('content')
