@foreach ($suggestions as $suggestion)
    <div class="my-2 shadow  text-white bg-dark p-1" id="">
        <div class="d-flex justify-content-between">
        <table class="ms-1">
            <td class="align-middle">{{$suggestion->name}}</td>
            <td class="align-middle"> - </td>
            <td class="align-middle">{{$suggestion->email}}</td>
            <td class="align-middle">
        </table>
        <div>
            <button data-suggested-connection-id="{{$suggestion->id}}" class="btn btn-primary me-1 create_send_request">Connect</button>
        </div>
        </div>
    </div>
@endforeach

