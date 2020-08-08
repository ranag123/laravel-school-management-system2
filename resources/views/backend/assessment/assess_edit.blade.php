@extends('layouts.app')

@section('content')
    <div class="roles-permissions">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-gray-700 uppercase font-bold">Update Assessment</h2>
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
                                  <option value="{{$assess['class_id']}}">{{$assess['class']['class_name']}}</option>
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

                                <option @if($value1['id']==$assess['subject_id']) selected @endif value="{{$value1['id']}}" data-value="{{$value1['teacher_id']}}">{{$value1['name']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                            Date
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input name="date" value="{{$assess['date']}}" id="datepicker-se" autocomplete="off" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" type="text"  >
                        <input name="id" value="{{$assess['id']}}" id="datepicker-se" autocomplete="off"  type="hidden"  >
                    </div>
                </div>

                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                            Name
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input name="name" value="{{$assess['name']}}" autocomplete="off" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" type="text"  >
                    </div>
                </div>
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                            Total Marks
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input  name="total" value="{{$assess['total']}}" autocomplete="off" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" type="number"  >
                    </div>
                </div>
                <div class="md:flex md:items-center">
                    <div class="md:w-1/3"></div>
                    <div class="md:w-2/3">
                        <button class="shadow bg-blue-500 hover:bg-blue-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
                            Update Assessment
                        </button>
                    </div>
                </div>
            </form>
        </div>
        </div>


@endsection

@push('scripts')

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
                url: "{{route('assessment.updateassessment')}}",
                type: 'POST',
                data: data,
                processData: false,
                contentType: false,
                success: function(data){
                     if(data!='success')
                    {
                        window.location="{{route('assessment.index')}}"
                    }
                     else{
                        $('form')[0].reset();
                    }

                }
        })
        })

                </script>

 @endpush
