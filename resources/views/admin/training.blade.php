<div class="d-flex justify-content-end mb-4">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-sm bg-primary text-white" data-toggle="modal"
        data-target="#new-training-modal">
        Add New Training
    </button>
</div>

<!-- Modal -->
<div class="modal fade" id="new-training-modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Training</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('addTraining',[], false)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <input type="file" accept="image/*" class="form-control-file" name="image"  placeholder=""
                            aria-describedby="fileHelpId">

                        <p class="form-text text-muted">
                            If you want convert pdf file to image file, try this
                            <a href="https://smallpdf.com/id/pdf-ke-jpg">link</a>
                        </p>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" name="title"  aria-describedby="helpId"
                            placeholder="Title">
                    </div>

                    <div class="form-group">
                        <input type="number" class="form-control" name="price"  aria-describedby="helpId"
                            placeholder="Price">
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
            <th>Id</th>
            <th>Image</th>
            <th>Title</th>
            <th>Price</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody class="training-list">
        @foreach ($training as $item)
        <tr data-id="{{$item->id}}">
            <td>{{$item->id}}</td>
            <td>
                <img src="{{$item->image}}" alt="training-thumbnail" style="width: 100px;">
            </td>
            <td>{{$item->title}}</td>
            <td>{{$item->price}}</td>
            <td class="training-status">{{$item->status == App\Models\Training::ACTIVE ? "Active" : "Not Active"}}</td>
            <td>
                <button data-id="{{$item->id}}"
                    class="btn btn-delete-training btn-sm bg-primary text-white">Delete</button>
                <button data-id="{{$item->id}}" class="btn btn-toggle-status btn-sm bg-primary text-white">Change
                    Status</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<script>
    $(document).ready(function () {
        $(".btn-toggle-status").click(async function () {
            const id = $(this).data('id')
            const {
                data
            } = await axios.post('{{route("toggleTraining", [], false)}}', {
                id
            })
            $(`.training-list tr[data-id='${id}'] .training-status`).html(data)
        })

        $(".btn-delete-training").click(async function () {
            const id = $(this).data('id')
            const {
                data
            } = await axios.post('{{route("deleteTraining", [], false)}}', {
                id
            })
            $(`.training-list tr[data-id='${id}']`).remove()
        })
    })
</script>