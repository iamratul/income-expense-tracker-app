<div class="modal" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Expense</h5>
            </div>
            <div class="modal-body">
                <form id="save-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Category</label>
                                <select type="text" class="form-control form-select" id="expenseCategory">
                                    <option value="">Select Category</option>
                                </select>

                                <label class="form-label">Amount</label>
                                <input type="text" class="form-control" id="expenseAmount">
                                <label class="form-label">Description</label>
                                <input type="text" class="form-control" id="expenseDescription">
                                <label class="form-label">date</label>
                                <input type="date" class="form-control" id="expenseDate">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="modal-close" class="btn btn-sm btn-danger" data-bs-dismiss="modal"
                    aria-label="Close">Close</button>
                <button onclick="Save()" id="save-btn" class="btn btn-sm  btn-success">Save</button>
            </div>
        </div>
    </div>
</div>

<script>
    FillCategoryDropDown();

    async function FillCategoryDropDown() {
        let res = await axios.get("/expense-category-list")
        res.data.forEach(function(item, i) {
            let option = `<option value="${item['id']}">${item['name']}</option>`
            $("#expenseCategory").append(option);
        })
    }

    async function Save() {

        let expenseCategory = document.getElementById('expenseCategory').value;
        let expenseAmount = document.getElementById('expenseAmount').value;
        let expenseDescription = document.getElementById('expenseDescription').value;
        let expenseDate = document.getElementById('expenseDate').value;

        if (expenseCategory.length === 0) {
            errorToast("Expense Category is Required !")
        } else if (expenseAmount.length === 0) {
            errorToast("Expense Amount is Required !")
        } else if (expenseDescription.length === 0) {
            errorToast("Expense Description is Required !")
        } else if (expenseDate.length === 0) {
            errorToast("Expense Date is Required !")
        } else {
            document.getElementById('modal-close').click();

            showLoader();
            let res = await axios.post("/create-expense", {
                category_id: expenseCategory,
                amount: expenseAmount,
                description: expenseDescription,
                date: expenseDate
            })
            hideLoader();

            if (res.status === 201) {
                successToast('Expense Created Successfully');
                document.getElementById("save-form").reset();
                await getList();
            } else {
                errorToast("Expense Not Created !")
            }
        }
    }
</script>