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
            size: A4;

            width: 110mm;
            height: 197mm;
            margin: 0px;
            background:white;
        }
        .tracking-tight{
            margin-top: 2px;
        }
        @media print {
            body,* {
                background: white;
                margin: auto;

                padding: 0;
            }

            .content{width:100%}

            div.sd {
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

                width:100%;
                margin:0px
            }
            .sidebar  ,.justify-between{
                display:none !important;
            }
            .mt-16{margin:0px }
        }

    </style>  <div class="roles-permissions">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-gray-700 uppercase font-bold">Report Card       </h2>
            </div>
            <div class="flex flex-wrap items-center">
                <a onclick="window.print()" class="bg-gray-200 text-gray-700 text-sm uppercase py-2 px-4 flex items-center rounded">

                    <span class="ml-2 text-xs font-semibold">Print</span>
                </a>
            </div>
        </div><br>
        <div class="flex flex-wrap">

            <div   class=" w-3/12 px-2 text-sm font-semibold text-gray-600 tracking-tight " >
            </div>
            <div id="printsection"  class=" w-6/12 px-2 text-sm font-semibold text-gray-600 tracking-tight bg-white" >
                <div  class="px-2 flex flex-wrap ">

                    <p class="w-3/12 py-4 text-sm   uppercase text-center tracking-tight bg-white text-center">
                        <img  src="{{asset('images/school.jpg')}}" style="width: 80%;">
                    </p>
                    <p style="font-size: 20px;margin-top: 35px;" class="w-9/12  py-4 text-sm   uppercase  tracking-tight bg-white ">
                        <b>School Management System</b><br>
                         Report Card
                     </p>
                </div>
                <div class="flex flex-wrap">
                <div class="sd w-1/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight bg-white"></div>
                    <div   class="flex flex-wrap sd w-10/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight bg-white">
                        <div class="w-2/12 py-4 text-sm border-b-2  uppercase   tracking-tight bg-white  ">
                            Name:</div>
                        <div class="w-4/12 py-4 text-sm border-b-2  uppercase  tracking-tight bg-white  ">
                            @if(isset($a[0]['studentname']))
                                {{$a[0]['studentname']}}
                                @endif
                        </div>
                        <div class="w-2/12 py-4 text-sm border-b-2  uppercase   tracking-tight bg-white  ">
                            Class:</div>
                        <div class="w-4/12 py-4 text-sm  border-b-2 uppercase   tracking-tight bg-white   ">  @if(isset($a[0]['class_name']))
                                {{$a[0]['class_name']}}
                            @endif</div>

                        <div class="w-2/12 py-4 text-sm  border-b-2 uppercase   tracking-tight bg-white  ">
                            Year Level:</div>
                        <div class="w-4/12 py-4 text-sm  border-b-2 uppercase   tracking-tight bg-white  ">  @if(isset($a[0]['class_numeric']))
                                {{$a[0]['class_numeric']}}
                            @endif</div>
                        <div class="w-2/12 py-4 text-sm  border-b-2 uppercase   tracking-tight bg-white  ">
                            Advisor:
                        </div>
                        <div class="w-4/12 py-4 text-sm  border-b-2 uppercase   tracking-tight bg-white  ">
                            @if(isset($teacher['name']))
                                {{$teacher['name']}}
                            @endif
                        </div>
                    </div>
                </div>                <br>
                <br>

                <div class="flex flex-wrap items-center text-gray-700 border-t-2 border-b-2 border-l-4 border-r-4 border-gray-300">
                    <div class="w-3/12 px-4 py-2 text-sm font-semibold text-gray-600 tracking-tight">#</div>
                    <div class="w-3/12 px-4 py-2 text-sm font-semibold text-gray-600 tracking-tight">Subject </div>
                    <div class="w-3/12 px-4 py-2 text-sm font-semibold text-gray-600 tracking-tight">Obt. Marks </div>
                    <div class="w-3/12 px-4 py-2 text-sm font-semibold text-gray-600 tracking-tight">Total Marks </div>
                </div>
                <?php $i=1; $sum=0;?>
                @foreach ($subject  as $key=>$value)
                    <?php $sum=0;?>
                    <?php $data1=array();?>
                        @foreach($a as $key1=>$value1)
                    @if($value['id']==$value1['subject_id'])
                        <?php
                                $data['name']=$value['name'];
                                $data['sum']=$value1['total'];
                                $data['obt_marks']=$value1['obt_marks'];
                                $data1[]=$data;
                         ?>
                        @endif
                        @endforeach
                    @if(array_sum(array_column($data1,'sum'))!=0)
                    <div class="flex flex-wrap  text-gray-700 border-t-2 border-b-2 border-l-4 border-r-4 border-gray-300">
                        <div class="w-3/12 px-4 py-2 text-sm font-semibold text-gray-600 tracking-tight">{{$i}}</div>
                        <div class="w-3/12 px-4 py-2 text-sm font-semibold text-gray-600 tracking-tight">{{$value['name']}} </div>
                        <div class="w-3/12 px-4 py-2 text-sm font-semibold text-gray-600 tracking-tight">{{ array_sum(array_column($data1,'obt_marks'))}} </div>
                        <div class="w-3/12 px-4 py-2 text-sm font-semibold text-gray-600 tracking-tight">{{ array_sum(array_column($data1,'sum'))}} </div>
                      </div>
                    <?php $i++;?>
                        @endif
                @endforeach <br>
                <br>
                <br>
                </div>
   @endsection
    </div>
    </div>
        @push('scripts')
            <script>
                $(function() {
                    $( ".deletebtn" ).on( "click", function(event) {
                        event.preventDefault();
                        $( "#deletemodal" ).toggleClass( "hidden" );
                        var url = $(this).attr('data-url');
                        $(".remove-record").attr("action", url);
                    });

                    $( "#deletemodelclose" ).on( "click", function(event) {
                        event.preventDefault();
                        $( "#deletemodal" ).toggleClass( "hidden" );
                    })
                });
            </script>
    @endpush
