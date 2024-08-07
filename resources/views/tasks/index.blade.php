@extends('template.default')

@section('content')
<div class="row ">
    <div class="col-xs-1 col-md-4">
        <form method="post" action="/task/create">
            <input type="text" class="form-control" id="title" name="title" placeholder="Insert task name">
            @if($errors->has('title'))
                <div class="text-red">*{{ $errors->first('title') }}</div>
            @endif
            <button type="submit" class="btn btn-primary w-full mt-4">Add</button>
            @csrf
        </form>
    </div>
    <div class="col-md-8">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th colspan=2 scope="col">Task</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($tasks as $task)
                <tr>
                    <th scope="row">{{$task->id}}</th>
                    <td><span @if ($task->completed_at !== null) class="completed" @endif>{{$task->title}}</span></td>
                    <td>
                        @if ($task->completed_at == null)
                            <form method="post" action="{{route('task.delete', $task->id)}}">
                                <button type="submit" class="btn btn-danger pull-right">
                                    <i class="fa fa-times" aria-hidden="true"></i>
                                </button>
                                @csrf
                            </form>
                            <form method="post" action="{{route('task.complete', $task->id)}}">
                                <button type="submit" class="btn btn-success pull-right mr-4">
                                    <i class="fa fa-check" aria-hidden="true"></i>
                                </button>
                                @csrf
                            </form>

                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
