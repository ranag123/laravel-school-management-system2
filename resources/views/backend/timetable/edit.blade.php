@extends('layouts.app')

@section('content')
    <div class="roles-permissions">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-gray-700 uppercase font-bold"></h2>
            </div>

         </div>
        <div class="table w-full mt-8 bg-white rounded">
            <form action="{{route('timetable.timetableupdaterequest')}}" method="POST" class="w-full max-w-xl px-6 py-12" enctype="multipart/form-data">
               @csrf
                 <h2 class="text-gray-700 uppercase font-bold">Update Timetable</h2>
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
                            Class
                        </label>
                    </div>
                    <input type="hidden" name="id" value="{{$timetable->id}}">
                     <div class="md:w-2/3">
                        <select name="class_id" id="class" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" >
                            <option value="" disabled >--Select--</option>
                            @foreach($class as $key=>$value)

                          <option value="{{$value['id']}}" @if($value['id']==$timetable->class_id) selected @endif>{{$value['class_name']}}</option>
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
                        <select name="subject_id" id="subject" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" >
                            <option value="" disabled selected>--Select--</option>
                            @foreach($subject as $key1=>$value1)
                                <option value="{{$value1['id']}}" @if($value1['id']==$timetable->subject_id) selected @endif data-value="{{$value1['teacher_id']}}">{{$value1['name']}}</option>
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
                            @foreach($users as $key1=>$value1)
                                @if($timetable->teacher->user_id==$value1->id)
                                    <option value="{{$timetable->teacher_id}}" disabled selected>{{ $value1->name }}</option>
                                 @endif
                            @endforeach

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
                        <select name="date"  autocomplete="off" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500"  >
                        <option value="Monday"  @if("Monday"==$timetable->date) selected @endif>Monday</option>
                        <option value="Tuesday" @if("Tuesday"==$timetable->date) selected @endif>Tuesday</option>
                        <option value="Wednesday" @if("Wednesday"==$timetable->date) selected @endif>Wednesday</option>
                        <option value="Thursday" @if("Thursday"==$timetable->date) selected @endif>Thursday</option>
                        <option value="Friday" @if("Friday"==$timetable->date) selected @endif>Friday</option>
                        <option value="Saturday" @if("Saturday"==$timetable->date) selected @endif>Saturday</option>
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
                        <input name="start_time" value="{{$timetable->start_time}}" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" type="time">
                    </div>
                </div>
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                            End Time
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input name="end_time" value="{{$timetable->end_time}}" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" type="time">
                    </div>
                </div>
                <div class="md:flex md:items-center">
                    <div class="md:w-1/3"></div>
                    <div class="md:w-2/3">
                        <button class="shadow bg-blue-500 hover:bg-blue-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
                            Update Timetable
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
             var obj=JSON.parse(msg);
            for(var i=0;i<obj.length;i++)
            {
                $('#teacherlist').find('option').remove().end();
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
 @endpush
