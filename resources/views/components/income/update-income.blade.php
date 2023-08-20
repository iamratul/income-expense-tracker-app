<div class="modal" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Income</h5>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Category</label>
                                <select type="text" class="form-control form-select" id="incomeCategoryUpdate">
                                    <option value="">Select Category</option>
                                </select>

                                <label class="form-label">Amount</label>
                                <input type="text" class="form-control" id="incomeAmountUpdate">
                                <label class="form-label">Description</label>
                                <input type="text" class="form-control" id="incomeDescriptionUpdate">
                                <label class="form-label">date</label>
                                <input type="date" class="form-control" id="incomeDateUpdate">

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
        let res = await axios.get("/income-category-list")
        res.data.forEach(function(item, i) {
            let option = `<option value="${item['id']}">${item['name']}</option>`
            $("#incomeCategoryUpdate").append(option);
        })
    }

    async function FillUpUpdateForm(id) {
        document.getElementById('updateID').value = id;
        showLoader();
        await UpdateFillCategoryDropDown();
        let res = await axios.post("/income-by-id", {
            id: id
        })
        hideLoader();

        document.getElementById('incomeAmountUpdate').value = res.data['amount'];
        document.getElementById('incomeDescriptionUpdate').value = res.data['description'];
        document.getElementById('incomeDateUpdate').value = res.data['date'];
        document.getElementById('incomeCategoryUpdate').value = res.data['category_id'];
    }

    async function update() {

        let incomeCategoryUpdate = document.getElementById('incomeCategoryUpdate').value;
        let incomeAmountUpdate = document.getElementById('incomeAmountUpdate').value;
        let incomeDescriptionUpdate = document.getElementById('incomeDescriptionUpdate').value;
        let incomeDateUpdate = document.getElementById('incomeDateUpdate').value;
        let updateID = document.getElementById('updateID').value;

        if (incomeCategoryUpdate.length === 0) {
            errorToast("Income Category is Required !")
        } else if (incomeAmountUpdate.length === 0) {
            errorToast("Income Amount is Required !")
        } else if (incomeDescriptionUpdate.length === 0) {
            errorToast("Income Description is Required !")
        } else if (incomeDateUpdate.length === 0) {
            errorToast("Income Date is Required !")
        } else {
            document.getElementById('update-modal-close').click();

            showLoader();
            let res = await axios.post("/update-income", {
                category_id: incomeCategoryUpdate,
                amount: incomeAmountUpdate,
                description: incomeDescriptionUpdate,
                date: incomeDateUpdate,
                id: updateID
            })
            hideLoader();

            if (res.status === 200 && res.data === 1) {
                successToast('Income Updated Successfully');
                document.getElementById("update-form").reset();
                await getList();
            } else {
                errorToast("Income Not Updated !")
            }
        }
    }
</script>