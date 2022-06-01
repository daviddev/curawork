@foreach($commonUsers as $user)
    <div class="p-2 shadow rounded mt-2 text-white bg-dark">{{$user->name}} - {{$user->email}}</div>
@endforeach
