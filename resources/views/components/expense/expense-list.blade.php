<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-lg-12">
            <div class="card px-5 py-5 shadow">
                <div class="row justify-content-between ">
                    <div class="align-items-center col">
                        <h4>Expense</h4>
                    </div>
                    <div class="align-items-center col">
                        <button data-bs-toggle="modal" data-bs-target="#create-modal"
                            class="float-end m-0 btn btn-primary">Create Expense</button>
                    </div>
                </div>
                <hr class="bg-dark " />
                <table class="table" id="tableData">
                    <thead>
                        <tr class="bg-light">
                            <th>SL No</th>
                            <th>Category</th>
                            <th>Amount</th>
                            <th>Description</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="tableList">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    getList();

    async function getList() {

        showLoader();
        let res = await axios.get("/expense-list");
        hideLoader();

        let tableList = $("#tableList");
        let tableData = $("#tableData");

        tableData.DataTable().destroy();
        tableList.empty();

        res.data.forEach(function(item, index) {
            const formattedDate = new Date(item['date']).toLocaleDateString('en-GB', {
                day: '2-digit',
                month: '2-digit',
                year: 'numeric'
            });
            let row = `<tr>
                    <td>${index+1}</td>
                    <td>${item['category']['name']}</td>
                    <td>${item['amount']}</td>
                    <td>${item['description']}</td>
                    <td>${formattedDate}</td>
                    <td>
                        <button data-id="${item['id']}" class="editBtn btn btn-sm btn-outline-success">Edit</button>
                        <button data-id="${item['id']}" class="deleteBtn btn btn-sm btn-outline-danger">Delete</button>
                    </td>
                 </tr>`
            tableList.append(row)
        })

        $('.editBtn').on('click', async function() {
            let id = $(this).data('id');
            await FillUpUpdateForm(id)
            $("#update-modal").modal('show');
        })

        $('.deleteBtn').on('click', function() {
            let id = $(this).data('id');
            $("#delete-modal").modal('show');
            $("#deleteID").val(id);
        })

        new DataTable('#tableData', {
            lengthMenu: [5, 10, 15, 20, 30]
        });
    }
</script>
