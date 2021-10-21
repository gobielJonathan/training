<table class="table">
    <thead>
        <tr>
            <th>Email</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody class="user-list">
        @foreach ($users as $item)
        <tr data-id="{{$item->id}}">
            <td>{{$item->email}}</td>
            <td>{{$item->address}}</td>
            <td>{{$item->telephone}}</td>
            <td>
                <button data-id="{{$item->id}}" class="btn btn-sm bg-primary text-white btn-delete-user">Delete</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<script>
    $(document).ready(function () {
        $(".btn-delete-user").click(async function () {
            const id = $(this).data('id')
            await axios.post(`{{route('deleteUser', [], false)}}` , {
                id
            })
            $(`.user-list tr[data-id=${id}]`).remove()
        })
    })
</script>