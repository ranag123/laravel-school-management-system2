@extends('layouts.app')

@section('content')
    <div class="roles-permissions">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-gray-700 uppercase font-bold">Assessment</h2>
            </div>
        </div>
        <div class="table w-full mt-8 bg-white rounded">
            <form method="POST" action="{{route('assessment.updatemarksrequest')}}" class="w-full max-w-xl px-6 py-12" enctype="multipart/form-data">
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
                <input type="hidden" value="{{$asses[0]['assessment_id']}}" name="assessment_id">
                <input type="hidden" value="{{$asses[0]['id']}}" name="id">
                 <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                            Assessment Name
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input disabled value="{{$asses[0]['assessment']['name']}}" id="datepicker-se" autocomplete="off"
                               class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500"
                               type="text">
                    </div>
                </div>
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                            Student
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <select name="student_id" id="datepicker-se" autocomplete="off"
                               class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500"
                               type="text">
                              <option value="{{$asses[0]['user']['id']}}">{{$asses[0]['user']['name']}}</option>
                         </select>
                    </div>
                </div>
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                            Obtained Marks
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input name="obt_marks" value="{{$asses[0]['obt_marks']}}" id="datepicker-se" autocomplete="off"
                               class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500"
                               type="text">
                    </div>
                </div>
                <div class="md:flex md:items-center">
                    <div class="md:w-1/3"></div>
                    <div class="md:w-2/3">
                        <button
                            class="shadow bg-blue-500 hover:bg-blue-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded"
                            type="submit">
                            Update Marks
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>


@endsection

@push('scripts')


@endpush
