@extends('layouts.app')

@section('content')
    <div class="roles-permissions">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-gray-700 uppercase font-bold">Add Voucher</h2>
            </div>

         </div>
          <div class="table w-full mt-8 bg-white rounded">
            <form action="{{route('chairity.chairityupdaterequest')}}" method="POST" class="w-full max-w-xl px-6 py-12" enctype="multipart/form-data">
               @csrf
                 <input type="hidden" name="id" value="{{$chairity->id}}" id="id">
                <h2 class="text-gray-700 uppercase font-bold">Inovice Information</h2>
                <br>
                <div class="md:flex md:items-center mb-6">
                         <label class=" alert alert-success block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                            @if(session()->has('res'))
                                <div class="alert alert-success">
                                    {{ session()->get('res') }}
                                </div>
                            @endif
                        </label>
                      </div>

                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                            Name
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input name="name" value="{{$chairity->name}}" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" type="text">
                    </div>
                </div>
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                            Amount
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input name="amount" value="{{$chairity->amount}}" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" type="text">
                    </div>
                </div>
                <div class="md:flex md:items-center">
                    <div class="md:w-1/3"></div>
                    <div class="md:w-2/3">
                        <button class="shadow bg-blue-500 hover:bg-blue-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
                            Update
                        </button>
                    </div>
                </div>
            </form>
        </div>
        </div>


@endsection

@push('scripts')
    <script>
        $('#class').change(function(){
            var a=$('#class').find(":selected").val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        $.ajax({
            type:'POST',
            url:'{{url('getchairity')}}',
            data:{id:a},
            success:function(msg){
           // alert(msg);
            var obj=JSON.parse(msg);
            for(var i=0;i<obj.length;i++)
            {
                $('<option>').val(obj[i].id).text(obj[i].user.name).attr('data-attr', obj[i].user_id).appendTo('#chairityname');


            }
            }
            })
            })
        $('#chairityname').change(function() {
            var a = $('#chairityname').find(":selected").attr('data-attr');
            $('#user_id').val(a);
        });
    </script>
    <script>
        $(document).ready(function () {
        $(function() {
            $( "#datepicker-se" ).datepicker({ dateFormat: 'yy-mm-dd' });
        })

        })
    </script>
 @endpush
