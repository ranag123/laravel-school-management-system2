@extends('layouts.app')

@section('content')
    <style>

hr {
    border: 1px solid grey;border-bottom: none;
    box-sizing: content-box;
    height: 0px;
    overflow: visible;
    width: 100%;
    margin: 20px;
}  p{
       font-size: 12px !important;
    line-height: 1.5;
   }
@page {
    /*size: A4;*/

    background: darkcyan;
    size: landscape;
    margin: 0px;
 }
.tracking-tight{
    margin-top: 2px;
}
@media print {
    body,* {
        background: white;
        margin: 0;
        padding: 0;
      }
    .content{width:100%}

    div.sd {
         background: yellow;
        width: 100%;
        margin: 0px;
        padding: 0px;
        height: 100%;
    }
    .container{
        max-width: unset;
        width:100%;
    }

    #printsection
    {
        /*background: black;*/

        /*width:100%;*/
        margin:0px
    }
    .sidebar  ,.justify-between{
        display:none !important;
    }
    .mt-16{margin:0px }
}

    </style>
    <div class="roles-permissions">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-gray-700 uppercase font-bold">Vouchers</h2>
            </div>
            <div class="flex flex-wrap items-center">
                <a onclick="window.print()" class="bg-gray-200 text-gray-700 text-sm uppercase py-2 px-4 flex items-center rounded">

                    <span class="ml-2 text-xs font-semibold">Print</span>
                </a>
            </div>
        </div>
         <div id="printsection" class="flex flex-wrap sd w-12/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight bg-white">
            @foreach ($student as $key=>$value)
                 <div id="printsection"  class=" w-4/12 px-2 text-sm font-semibold text-gray-600 tracking-tight bg-white" >
                     <div style="border: 1px solid grey;border-bottom: none;" class="px-2 flex flex-wrap ">
                         <div class="w-11/12 px-4  text-sm font-semibold text-gray-600 text-center tracking-tight">Bank Copy</div>
                         <br>
                         <p class="w-2/12 py-4 text-sm   uppercase text-center tracking-tight bg-white text-center">
                             <img  src="{{asset('images/school.jpg')}}">
                         </p>
                         <p class="w-10/12  py-4 text-sm   uppercase text-center tracking-tight bg-white text-center">
                             <b>School Management System</b><br>
                             3956  Church Street,Staten Island<br>
                             <b>Habib Bank Limited</b><br>
                             Current A/C No:212-212122-22222<br>
                             issue-Date:{{$value->date}}
                         </p>
                     </div>
                     <div style="border: 1px solid grey;border-bottom: none;margin-top: 2px;" class="px-2 flex flex-wrap ">

                         <div class="w-2/12 px-1 py-1  text-sm font-semibold text-gray-600 text-left tracking-tight bg-white">
                             <b>Name:</b>
                         </div>
                         <div class="w-4/12 px-4  py-1 text-sm font-semibold text-gray-600 text-left tracking-tight bg-white">
                             {{$value->user->name}}
                         </div>
                         <div class="w-3/12 px-1 py-1  text-sm font-semibold text-gray-600 text-left tracking-tight bg-white">
                             <b>Challan No:</b>
                         </div>
                         <div class="w-3/12 px-4  py-1 text-sm font-semibold text-gray-600 text-left tracking-tight bg-white">
                             SM-00{{$value->id}}
                         </div>
                         <div class="w-2/12 px-1  py-1 text-sm font-semibold text-gray-600 text-left tracking-tight bg-white">
                             <b>  Class:</b>
                         </div>
                         <div class="w-2/12 px-4  py-1 text-sm font-semibold text-gray-600 text-left tracking-tight bg-white">
                             {{$value->class->class_name}}
                         </div>
                     </div>


                     <div style="border: 1px solid grey;border-bottom: none;margin-top:1px" class="px-2 flex flex-wrap ">
                         <div class="w-2/12 px-1  py-1 text-sm font-semibold text-gray-600 text-left tracking-tight bg-white">
                             <b>No</b>
                         </div>
                         <div class="w-6/12 px-1 py-1 text-sm font-semibold text-gray-600 text-left tracking-tight bg-white">
                             <b>Particulars</b>
                         </div>
                         <div class="w-4/12 px-1  py-1 text-sm font-semibold text-gray-600 text-right tracking-tight bg-white">
                             <b>Amount</b>
                         </div>
                         <div class="w-2/12 px-1  py-1 text-sm font-semibold text-gray-600 text-left tracking-tight bg-white">
                             <b> 1</b>
                         </div>
                         <div class="w-6/12 px-1  py-1 text-sm font-semibold text-gray-600 text-left tracking-tight bg-white">
                             Tuition Fee
                         </div>
                         <div class="w-4/12 px-1  py-1 text-sm font-semibold text-gray-600 text-right tracking-tight bg-white" style="height: 200px;">
                             {{$value->amount}}
                         </div>
                         <div class="w-6/12 px-1  py-1 text-sm font-semibold text-gray-600 text-left tracking-tight bg-white">
                             <b>Total Amount</b>
                         </div>
                         <div class="w-6/12 px-1  py-1 text-sm font-semibold text-gray-600 text-right tracking-tight bg-white" >
                             Rs: {{$value->amount}}

                         </div>
                     </div>
                     <div style="border: 1px solid grey;margin-top:1px" class="px-2 flex flex-wrap ">
                         <div class="w-8/12 px-1  py-1 text-sm font-semibold text-gray-600 text-left tracking-tight bg-white"><br>
                             <b>Issued By:</b> Online Admin Portal</div>
                         <div class="w-4/12 px-1  py-1 text-sm font-semibold text-gray-600 text-left tracking-tight bg-white"><br>
                             <b>Bank Stamp Sign</b></div><br><br><br>
                         <div class="w-12/12 px-1  py-1 text-sm font-semibold text-gray-600 text-left tracking-tight bg-white"><br>
                             <b>Note: </b>Keep this fee challan in custody and show it to the account office whenever required.</div>
                     </div>

                 </div>
                 <div id="printsection"  class=" w-4/12 px-2 text-sm font-semibold text-gray-600 tracking-tight bg-white" >
                     <div style="border: 1px solid grey;border-bottom: none;" class="px-2 flex flex-wrap ">
                         <div class="w-11/12 px-4  text-sm font-semibold text-gray-600 text-center tracking-tight">Student Copy</div>
                         <br>
                         <p class="w-2/12 py-4 text-sm   uppercase text-center tracking-tight bg-white text-center">
                             <img  src="{{asset('images/school.jpg')}}">
                         </p>
                         <p class="w-10/12  py-4 text-sm   uppercase text-center tracking-tight bg-white text-center">
                             <b>School Management System</b><br>
                             3956  Church Street,Staten Island<br>
                             <b>Habib Bank Limited</b><br>
                             Current A/C No:212-212122-22222<br>
                             issue-Date:{{$value->date}}
                         </p>
                     </div>
                     <div style="border: 1px solid black;border-bottom: none;margin-top: 2px" class="px-2 flex flex-wrap ">

                         <div class="w-2/12 px-1 py-1  text-sm font-semibold text-gray-600 text-left tracking-tight bg-white">
                             <b>Name:</b>
                         </div>
                         <div class="w-4/12 px-4  py-1 text-sm font-semibold text-gray-600 text-left tracking-tight bg-white">
                             {{$value->user->name}}
                         </div>
                         <div class="w-3/12 px-1 py-1  text-sm font-semibold text-gray-600 text-left tracking-tight bg-white">
                             <b>Challan No:</b>
                         </div>
                         <div class="w-3/12 px-4  py-1 text-sm font-semibold text-gray-600 text-left tracking-tight bg-white">
                             SM-00{{$value->id}}
                         </div>
                         <div class="w-2/12 px-1  py-1 text-sm font-semibold text-gray-600 text-left tracking-tight bg-white">
                             <b>  Class:</b>
                         </div>
                         <div class="w-2/12 px-4  py-1 text-sm font-semibold text-gray-600 text-left tracking-tight bg-white">
                             {{$value->class->class_name}}
                         </div>
                     </div>


                     <div style="border: 1px solid grey;border-bottom: none;" class="px-2 flex flex-wrap ">
                         <div class="w-2/12 px-1  py-1 text-sm font-semibold text-gray-600 text-left tracking-tight bg-white">
                             <b>No</b>
                         </div>
                         <div class="w-6/12 px-1 py-1 text-sm font-semibold text-gray-600 text-left tracking-tight bg-white">
                             <b>Particulars</b>
                         </div>
                         <div class="w-4/12 px-1  py-1 text-sm font-semibold text-gray-600 text-right tracking-tight bg-white">
                             <b>Amount</b>
                         </div>
                         <div class="w-2/12 px-1  py-1 text-sm font-semibold text-gray-600 text-left tracking-tight bg-white">
                             <b> 1</b>
                         </div>
                         <div class="w-6/12 px-1  py-1 text-sm font-semibold text-gray-600 text-left tracking-tight bg-white">
                             Tuition Fee
                         </div>
                         <div class="w-4/12 px-1  py-1 text-sm font-semibold text-gray-600 text-right tracking-tight bg-white" style="height: 200px;">
                             {{$value->amount}}
                         </div>
                         <div class="w-6/12 px-1  py-1 text-sm font-semibold text-gray-600 text-left tracking-tight bg-white">
                             <b>Total Amount</b>
                         </div>
                         <div class="w-6/12 px-1  py-1 text-sm font-semibold text-gray-600 text-right tracking-tight bg-white" >
                           Rs: {{$value->amount}}

                         </div>
                     </div>
                     <div style="border: 1px solid grey;margin-top:1px" class="px-2 flex flex-wrap ">
                         <div class="w-8/12 px-1  py-1 text-sm font-semibold text-gray-600 text-left tracking-tight bg-white"><br>
                             <b>Issued By:</b> Online Admin Portal</div>
                         <div class="w-4/12 px-1  py-1 text-sm font-semibold text-gray-600 text-left tracking-tight bg-white"><br>
                             <b>Bank Stamp Sign</b></div><br><br><br>
                         <div class="w-12/12 px-1  py-1 text-sm font-semibold text-gray-600 text-left tracking-tight bg-white"><br>
                             <b>Note: </b>Keep this fee challan in custody and show it to the account office whenever required.</div>
                     </div>

                 </div>
                 <div id="printsection"  class=" w-4/12 px-2 text-sm font-semibold text-gray-600 tracking-tight bg-white" >
                     <div style="border: 1px solid grey;border-bottom: none;" class="px-2 flex flex-wrap ">
                         <div class="w-11/12 px-4  text-sm font-semibold text-gray-600 text-center tracking-tight">School Copy</div>
                         <br>
                         <p class="w-2/12 py-4 text-sm   uppercase text-center tracking-tight bg-white text-center">
                             <img  src="{{asset('images/school.jpg')}}">
                         </p>
                         <p class="w-10/12  py-4 text-sm   uppercase text-center tracking-tight bg-white text-center">
                             <b>School Management System</b><br>
                             3956  Church Street,Staten Island<br>
                             <b>Habib Bank Limited</b><br>
                             Current A/C No:212-212122-22222<br>
                             issue-Date:{{$value->date}}
                         </p>
                     </div>
                     <div style="border: 1px solid grey;border-bottom: none;margin-top: 2px" class="px-2 flex flex-wrap ">

                         <div class="w-2/12 px-1 py-1  text-sm font-semibold text-gray-600 text-left tracking-tight bg-white">
                             <b>Name:</b>
                         </div>
                         <div class="w-4/12 px-4  py-1 text-sm font-semibold text-gray-600 text-left tracking-tight bg-white">
                             {{$value->user->name}}
                         </div>
                         <div class="w-3/12 px-1 py-1  text-sm font-semibold text-gray-600 text-left tracking-tight bg-white">
                             <b>Challan No:</b>
                         </div>
                         <div class="w-3/12 px-4  py-1 text-sm font-semibold text-gray-600 text-left tracking-tight bg-white">
                             SM-00{{$value->id}}
                         </div>
                         <div class="w-2/12 px-1  py-1 text-sm font-semibold text-gray-600 text-left tracking-tight bg-white">
                             <b>  Class:</b>
                         </div>
                         <div class="w-2/12 px-4  py-1 text-sm font-semibold text-gray-600 text-left tracking-tight bg-white">
                             {{$value->class->class_name}}
                         </div>
                     </div>


                     <div style="border: 1px solid grey;border-bottom: none;" class="px-2 flex flex-wrap ">
                         <div class="w-2/12 px-1  py-1 text-sm font-semibold text-gray-600 text-left tracking-tight bg-white">
                             <b>No</b>
                         </div>
                         <div class="w-6/12 px-1 py-1 text-sm font-semibold text-gray-600 text-left tracking-tight bg-white">
                             <b>Particulars</b>
                         </div>
                         <div class="w-4/12 px-1  py-1 text-sm font-semibold text-gray-600 text-right tracking-tight bg-white">
                             <b>Amount</b>
                         </div>
                         <div class="w-2/12 px-1  py-1 text-sm font-semibold text-gray-600 text-left tracking-tight bg-white">
                             <b> 1</b>
                         </div>
                         <div class="w-6/12 px-1  py-1 text-sm font-semibold text-gray-600 text-left tracking-tight bg-white">
                             Tuition Fee
                         </div>
                         <div class="w-4/12 px-1  py-1 text-sm font-semibold text-gray-600 text-right tracking-tight bg-white" style="height: 200px;">
                             {{$value->amount}}
                         </div>
                         <div class="w-6/12 px-1  py-1 text-sm font-semibold text-gray-600 text-left tracking-tight bg-white">
                             <b>Total Amount</b>
                         </div>
                         <div class="w-6/12 px-1  py-1 text-sm font-semibold text-gray-600 text-right tracking-tight bg-white" >
                             Rs: {{$value->amount}}

                         </div>
                     </div>
                     <div style="border: 1px solid grey;margin-top:1px" class="px-2 flex flex-wrap ">
                         <div class="w-8/12 px-1  py-1 text-sm font-semibold text-gray-600 text-left tracking-tight bg-white"><br>
                             <b>Issued By:</b> Online Admin Portal</div>
                         <div class="w-4/12 px-1  py-1 text-sm font-semibold text-gray-600 text-left tracking-tight bg-white"><br>
                             <b>Bank Stamp Sign</b></div><br><br><br>
                         <div class="w-12/12 px-1  py-1 text-sm font-semibold text-gray-600 text-left tracking-tight bg-white"><br>
                             <b>Note: </b>Keep this fee challan in custody and show it to the account office whenever required.</div>
                     </div>

                 </div>
          @endforeach
        </div>


 @endsection

@push('scripts')
<script>
    $(function() {
        $( ".deletebtn" ).on( "click", function(event) {
            event.preventDefault();
            $( "#deletemodal" ).toggleClass( "hidden" );
            var url = $(this).attr('data-url');
            $(".remove-record").attr("action", url);
        })

        $( "#deletemodelclose" ).on( "click", function(event) {
            event.preventDefault();
            $( "#deletemodal" ).toggleClass( "hidden" );
        })
    })
</script>
@endpush
