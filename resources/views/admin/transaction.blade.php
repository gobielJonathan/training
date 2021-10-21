<table class="table">
    <thead>
        <tr>
            <th>Training</th>
            <th>Payment</th>
            <th>User</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody id="training-list">
    </tbody>
</table>

<script>
    $(document).on('click', '.btn-accept-transaction', async function () {
        const id = $(this).data('id')
        await axios.post('{{route("acceptPayment", [], false)}}' , {
            id
        })
        $(`#training-list tr[data-id='${id}']`).remove()
    })
    $(document).ready(async function () {
        const{data}= await axios.get("{{route('getTranscations', [], false)}}")
        const html = data.map(data => {
            return `
            <tr data-id='${data.id}'>
                <td>
                    <img src='${data.training.image}' style="width: 100px;" alt="training-thumbnail" /> <br />
                    <span>${data.training.title}</span>
                </td>
                <td>
                    ${data.payment?.payment_name}(${data.payment?.payment_number}) <br />
                    <img src='${data.payment_image}' style="width: 100px;" alt="training-thumbnail" /> <br />
                    <span>${data.created_at}<span>
                </td>
                <td>
                    Email : ${data.user?.email} <br />
                    Address : ${data.user?.address} <br />
                </td>
                <td>Pending</td>
                <td>
                    <button data-id='${data.id}' class="btn btn-sm btn-accept-transaction bg-primary text-white">Accept</button>
                </td>
            </tr>
            `
        })
        $("#training-list").html(html)
    })
</script>