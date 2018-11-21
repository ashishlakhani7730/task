@extends('layouts.app')

@section('content')
<style>
  .uper {
    margin-top: 10px;
  }
</style>
<div class="container">
	@if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div><br />
	@endif
<div class="card uper">
  <div class="card-header">
    New Tasks
  </div>
  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
	
      <form method="post" action="{{ route('task.store') }}">
          <div class="form-group">
              @csrf
              <label for="name">Title:</label>
              <input type="text" class="form-control" name="title"/>
          </div>
          <button type="submit" class="btn btn-primary">Create</button>
      </form>
  </div>
</div>

<div class="card uper">
	<div class="card-header">
		Tasks
	</div>
	<table class="table table-striped">
    <tbody>
        @foreach($tasks as $task)
        <tr>
			@if($task->is_complete == 1)         
            <td style="text-decoration:line-through">{{$task->title}}</td>
			<td></td>
            @else
			<td>{{$task->title}}</td>
			<td style="text-align:right"><a href="{{ route('task.edit',$task->id) }}" class="btn btn-primary">Complete</a></td>
			@endif
			
        </tr>
        @endforeach
    </tbody>
  </table>
  {{ $tasks->links() }}
</div>
</div>
@endsection