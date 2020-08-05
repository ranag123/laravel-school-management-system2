@extends('layouts.app')

@section('content')
    <div class="roles-permissions">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-gray-700 uppercase font-bold">Timetable</h2>
            </div>

         </div>
        <div class="table w-full mt-8 bg-white rounded">
            <form   method="POST" class="w-full max-w-xl px-6 py-12" enctype="multipart/form-data">
                 <label class=" alert alert-success block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                    @if(session()->has('res'))
                        <div class="alert alert-success">
                            {{ session()->get('res') }}
                        </div>
                    @endif
                </label>
                <br>
                @csrf
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
                            Class
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <select name="class_id" id="class" required class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" >
                            <option value="" disabled selected>--Select--</option>
                            @foreach($class as $key=>$value)
                          <option value="{{$value['id']}}">{{$value['class_name']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                            Subjects
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <select name="subject_id" required id="subject" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" >
                            <option value="" disabled selected>--Select--</option>
                            @foreach($subject as $key1=>$value1)
                                <option value="{{$value1['id']}}" data-value="{{$value1['teacher_id']}}">{{$value1['name']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                            Teacher
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <select name="teacher_id" id="teacherlist" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" >
                            <option value="" disabled selected>--Select--</option>

                        </select>
                    </div>
                </div>

                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                            Day
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <select name="date" required  autocomplete="off" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500"  >
                        <option value="Monday">Monday</option>
                        <option value="Tuesday">Tuesday</option>
                        <option value="Wednesday">Wednesday</option>
                        <option value="Thursday">Thursday</option>
                        <option value="Friday">Friday</option>
                        <option value="Saturday">Saturday</option>
                        </select>
                    </div>
                </div>

                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                            Start Time
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input name="start_time" required class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" type="time">
                    </div>
                </div>
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                            End Time
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input name="end_time" required class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" type="time">
                    </div>
                </div>
                <div class="md:flex md:items-center">
                    <div class="md:w-1/3"></div>
                    <div class="md:w-2/3">
                        <button class="shadow bg-blue-500 hover:bg-blue-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
                            Add Timetable
                        </button>
                    </div>
                </div>
            </form>
        </div>
        </div>


@endsection

@push('scripts')
    <script>
        $('#subject').change(function(){
            var a=$('#subject').find(":selected").attr('data-value');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        $.ajax({
            type:'POST',
            url:'{{url('getteacher')}}',
            data:{id:a},
            success:function(msg){
           console.log(msg);
            var obj=JSON.parse(msg);
            for(var i=0;i<obj.length;i++)
            {
                $('<option>').val(obj[i].id).text(obj[i].user.name).attr('data-attr', obj[i].user_id).appendTo('#teacherlist');
            }
            }
            })
            })
        $('#studentname').change(function() {
            var a = $('#studentname').find(":selected").attr('data-attr');
            $('#user_id').val(a);
        });
    </script>
    <script>
        $(document).ready(function () {
            $(function() {
                $( "#datepicker-se" ).datepicker(
                    {
                        beforeShowDay: function(date) {
                            var day = date.getDay();
                            return [(day != 0),  ''];
                        }
                    });
            })
        })
    </script>
    <script>
        $('form').submit(function(event){
            event.preventDefault();

            var data = new  FormData($(this)[0]);
            $.ajax({
                url: "{{route('timetable.timetableaddrequest')}}",
                type: 'POST',
                data: data,
                processData: false,
                contentType: false,
                success: function(data){
                     if(data!='success')
                    {
                        alert(data);
                    }
                     else{
                        $('form')[0].reset();
                    }

                }
        })
        })

                </script>
 @endpush
