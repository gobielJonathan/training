<!-- Button trigger modal -->
<div class="d-flex justify-content-end mb-3">
    <button type="button" class="btn btn-sm bg-primary text-white" data-toggle="modal" data-target="#stimulus-modal">
        Add Stimulus
    </button>
</div>

<!-- Modal -->
<div class="modal fade" id="stimulus-modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Stimulus</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('addStimulus', [], false)}}" method="post">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control" name="name" 
                            placeholder="Name">
                    </div>

                    <div class="form-group">
                        <input type="date" class="form-control" name="start" 
                            placeholder="Start Date">
                    </div>

                    <div class="form-group">
                        <input type="date" class="form-control" name="end" 
                            placeholder="End Date">
                    </div>


                    <div class="form-group">
                        <select name="training_id" class="form-control">
                            @foreach($training as $t) 
                                <option value="{{$t->id}}">{{$t->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button class="btn w-100 bg-primary text-white">
                        Add
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<template id="stimulus-template">
    <tr class="stimulus-wrapper">
        <td>
            <div class="form-check form-check-inline">
                <label class="form-check-label">
                    <input class="form-check-input" type="radio" name='stimulus' value="1" required>
                </label>
            </div>
        </td>
        <td>
            <span class="stimulus-label"></span>
        </td>
        <td>
            <span class="stimulus-periode"></span>
        </td>
        <td>
            <span class="stimulus-training"></span>
        </td>
        <td>
            <button type="button" class="btn btn-remove-stimulus btn-sm bg-transparent">
                <i class="fa fa-trash" aria-hidden="true"></i>
            </button>
        </td>
    </tr>
</template>

<form action="{{route('mapStimulus', [], false)}}" method="post">
    @csrf
    <div class="row">
        <div class="col-12 mb-3">
            <h5>Stimulus</h5>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Stimulus Name</th>
                        <th>Periode</th>
                        <th>Training</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="stimulus-list">
                    
                </tbody>
            </table>
            <button class="mt-4 btn btn-sm w-100 bg-primary text-white">Submit</button>
        </div>
        <div class="col-12">
            <table class="table">
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" name="" id="check-all">
                        </th>
                        <th>Email</th>
                        <th>Phone</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $idx => $item)
                    <tr>
                        <td>
                            <input type="checkbox" name="users[]" value="{{$item->id}}">
                        </td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->telephone}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</form>

@section('script')
<script>
    $(document).ready(async function () {
        const {
            data
        } = await axios.get('{{route("getStimulus", [], false)}}')
        data.forEach(({
            id, start,end, name
        }) => {
            const template = document.getElementById("stimulus-template").content.cloneNode(true)
            $(template).find("input[name='stimulus']").val(id)
            $(template).find(".stimulus-label").text(name)
            $(template).find(".stimulus-training").text(name)
            $(template).find(".stimulus-periode").text(`${start} s/d ${end}`)
            $(template).find(".stimulus-wrapper").attr('data-id', id)
            $(template).find(".btn-remove-stimulus").attr('data-id', id)
            $(".stimulus-list").append(template)
        })

        $("input[name='stimulus']").change(function () {
            const id = +$(this).val();
            const {
                detail
            } = data.find(d => d.id == id)
            $(`input[name='users[]']`).attr('checked', false)
            detail.forEach(({
                user_id
            }) => {
                $(`input[name='users[]'][value='${user_id}']`).attr('checked', true)
            })
        })

        $("#check-all").change(function () {
            $("input[name='users[]']").prop('checked', $(this).prop('checked'))
        })

        $(".btn-remove-stimulus").click(async function () {
            const id = $(this).data('id')
            await axios.post('{{route("deleteStimulus", [], false)}}', {
                id
            })
            $(`.stimulus-wrapper[data-id=${id}]`).remove()
        })
    })
</script>
@endsection
