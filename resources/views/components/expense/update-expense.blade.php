<div class="modal" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Expense</h5>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Category</label>
                                <select type="text" class="form-control form-select" id="expenseCategoryUpdate">
                                    <option value="">Select Category</option>
                                </select>

                                <label class="form-label">Amount</label>
                                <input type="text" class="form-control" id="expenseAmountUpdate">
                                <label class="form-label">Description</label>
                                <input type="text" class="form-control" id="expenseDescriptionUpdate">
                                <label class="form-label">date</label>
                                <input type="date" class="form-control" id="expenseDateUpdate">

                                <input type="text" class="d-none" id="updateID">
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button id="update-modal-close" class="btn btn-sm btn-danger" data-bs-dismiss="modal"
                    aria-label="Close">Close</button>
                <button onclick="update()" id="update-btn" class="btn btn-sm btn-success">Update</button>
            </div>

        </div>
    </div>
</div>

<script>
    async function UpdateFillCategoryDropDown() {
        let res = await axios.get("/expense-category-list")
        res.data.forEach(function(item, i) {
            let option = `<option value="${item['id']}">${item['name']}</option>`
            $("#expenseCategoryUpdate").append(option);
        })
    }

    async function FillUpUpdateForm(id) {
        document.getElementById('updateID').value = id;
        showLoader();
        await UpdateFillCategoryDropDown();
        let res = await axios.post("/expense-by-id", {
            id: id
        })
        hideLoader();

        document.getElementById('expenseAmountUpdate').value = res.data['amount'];
        document.getElementById('expenseDescriptionUpdate').value = res.data['description'];
        document.getElementById('expenseDateUpdate').value = res.data['date'];
        document.getElementById('expenseCategoryUpdate').value = res.data['category_id'];
    }

    async function update() {

        let expenseCategoryUpdate = document.getElementById('expenseCategoryUpdate').value;
        let expenseAmountUpdate = document.getElementById('expenseAmountUpdate').value;
        let expenseDescriptionUpdate = document.getElementById('expenseDescriptionUpdate').value;
        let expenseDateUpdate = document.getElementById('expenseDateUpdate').value;
        let updateID = document.getElementById('updateID').value;

        if (expenseCategoryUpdate.length === 0) {
            errorToast("Expense Category is Required !")
        } else if (expenseAmountUpdate.length === 0) {
            errorToast("Expense Amount is Required !")
        } else if (expenseDescriptionUpdate.length === 0) {
            errorToast("Expense Description is Required !")
        } else if (expenseDateUpdate.length === 0) {
            errorToast("Expense Date is Required !")
        } else {
            document.getElementById('update-modal-close').click();

            showLoader();
            let res = await axios.post("/update-expense", {
                category_id: expenseCategoryUpdate,
                amount: expenseAmountUpdate,
                description: expenseDescriptionUpdate,
                date: expenseDateUpdate,
                id: updateID
            })
            hideLoader();

            if (res.status === 200 && res.data === 1) {
                successToast('Expense Updated Successfully');
                document.getElementById("update-form").reset();
                await getList();
            } else {
                errorToast("Expense Not Updated !")
            }
        }
    }
</script>