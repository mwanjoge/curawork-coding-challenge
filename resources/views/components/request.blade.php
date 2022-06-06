@foreach ($userRequests as $userRequest)
<div class="my-2 shadow text-white bg-dark p-1" id="">
    <div class="d-flex justify-content-between">
      <table class="ms-1">
        <td class="align-middle">
            @if ($mode == 'sent')
            {{$userRequest->getRequestedUser()->name}}</td>
            @else
            {{$userRequest->user->name}}</td>
            @endif
        <td class="align-middle"> - </td>
        <td class="align-middle">{{$userRequest->user->email}}</td>
        <td class="align-middle">
      </table>
      <div>
        @if ($mode == 'sent')
          <button id="cancel_request_btn_" data-request-id="{{$userRequest->id}}" class="btn btn-danger me-1 withdraw_request_btn"
            >Withdraw Request</button>
        @else
          <button id="accept_request_btn_" class="btn btn-primary me-1"
            onclick="">Accept</button>
        @endif
      </div>
    </div>
</div>
@endforeach
