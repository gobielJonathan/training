<template id="template-periode-list">
    <option>Select Periode</option>
</template>
    <select class="custom-select periode-stimulus-list" name="">
        <option value="0">Select Stimulus</option>
    </select>

<div class="my-3 d-flex flex-column-sm align-items-center">
    <div class="w-100 border-top" style="height: 1px"></div>
    <span class="mx-3">OR</span>
    <div class="w-100 border-top" style="height: 1px"></div>
</div>

<div class="d-flex flex-column-sm align-items-center">
    <input type="date" id="from" class="form-control"> 
    <span class="mx-3">s/d</span>
    <input type="date" id="to" class="form-control">
</div>


<button class="btn btn-sm btn-summary-checkout w-100 bg-primary text-white mt-4">Summary</button>

<table class="table mt-3">
    <thead>
        <tr>
            <th>Checkout</th>
            <th>In Cart</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td id="total_transaction" scope="row"></td>
            <td id="total_cart"></td>
        </tr>
    </tbody>
</table>
<script>
    $(document).ready(async function () {
        const {
            data
        } = await axios.get('{{route("getStimulus", [], false)}}')
        data.forEach(({
            id,
            name,
            start,
            end
        }) => {
            const template = document.getElementById("template-periode-list").content.cloneNode(
                true)
            $(template).find("option").attr('value', id).text(`${name} ${start} s/d ${end}`)
            $(".periode-stimulus-list").append(template)
        })


        $(".btn-summary-checkout").click(async function () {
            const {
                data: {
                    total_cart,
                    total_transaction
                }
            } = await axios.post("{{route('summary')}}", {
                stimulus_id: $(".periode-stimulus-list").val(),
                from : $("#from").val(),
                to : $("#to").val()
            })

            $("#total_transaction").html(`${total_transaction} records`)
            $("#total_cart").html(`${total_cart} records`)
        })
    })
</script>