@extends('layouts.app')

@section('content')
<style>
    nav {
          background-color: #f2f4f6;
          display: flex;
          }

          .nav-link {
          flex: 1;
          text-align: center;
          text-decoration: none;
          padding: .5rem;
          border-bottom: 2px solid transparent;
          }

          .nav-link:hover {
          border-bottom-color: rgba(0,0,0,.05);
          }

          .nav-link.active {
          border-bottom-color: #1ee3cf;
          }

          section {
          margin-top: .5rem;
          }

          .tab {
          display: none;
          }

          .tab.active {
          display: block;
          }
          </style>

   <div class="roles-permissions">

       <div class="flex items-center justify-between mb-6">
           <div>
               <h2 class="text-gray-700 uppercase font-bold">Timetable</h2>
           </div>      @role('Admin')
       <div class="flex flex-wrap items-center">
           <a href="{{ route('timetable.create') }}" class="bg-gray-200 text-gray-700 text-sm uppercase py-2 px-4 flex items-center rounded">
               <svg class="w-3 h-3 fill-current" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="plus" class="svg-inline--fa fa-plus fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"></path></svg>
               <span class="ml-2 text-xs font-semibold">Add</span>
           </a>
       </div>
           @endrole
       </div>
       <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
       <nav>
           <a href="#" class="nav-link active" data-target="tab-1">Monday</a>
           <a href="#" class="nav-link " data-target="tab-2">Tuesday</a>
           <a href="#" class="nav-link " data-target="tab-3">Wednesday</a>
           <a href="#" class="nav-link " data-target="tab-4">Thursday</a>
           <a href="#" class="nav-link " data-target="tab-5">Friday</a>
           <a href="#" class="nav-link " data-target="tab-6">Saturday</a>
       </nav>

       <section>
           <div class="mt-8 bg-white rounded border-b-4 border-gray-300">
               <div class="flex flex-wrap items-center uppercase text-sm font-semibold bg-gray-300 text-gray-600 rounded-tl rounded-tr">
                   <div class="w-1/12 px-4 py-3">id</div>
                   <div class="w-2/12 px-4 py-3">Teacher</div>
                   <div class="w-2/12 px-4 py-3">Class</div>
                   <div class="w-1/12 px-4 py-3">Start </div>
                   <div class="w-1/12 px-4 py-3">End </div>
                   <div class="w-2/12 px-4 py-3">Subject </div>
                   @role('Admin')
                    <div class="w-2/12 px-4 py-3 text-right">Action</div>
                   @endrole
               </div>
           </div>
           @foreach($student as $key=>$value)

           @if($value->date=="Monday")
                   <div class="tab active" data-tab="tab-1">
                        <div class="flex flex-wrap items-center text-gray-700 border-t-2 border-2 border-r-4 border-gray-300 bg-white">
                   <div class="w-1/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $value->id }}</div>
                   @foreach($users as $key1=>$value1)
                       @if($value->teacher->user_id==$value1->id)
                       <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $value1->name ?? '' }}</div>
                   @endif
                           @endforeach
                            <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $value->class->class_name ?? '' }}</div>
                  <div class="w-1/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $value->start_time ?? '' }}</div>
                   <div class="w-1/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $value->end_time ?? '' }}</div>
                   <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $value->subjects->name ?? '' }}</div>

                    <div class="w-2/12 flex items-center justify-end px-3">


                       @role('Admin')
                       <a href="{{ route('timetable.edit',$value->id) }}" class="ml-1">
                           <svg class="h-6 w-6 fill-current text-gray-600" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="pen-square" class="svg-inline--fa fa-pen-square fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M400 480H48c-26.5 0-48-21.5-48-48V80c0-26.5 21.5-48 48-48h352c26.5 0 48 21.5 48 48v352c0 26.5-21.5 48-48 48zM238.1 177.9L102.4 313.6l-6.3 57.1c-.8 7.6 5.6 14.1 13.3 13.3l57.1-6.3L302.2 242c2.3-2.3 2.3-6.1 0-8.5L246.7 178c-2.5-2.4-6.3-2.4-8.6-.1zM345 165.1L314.9 135c-9.4-9.4-24.6-9.4-33.9 0l-23.1 23.1c-2.3 2.3-2.3 6.1 0 8.5l55.5 55.5c2.3 2.3 6.1 2.3 8.5 0L345 199c9.3-9.3 9.3-24.5 0-33.9z"></path></svg>
                       </a>
                       <a href="{{ route('timetable.destroy', $value->id) }}" data-url="{!! URL::route('student.destroy', $value->id) !!}" class="deletestudent ml-1 bg-gray-600 block p-1 border border-gray-600 rounded-sm">
                           <svg class="h-3 w-3 fill-current text-gray-100" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="trash" class="svg-inline--fa fa-trash fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16zM53.2 467a48 48 0 0 0 47.9 45h245.8a48 48 0 0 0 47.9-45L416 128H32z"></path></svg>
                       </a>
                       @endrole
                   </div>
               </div>
                   </div>
               @elseif($value->date=="Tuesday")
                   <div class="tab" data-tab="tab-2">
                        <div class="flex flex-wrap items-center text-gray-700 border-t-2 border-4 border-r-4 border-gray-300 bg-white">
                           <div class="w-1/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $value->id }}</div>
                           @foreach($users as $key1=>$value1)
                               @if($value->teacher->user_id==$value1->id)
                                   <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $value1->name ?? '' }}</div>
                               @endif
                           @endforeach
                            <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $value->class->class_name ?? '' }}</div>
                            <div class="w-1/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $value->start_time ?? '' }}</div>
                            <div class="w-1/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $value->end_time ?? '' }}</div>
                            <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $value->subjects->name ?? '' }}</div>

                            <div class="w-2/12 flex items-center justify-end px-3">


                               @role('Admin')
                               <a href="{{ route('timetable.edit',$value->id) }}" class="ml-1">
                                   <svg class="h-6 w-6 fill-current text-gray-600" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="pen-square" class="svg-inline--fa fa-pen-square fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M400 480H48c-26.5 0-48-21.5-48-48V80c0-26.5 21.5-48 48-48h352c26.5 0 48 21.5 48 48v352c0 26.5-21.5 48-48 48zM238.1 177.9L102.4 313.6l-6.3 57.1c-.8 7.6 5.6 14.1 13.3 13.3l57.1-6.3L302.2 242c2.3-2.3 2.3-6.1 0-8.5L246.7 178c-2.5-2.4-6.3-2.4-8.6-.1zM345 165.1L314.9 135c-9.4-9.4-24.6-9.4-33.9 0l-23.1 23.1c-2.3 2.3-2.3 6.1 0 8.5l55.5 55.5c2.3 2.3 6.1 2.3 8.5 0L345 199c9.3-9.3 9.3-24.5 0-33.9z"></path></svg>
                               </a>
                               <a href="{{ route('timetable.destroy', $value->id) }}"  class="deletestudent ml-1 bg-gray-600 block p-1 border border-gray-600 rounded-sm">
                                   <svg class="h-3 w-3 fill-current text-gray-100" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="trash" class="svg-inline--fa fa-trash fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16zM53.2 467a48 48 0 0 0 47.9 45h245.8a48 48 0 0 0 47.9-45L416 128H32z"></path></svg>
                               </a>
                               @endrole
                           </div>
                       </div>
                   </div>
               @elseif($value->date=="Wednesday")
                           <div class="tab" data-tab="tab-3">
                                <div class="flex flex-wrap items-center text-gray-700 border-t-2 border-4 border-r-4 border-gray-300 bg-white">
                           <div class="w-1/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $value->id }}</div>
                           @foreach($users as $key1=>$value1)
                               @if($value->teacher->user_id==$value1->id)
                                   <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $value1->name ?? '' }}</div>
                               @endif
                           @endforeach
                                    <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $value->class->class_name ?? '' }}</div>
                                    <div class="w-1/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $value->start_time ?? '' }}</div>
                                    <div class="w-1/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $value->end_time ?? '' }}</div>
                                    <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $value->subjects->name ?? '' }}</div>

                                    <div class="w-2/12 flex items-center justify-end px-3">


                               @role('Admin')
                               <a href="{{ route('timetable.edit',$value->id) }}" class="ml-1">
                                   <svg class="h-6 w-6 fill-current text-gray-600" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="pen-square" class="svg-inline--fa fa-pen-square fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M400 480H48c-26.5 0-48-21.5-48-48V80c0-26.5 21.5-48 48-48h352c26.5 0 48 21.5 48 48v352c0 26.5-21.5 48-48 48zM238.1 177.9L102.4 313.6l-6.3 57.1c-.8 7.6 5.6 14.1 13.3 13.3l57.1-6.3L302.2 242c2.3-2.3 2.3-6.1 0-8.5L246.7 178c-2.5-2.4-6.3-2.4-8.6-.1zM345 165.1L314.9 135c-9.4-9.4-24.6-9.4-33.9 0l-23.1 23.1c-2.3 2.3-2.3 6.1 0 8.5l55.5 55.5c2.3 2.3 6.1 2.3 8.5 0L345 199c9.3-9.3 9.3-24.5 0-33.9z"></path></svg>
                               </a>
                               <a href="{{ route('timetable.destroy', $value->id) }}" data-url="{!! URL::route('student.destroy', $value->id) !!}" class="deletestudent ml-1 bg-gray-600 block p-1 border border-gray-600 rounded-sm">
                                   <svg class="h-3 w-3 fill-current text-gray-100" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="trash" class="svg-inline--fa fa-trash fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16zM53.2 467a48 48 0 0 0 47.9 45h245.8a48 48 0 0 0 47.9-45L416 128H32z"></path></svg>
                               </a>
                               @endrole
                           </div>
                       </div>
                           </div>
                       @elseif($value->date=="Thursday")
                                   <div class="tab" data-tab="tab-4">
                                        <div class="flex flex-wrap items-center text-gray-700 border-t-2 border-4 border-r-4 border-gray-300 bg-white">
                           <div class="w-1/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $value->id }}</div>
                           @foreach($users as $key1=>$value1)
                               @if($value->teacher->user_id==$value1->id)
                                   <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $value1->name ?? '' }}</div>
                               @endif
                           @endforeach
                                            <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $value->class->class_name ?? '' }}</div>
                                            <div class="w-1/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $value->start_time ?? '' }}</div>
                                            <div class="w-1/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $value->end_time ?? '' }}</div>
                                            <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $value->subjects->name ?? '' }}</div>

                                            <div class="w-2/12 flex items-center justify-end px-3">


                               @role('Admin')
                               <a href="{{ route('timetable.edit',$value->id) }}" class="ml-1">
                                   <svg class="h-6 w-6 fill-current text-gray-600" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="pen-square" class="svg-inline--fa fa-pen-square fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M400 480H48c-26.5 0-48-21.5-48-48V80c0-26.5 21.5-48 48-48h352c26.5 0 48 21.5 48 48v352c0 26.5-21.5 48-48 48zM238.1 177.9L102.4 313.6l-6.3 57.1c-.8 7.6 5.6 14.1 13.3 13.3l57.1-6.3L302.2 242c2.3-2.3 2.3-6.1 0-8.5L246.7 178c-2.5-2.4-6.3-2.4-8.6-.1zM345 165.1L314.9 135c-9.4-9.4-24.6-9.4-33.9 0l-23.1 23.1c-2.3 2.3-2.3 6.1 0 8.5l55.5 55.5c2.3 2.3 6.1 2.3 8.5 0L345 199c9.3-9.3 9.3-24.5 0-33.9z"></path></svg>
                               </a>
                               <a href="{{ route('timetable.destroy', $value->id) }}" data-url="{!! URL::route('student.destroy', $value->id) !!}" class="deletestudent ml-1 bg-gray-600 block p-1 border border-gray-600 rounded-sm">
                                   <svg class="h-3 w-3 fill-current text-gray-100" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="trash" class="svg-inline--fa fa-trash fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16zM53.2 467a48 48 0 0 0 47.9 45h245.8a48 48 0 0 0 47.9-45L416 128H32z"></path></svg>
                               </a>
                               @endrole
                           </div>
                       </div>
                                   </div>
                               @elseif($value->date=="Friday")
                                           <div class="tab" data-tab="tab-5">
                                                <div class="flex flex-wrap items-center text-gray-700 border-t-2 border-4 border-r-4 border-gray-300 bg-white">
                           <div class="w-1/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $value->id }}</div>
                           @foreach($users as $key1=>$value1)
                               @if($value->teacher->user_id==$value1->id)
                                   <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $value1->name ?? '' }}</div>
                               @endif
                           @endforeach
                                                    <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $value->class->class_name ?? '' }}</div>
                                                    <div class="w-1/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $value->start_time ?? '' }}</div>
                                                    <div class="w-1/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $value->end_time ?? '' }}</div>
                                                    <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $value->subjects->name ?? '' }}</div>

                                                    <div class="w-2/12 flex items-center justify-end px-3">


                               @role('Admin')
                               <a href="{{ route('timetable.edit',$value->id) }}" class="ml-1">
                                   <svg class="h-6 w-6 fill-current text-gray-600" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="pen-square" class="svg-inline--fa fa-pen-square fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M400 480H48c-26.5 0-48-21.5-48-48V80c0-26.5 21.5-48 48-48h352c26.5 0 48 21.5 48 48v352c0 26.5-21.5 48-48 48zM238.1 177.9L102.4 313.6l-6.3 57.1c-.8 7.6 5.6 14.1 13.3 13.3l57.1-6.3L302.2 242c2.3-2.3 2.3-6.1 0-8.5L246.7 178c-2.5-2.4-6.3-2.4-8.6-.1zM345 165.1L314.9 135c-9.4-9.4-24.6-9.4-33.9 0l-23.1 23.1c-2.3 2.3-2.3 6.1 0 8.5l55.5 55.5c2.3 2.3 6.1 2.3 8.5 0L345 199c9.3-9.3 9.3-24.5 0-33.9z"></path></svg>
                               </a>
                               <a href="{{ route('timetable.destroy', $value->id) }}" data-url="{!! URL::route('student.destroy', $value->id) !!}" class="deletestudent ml-1 bg-gray-600 block p-1 border border-gray-600 rounded-sm">
                                   <svg class="h-3 w-3 fill-current text-gray-100" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="trash" class="svg-inline--fa fa-trash fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16zM53.2 467a48 48 0 0 0 47.9 45h245.8a48 48 0 0 0 47.9-45L416 128H32z"></path></svg>
                               </a>
                               @endrole
                           </div>
                       </div>
                                           </div>
                                       @elseif($value->date=="Saturday")
                                                   <div class="tab" data-tab="tab-6">
                                                        <div class="flex flex-wrap items-center text-gray-700 border-t-2 border-4 border-r-4 border-gray-300 bg-white">
                           <div class="w-1/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $value->id }}</div>
                           @foreach($users as $key1=>$value1)
                               @if($value->teacher->user_id==$value1->id)
                                   <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $value1->name ?? '' }}</div>
                               @endif
                           @endforeach
                                                            <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $value->class->class_name ?? '' }}</div>
                                                            <div class="w-1/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $value->start_time ?? '' }}</div>
                                                            <div class="w-1/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $value->end_time ?? '' }}</div>
                                                            <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $value->subjects->name ?? '' }}</div>

                                                            <div class="w-2/12 flex items-center justify-end px-3">


                               @role('Admin')
                               <a href="{{ route('timetable.edit',$value->id) }}" class="ml-1">
                                   <svg class="h-6 w-6 fill-current text-gray-600" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="pen-square" class="svg-inline--fa fa-pen-square fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M400 480H48c-26.5 0-48-21.5-48-48V80c0-26.5 21.5-48 48-48h352c26.5 0 48 21.5 48 48v352c0 26.5-21.5 48-48 48zM238.1 177.9L102.4 313.6l-6.3 57.1c-.8 7.6 5.6 14.1 13.3 13.3l57.1-6.3L302.2 242c2.3-2.3 2.3-6.1 0-8.5L246.7 178c-2.5-2.4-6.3-2.4-8.6-.1zM345 165.1L314.9 135c-9.4-9.4-24.6-9.4-33.9 0l-23.1 23.1c-2.3 2.3-2.3 6.1 0 8.5l55.5 55.5c2.3 2.3 6.1 2.3 8.5 0L345 199c9.3-9.3 9.3-24.5 0-33.9z"></path></svg>
                               </a>
                               <a href="{{ route('timetable.destroy', $value->id) }}" data-url="{!! URL::route('student.destroy', $value->id) !!}" class="deletestudent ml-1 bg-gray-600 block p-1 border border-gray-600 rounded-sm">
                                   <svg class="h-3 w-3 fill-current text-gray-100" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="trash" class="svg-inline--fa fa-trash fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16zM53.2 467a48 48 0 0 0 47.9 45h245.8a48 48 0 0 0 47.9-45L416 128H32z"></path></svg>
                               </a>
                               @endrole
                           </div>
                       </div>
                                                   </div>
               @endif

           @endforeach
       </section>

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
    $('.nav-link').on('click', function(e) {
        e.preventDefault();
        $('.nav-link').removeClass('active');
        $(this).addClass('active');
        $('.tab').removeClass('active');
        var tabID = $(this).attr('data-target');
        $('.tab[data-tab="' + tabID + '"]').addClass('active');
    });
</script>
@endpush
