@extends('layouts.app')

@section('content')
    <div class="roles-permissions">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-gray-700 uppercase font-bold">Edit PTM</h2>
            </div>

        </div>
        <div class="table w-full mt-8 bg-white rounded">
            <form action="{{route('ptm.updateptm')}}" method="POST" class="w-full max-w-xl px-6 py-12" enctype="multipart/form-data">
                @csrf
                <input name="id" value="{{$ptm['id']}}" type="hidden" >
                <div class="md:flex md:items-center mb-6">
                    <label class=" alert alert-success block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                        @if(session()->has('res'))
                            <div class="alert alert-success">
                                {{ session()->get('res') }}
                            </div>
                        @endif
                    </label>
                </div>
                @role('Admin')
                <input name="date" value="{{$ptm['date']}}"   type="hidden"  >
                <input name="time" value="{{$ptm['time']}}"   type="hidden"  >

                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                            Update Status
                        </label>
                    </div>
                    <div class="md:w-2/3">

                        <select name="status" id="datepicker-se" autocomplete="off" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" type="text"  >
                        <option value="Approved">Approved</option>
                        <option value="Reject">Reject</option>
                        </select>
                    </div>
                </div>

                @endrole
                @role('Parent')
                <input name="status" value="pending"   type="hidden"  >

                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                            Date
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input name="date" value="{{$ptm['date']}}" id="datepicker-se" autocomplete="off" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" type="text"  >
                    </div>
                </div>

                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                            Time
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input name="time" value="{{$ptm['time']}}" class="bg-gray-200 appearance-none border-2
                        border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none
                         focus:bg-white focus:border-blue-500" min="08:00" max="14:00" type="time">
                    </div>
                </div>
                @endrole
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
        $(document).ready(function () {
            $(function() {
                $( "#datepicker-se" ).datepicker({ dateFormat: 'yy-mm-dd' });
            })

        })
    </script>
@endpush
