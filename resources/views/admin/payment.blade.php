<div class="d-flex justify-content-end mb-4">
    <!-- Button trigger modal -->
<button type="button" class="btn btn-sm bg-primary text-white" data-toggle="modal" data-target="#add-payment-modal">
    Add New Payment
  </button>
</div>

<!-- Modal -->
<div class="modal fade" id="add-payment-modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Payment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
               <form action="{{route('addPayment',[], false)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control" name="name"  aria-describedby="emailHelpId" placeholder="Name">
                  </div>
                  <div class="form-group">
                    <input type="number" class="form-control" name="number"  aria-describedby="emailHelpId" placeholder="Number">
                  </div>
  
                  <button type="submit" class="btn btn-sm bg-primary w-100 text-white">Submit</button>
               </form>
            </div>
        </div>
    </div>
</div>

<table class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Number</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody class="payment-list">
        @foreach ($payment_types as $item)
        <tr data-id="{{$item->id}}">
            <td>{{$item->payment_name}}</td>
            <td>{{$item->payment_number}}</td>
            <td>
                <button data-id='{{$item->id}}'  class="btn btn-delete-payment btn-sm bg-primary text-white">Delete</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<script>
    $(document).ready(function () {
        $(".btn-delete-payment").click(async function () {
            const id = $(this).data('id')
            await axios.post(`{{route('removePayment', [], false)}}`, {
                id
            })
            $(`.payment-list tr[data-id=${id}]`).remove()
        })
    })
</script>
